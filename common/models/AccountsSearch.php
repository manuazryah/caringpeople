<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Accounts;

/**
 * AccountsSearch represents the model behind the search form about `common\models\Accounts`.
 */
class AccountsSearch extends Accounts {

        /**
         * @inheritdoc
         */
        public $createdFrom;
        public $createdTo;

        public function rules() {
                return [
                        [['id', 'branch_id', 'reference_type', 'invoice_id', 'debited_to_credited_by', 'type', 'payment_type', 'CB', 'UB'], 'integer'],
                        [['purpose', 'amount', 'payment_date', 'DOC', 'DOU'], 'safe'],
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

                if (!isset($params["AccountsSearch"]["createdFrom"])) {
                        $params["AccountsSearch"]["createdFrom"] = date('Y-m-d');
                } else {
                        $params["AccountsSearch"]["createdFrom"] = date('Y-m-d', strtotime($params["AccountsSearch"]["createdFrom"]));
                }
                if (!isset($params["AccountsSearch"]["createdTo"])) {
                        $params["AccountsSearch"]["createdTo"] = date('Y-m-d');
                } else {
                        $params["AccountsSearch"]["createdTo"] = date('Y-m-d', strtotime($params["AccountsSearch"]["createdTo"]));
                }

                $query = Accounts::find();

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
                    'branch_id' => $this->branch_id,
                    'reference_type' => $this->reference_type,
                    'invoice_id' => $this->invoice_id,
                    'debited_to_credited_by' => $this->debited_to_credited_by,
                    'type' => $this->type,
                    'payment_type' => $this->payment_type,
                    'payment_date' => $this->payment_date,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'purpose', $this->purpose])
                        ->andFilterWhere(['like', 'amount', $this->amount])
                        ->andFilterWhere(['>=', 'payment_date', $params["AccountsSearch"]["createdFrom"]])
                        ->andFilterWhere(['<=', 'payment_date', $params["AccountsSearch"]["createdTo"]]);

                return $dataProvider;
        }

}
