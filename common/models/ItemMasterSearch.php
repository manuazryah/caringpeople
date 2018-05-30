<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ItemMaster;

/**
 * ItemMasterSearch represents the model behind the search form about `common\models\ItemMaster`.
 */
class ItemMasterSearch extends ItemMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'item_type', 'tax_id', 'base_unit_id', 'status', 'CB', 'UB'], 'integer'],
            [['SKU', 'item_name', 'DOC', 'DOU', 'hsn'], 'safe'],
            [['MRP', 'retail_price', 'purchase_price', 'item_cost', 'whole_sale_price'], 'number'],
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
        $query = ItemMaster::find()->orderBy(['id' => SORT_DESC]);

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
            'item_type' => $this->item_type,
            'tax_id' => $this->tax_id,
            'base_unit_id' => $this->base_unit_id,
            'MRP' => $this->MRP,
            'retail_price' => $this->retail_price,
            'whole_sale_price' => $this->whole_sale_price,
            'purchase_price' => $this->purchase_price,
            'item_cost' => $this->item_cost,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'SKU', $this->SKU])
                ->andFilterWhere(['like', 'item_name', $this->item_name]);

        return $dataProvider;
    }

}
