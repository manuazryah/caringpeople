<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StaffInfo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * StaffInfoSearch represents the model behind the search form about `common\models\StaffInfo`.
 */
class StaffInfoSearch extends StaffInfo {

        /**
         * @inheritdoc
         */
        public $timing;
        public $uniform;
        public $company_id;

        public function rules() {
                return [
                        [['id', 'designation', 'gender', 'religion', 'caste', 'nationality', 'years_of_experience', 'driving_licence', 'branch_id', 'status', 'CB', 'UB'], 'integer'],
                        [['staff_name', 'dob', 'place', 'blood_group', 'pan_or_adhar_no', 'permanent_address', 'pincode', 'contact_no', 'email', 'present_address', 'present_pincode', 'present_contact_no', 'present_email', 'licence_no', 'DOC', 'DOU', 'staff_id', 'staff_manager', 'average_point', 'staff_experience', 'working_status', 'timing', 'area_interested', 'uniform', 'company_id'], 'safe'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function scenarios() {
                // bypass scenarios() implementation in the parent class
                return Model::scenarios();
        }

        /**
         * Creates data provider instance with search query applied
         *
         * @param array $params
         *
         * @return ActiveDataProvider
         */
        public function search($params) {

                $query = StaffInfo::find();
                $query->joinWith(['staffEducation']);
                // add conditions that should always apply here

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['defaultOrder' => ['id' => SORT_DESC,
                        ]]
                ]);

                $this->load($params);

                if (!$this->validate()) {
                        // uncomment the following line if you do not want to return any records when validation fails
                        // $query->where('0=1');
                        return $dataProvider;
                }


                // grid filtering conditions
                $query->andFilterWhere([
                    'staff_info.id' => $this->id,
                    'gender' => $this->gender,
                    'dob' => $this->dob,
                    'religion' => $this->religion,
                    'caste' => $this->caste,
                    'nationality' => $this->nationality,
                    'years_of_experience' => $this->years_of_experience,
                    'driving_licence' => $this->driving_licence,
                    'branch_id' => $this->branch_id,
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'staff_name', $this->staff_name])
                        ->andFilterWhere(['like', 'blood_group', $this->blood_group])
                        ->andFilterWhere(['like', 'pan_or_adhar_no', $this->pan_or_adhar_no])
                        ->andFilterWhere(['like', 'permanent_address', $this->permanent_address])
                        ->andFilterWhere(['like', 'pincode', $this->pincode])
                        ->andFilterWhere(['like', 'contact_no', $this->contact_no])
                        ->andFilterWhere(['like', 'staff_info.staff_id', $this->staff_id])
                        ->andFilterWhere(['like', 'email', $this->email])
                        ->andFilterWhere(['like', 'present_address', $this->present_address])
                        ->andFilterWhere(['like', 'present_pincode', $this->present_pincode])
                        ->andFilterWhere(['like', 'present_contact_no', $this->present_contact_no])
                        ->andFilterWhere(['like', 'place', $this->place])
                        ->andFilterWhere(['like', 'designation', $this->designation])
                        ->andFilterWhere(['like', 'present_email', $this->present_email])
                        ->andFilterWhere(['like', 'average_point', $this->average_point])
                        ->andFilterWhere(['like', 'staff_experience', $this->staff_experience])
                        ->andFilterWhere(['like', 'working_status', $this->working_status])
                        ->andFilterWhere(['like', 'area_interested', $this->area_interested])
                        ->andFilterWhere(['like', 'staff_info_education.timing', $this->timing])
                        ->andFilterWhere(['like', 'staff_info_education.uniform', $this->uniform])
                        ->andFilterWhere(['like', 'staff_info_education.company_id', $this->company_id])
                        ->andFilterWhere(['like', 'licence_no', $this->licence_no]);



                return $dataProvider;
        }

        public function getGridColumns() {
                return [
                        ['class' => 'yii\grid\SerialColumn'],
                    'staff_id',
                    'staff_name',
                        [
                        'attribute' => 'gender',
                        'value' => function($model, $key, $index, $column) {
                                if ($model->gender == '0') {
                                        return 'Male';
                                } else if ($model->gender == '1') {
                                        return 'Female';
                                }
                        },
                        'filter' => [1 => 'Female', 0 => 'Male'],
                    ],
                    'place',
                        [
                        'attribute' => 'designation',
                        'value' => function($model, $key, $index, $column) {
                                //  $designation = \common\models\MasterDesignations::findOne(['id' => $model->designation]);
//
                                return $model->designation($model->designation);
                        },
                        'filter' => ArrayHelper::map(\common\models\MasterDesignations::designationlist(), 'id', 'title'),
                    ],
                        [
                        'attribute' => 'timing',
                        // 'value' => 'patientGeneralInfo.whatsapp_reply',
                        'value' => function($model, $key, $index, $column) {

                                $timimg = explode(',', $model->staffEducation->timing);

                                foreach ($timimg as $value) {
                                        if ($value == 0) {
                                                $timing_val .= 'Part Time, ';
                                        } if ($value == 1) {
                                                $timing_val .= 'Full Time,';
                                        }
                                }
                                return $timing_val;
                        },
                    ],
                        [
                        'attribute' => 'branch_id',
                        'value' => function($data) {
                                return Branch::findOne($data->branch_id)->branch_name;
                        },
                        'filter' => ArrayHelper::map(\common\models\Branch::branch(), 'id', 'branch_name'),
                    ],
                        [
                        'attribute' => 'status',
                        'value' => function($model, $key, $index, $column) {
                                if ($model->status == '1') {
                                        return 'Opened';
                                } else if ($model->status == '2') {
                                        return 'Closed';
                                } else if ($model->status == '3') {
                                        return 'Terminated';
                                } else if ($model->status == '4') {
                                        return 'Resigned';
                                } else if ($model->status == '5') {
                                        return 'Without Resignation';
                                }
                        },
                        'filter' => [1 => 'Opened', 2 => 'Closed', 3 => 'Terminated', 4 => 'Resigned', 5 => 'Without Resignation'],
                    ],
                    'average_point',
                        [
                        'attribute' => 'working_status',
                        'value' => function($model) {
                                if ($model->working_status == 0) {
                                        return 'Bench';
                                } else if ($model->working_status == 1) {
                                        return 'On Duty';
                                }
                        },
                        'filter' => [0 => 'Bench', 1 => 'On Duty'],
                    ],
                        ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}{update}{delete}{missing}{leave}',
                        'visibleButtons' => [
                            'delete' => function ($model, $key, $index) {
                                    return Yii::$app->user->identity->post_id != '1' ? false : true;
                            }
                        ],
                        'buttons' => [
                            'missing' => function($url, $model, $key) {     // render your custom button
                                    $checking = $model->check($model->id);
                                    if ($checking == 1) {
                                            return Html::a('<span class="fa fa-file-image-o" style="padding-top: 0px;"></span>', ['#'], [
                                                        'title' => Yii::t('app', 'Missing Fileds/ Files'),
                                                        'class' => 'actions missing-files',
                                                        'type' => '2',
                                                        'target' => '_blank',
                                                        'id' => $model->id
                                            ]);
                                    }
                            },
                            'leave' => function($url, $model, $key) {     // render your custom button
                                    return Html::a('<span class="fa fa-minus-circle" style="padding-top: 0px;"></span>', ['/staff/staff-info/leave', 'id' => $model->id], [
                                                'title' => Yii::t('app', 'Leave'),
                                                'class' => 'actions staff-leave',
                                                'type' => '2',
                                                'target' => '_blank',
                                                'id' => $model->id
                                    ]);
                            },
                        ]
                    ],
                ];
        }

        public function getExportColumns() {
                return [
                        ['class' => 'yii\grid\SerialColumn'],
//
                    'staff_id',
                    'staff_name',
                        [
                        'attribute' => 'gender',
                        'value' => function($model, $key, $index, $column) {
                                if ($model->gender == '0') {
                                        return 'Male';
                                } else if ($model->gender == '1') {
                                        return 'Female';
                                }
                        },
                        'filter' => [1 => 'Female', 0 => 'Male'],
                    ],
                    'contact_no',
                    'email',
                    'place',
                        [
                        'attribute' => 'designation',
                        'value' => function($model, $key, $index, $column) {
                                return $model->designation($model->designation);
                        },
                    ],
                        [
                        'attribute' => 'branch_id',
                        'value' => function($data) {
                                return Branch::findOne($data->branch_id)->branch_name;
                        },
                    ],
                        ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}{update}{followup}{delete}',
                        'visibleButtons' => [
                            'delete' => function ($model, $key, $index) {
                                    return Yii::$app->user->identity->post_id != '1' ? false : true;
                            }
                        ],
                    ],
                ];
        }

}
