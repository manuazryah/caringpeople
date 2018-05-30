<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StaffOtherInfo;

/**
 * StaffOtherInfoSearch represents the model behind the search form about `common\models\StaffOtherInfo`.
 */
class StaffOtherInfoSearch extends StaffOtherInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'staff_id'], 'integer'],
            [['hospital_address', 'designation', 'length_of_service', 'current_from', 'current_to', 'emergency_contact_name', 'relationship', 'phone', 'mobile', 'alt_emergency_contact_name', 'alt_relationship', 'alt_phone', 'alt_mobile'], 'safe'],
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
        $query = StaffOtherInfo::find();

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
            'current_from' => $this->current_from,
            'current_to' => $this->current_to,
        ]);

        $query->andFilterWhere(['like', 'hospital_address', $this->hospital_address])
            ->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['like', 'length_of_service', $this->length_of_service])
            ->andFilterWhere(['like', 'emergency_contact_name', $this->emergency_contact_name])
            ->andFilterWhere(['like', 'relationship', $this->relationship])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'alt_emergency_contact_name', $this->alt_emergency_contact_name])
            ->andFilterWhere(['like', 'alt_relationship', $this->alt_relationship])
            ->andFilterWhere(['like', 'alt_phone', $this->alt_phone])
            ->andFilterWhere(['like', 'alt_mobile', $this->alt_mobile]);

        return $dataProvider;
    }
}
