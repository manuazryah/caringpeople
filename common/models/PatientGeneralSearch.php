<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PatientGeneral;

/**
 * PatientGeneralSearch represents the model behind the search form about `common\models\PatientGeneral`.
 */
class PatientGeneralSearch extends PatientGeneral {

        /**
         * @inheritdoc
         */
        public $guardian_name;
        public $guardian_id_or_passport_no;
        public $guardian_landmark;
        public $guardian_contact_no;
        public $guardian_email;

        public function rules() {
                return [
                        [['id', 'patient_enquiry_id', 'branch_id', 'gender', 'age', 'pin_code', 'contact_number', 'status', 'CB', 'UB'], 'integer'],
                        [['patient_id', 'guardian_name', 'guardian_id_or_passport_no', 'guardian_landmark', 'guardian_contact_no', 'guardian_email', 'first_name', 'last_name', 'blood_group', 'patient_image', 'present_address', 'landmark', 'email', 'DOC', 'DOU', 'staff_manager', 'average_point'], 'safe'],
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
                $query = PatientGeneral::find();
                $query->joinWith(['patientGuardianInfo']);
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
                    'id' => $this->id,
                    'patient_enquiry_id' => $this->patient_enquiry_id,
                    'branch_id' => $this->branch_id,
                    'patient_general.gender' => $this->gender,
                    'age' => $this->age,
                    'pin_code' => $this->pin_code,
                    'patient_general.contact_number' => $this->contact_number,
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'patient_general.patient_id', $this->patient_id])
                        ->andFilterWhere(['like', 'patient_general.first_name', $this->first_name])
                        ->andFilterWhere(['like', 'last_name', $this->last_name])
                        ->andFilterWhere(['like', 'blood_group', $this->blood_group])
                        ->andFilterWhere(['like', 'patient_image', $this->patient_image])
                        ->andFilterWhere(['like', 'present_address', $this->present_address])
                        ->andFilterWhere(['like', 'patient_general.landmark', $this->landmark])
                        ->andFilterWhere(['like', 'patient_guardian_details.first_name', $this->guardian_name])
                        ->andFilterWhere(['like', 'patient_guardian_details.id_card_or_passport_no', $this->guardian_id_or_passport_no])
                        ->andFilterWhere(['like', 'patient_guardian_details.landmark', $this->guardian_landmark])
                        ->andFilterWhere(['like', 'patient_guardian_details.contact_number', $this->guardian_contact_no])
                        ->andFilterWhere(['like', 'patient_guardian_details.email', $this->guardian_email])
                        ->andFilterWhere(['like', 'patient_general.email', $this->email]);

                return $dataProvider;
        }

}
