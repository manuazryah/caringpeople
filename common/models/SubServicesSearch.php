<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SubServices;

/**
 * SubServicesSearch represents the model behind the search form about `common\models\SubServices`.
 */
class SubServicesSearch extends SubServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'service', 'CB', 'UB'], 'integer'],
            [['sub_service', 'DOC', 'DOU','status'], 'safe'],
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
        $query = SubServices::find();

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
            'service' => $this->service,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'sub_service', $this->sub_service])
                ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
