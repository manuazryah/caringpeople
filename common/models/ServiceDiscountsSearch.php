<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServiceDiscounts;

/**
 * ServiceDiscountsSearch represents the model behind the search form about `common\models\ServiceDiscounts`.
 */
class ServiceDiscountsSearch extends ServiceDiscounts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'service_id', 'discount_type'], 'integer'],
            [['rate', 'discount_value', 'total_amount'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = ServiceDiscounts::find();

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
            'service_id' => $this->service_id,
            'discount_type' => $this->discount_type,
        ]);

        $query->andFilterWhere(['like', 'rate', $this->rate])
            ->andFilterWhere(['like', 'discount_value', $this->discount_value])
            ->andFilterWhere(['like', 'total_amount', $this->total_amount]);

        return $dataProvider;
    }
}
