<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StockAdjDtl;

/**
 * StockAdjDtlSearch represents the model behind the search form about `common\models\StockAdjDtl`.
 */
class StockAdjDtlSearch extends StockAdjDtl {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'StockAdjMstId', 'transaction', 'qty', 'status', 'CB', 'UB', 'item_id'], 'integer'],
            [['document_no', 'document_date', 'item_code', 'item_name', 'location_code', 'reference', 'DOU', 'DOC'], 'safe'],
            [['item_cost', 'weight', 'total_cost'], 'number'],
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
        $query = StockAdjDtl::find();

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
            'StockAdjMstId' => $this->StockAdjMstId,
            'transaction' => $this->transaction,
            'document_date' => $this->document_date,
            'item_cost' => $this->item_cost,
            'qty' => $this->qty,
            'weight' => $this->weight,
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
                ->andFilterWhere(['like', 'location_code', $this->location_code])
                ->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }

}
