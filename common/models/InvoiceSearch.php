<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Invoice;

/**
 * InvoiceSearch represents the model behind the search form about `common\models\Invoice`.
 */
class InvoiceSearch extends Invoice {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'branch_id', 'patient_id', 'service_id', 'type', 'CB'], 'integer'],
                        [['amount', 'DOC', 'status'], 'safe'],
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
                $query = Invoice::find();

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
                    'branch_id' => $this->branch_id,
                    'patient_id' => $this->patient_id,
                    'service_id' => $this->service_id,
                    'type' => $this->type,
                    'CB' => $this->CB,
                    'DOC' => $this->DOC,
                ]);

                $query->andFilterWhere(['like', 'amount', $this->amount])
                        ->andFilterWhere(['like', 'status', $this->status]);

                return $dataProvider;
        }

}
