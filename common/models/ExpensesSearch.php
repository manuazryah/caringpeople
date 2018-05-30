<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Expenses;

/**
 * ExpensesSearch represents the model behind the search form about `common\models\Expenses`.
 */
class ExpensesSearch extends Expenses {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'expense_type', 'status', 'CB', 'UB'], 'integer'],
                        [['expense_subtype', 'amount', 'date', 'DOC', 'DOU'], 'safe'],
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
                $query = Expenses::find();

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

                if (!empty($this->date) && strpos($this->date, '-') !== false) {
                        list($start_date, $end_date) = explode(' - ', $this->date);

                        $query->andFilterWhere(['between', 'date(date)', $start_date, $end_date]);
                        $this->date = "";
                }

                // grid filtering conditions
                $query->andFilterWhere([
                    'id' => $this->id,
                    'expense_type' => $this->expense_type,
                    'date' => $this->date,
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'expense_subtype', $this->expense_subtype])
                        ->andFilterWhere(['like', 'amount', $this->amount]);

                return $dataProvider;
        }

}
