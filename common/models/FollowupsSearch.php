<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Followups;

/**
 * FollowupsSearch represents the model behind the search form about `common\models\Followups`.
 */
class FollowupsSearch extends Followups {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'type', 'type_id', 'assigned_to', 'assigned_from', 'related_staffs'], 'integer'],
                        [['followup_date', 'followup_notes', 'DOC', 'related_staffs', 'assigned_to', 'sub_type', 'status'], 'safe'],
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
                $query = Followups::find();

                // add conditions that should always apply here

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
                    'type' => $this->type,
                    'type_id' => $this->type_id,
                    'assigned_from' => $this->assigned_from,
                    'DOC' => $this->DOC,
                ]);

                $query->andFilterWhere(['like', 'followup_notes', $this->followup_notes])
                        ->andFilterWhere(['like', 'followup_date', $this->followup_date])
                        ->andFilterWhere(['like', 'sub_type', $this->sub_type])
                        ->andFilterWhere(['like', 'assigned_to', $this->assigned_to])
                        ->andFilterWhere(['like', 'related_staffs', $this->related_staffs]);

                return $dataProvider;
        }

}
