<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StockRegister;

/**
 * StockRegisterSearch represents the model behind the search form about `common\models\StockRegister`.
 */
class StockRegisterSearch extends StockRegister {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'transaction', 'document_line_id', 'qty_in', 'qty_out', 'status', 'CB', 'UB', 'item_id'], 'integer'],
            [['document_no', 'document_date', 'item_code', 'item_name', 'location_code', 'DOC', 'DOU', 'balance_qty'], 'safe'],
            [['item_cost', 'weight_in', 'weight_out', 'total_cost'], 'number'],
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
        $query = StockRegister::find();

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
            'transaction' => $this->transaction,
            'document_line_id' => $this->document_line_id,
            'document_date' => $this->document_date,
            'item_cost' => $this->item_cost,
            'qty_in' => $this->qty_in,
            'qty_out' => $this->qty_out,
            'weight_in' => $this->weight_in,
            'weight_out' => $this->weight_out,
            'total_cost' => $this->total_cost,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'document_no', $this->document_no])
                ->andFilterWhere(['like', 'item_code', $this->item_code])
                ->andFilterWhere(['like', 'item_name', $this->item_name])
                ->andFilterWhere(['like', 'location_code', $this->location_code]);

        return $dataProvider;
    }

}
