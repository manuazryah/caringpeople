<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StaffPayroll;

/**
 * StaffPayrollSearch represents the model behind the search form about `common\models\StaffPayroll`.
 */
class StaffPayrollSearch extends StaffPayroll {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'staff_id', 'type', 'CB', 'UB'], 'integer'],
                        [['month', 'year', 'amount', 'DOC', 'DOU', 'selected_month'], 'safe'],
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
                $query = StaffPayroll::find();

                // add conditions that should always apply here

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
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
                    'staff_id' => $this->staff_id,
                    'selected_month' => $this->selected_month,
                    'type' => $this->type,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'month', $this->month])
                        ->andFilterWhere(['like', 'year', $this->year])
                        ->andFilterWhere(['like', 'amount', $this->amount]);

                return $dataProvider;
        }

}
