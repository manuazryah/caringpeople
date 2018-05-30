<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EnquiryOtherInfo;

/**
 * EnquiryOtherInfoSearch represents the model behind the search form about `common\models\EnquiryOtherInfo`.
 */
class EnquiryOtherInfoSearch extends EnquiryOtherInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enquiry_id', 'family_support', 'care_currently_provided', 'difficulty_in_movement', 'service_required', 'priority'], 'integer'],
            [['family_support_note', 'details_of_current_care', 'difficulty_in_movement_other', 'service_required_other', 'how_long_service_required', 'nursing_assessment', 'doctor_assessment', 'follow_up_notes', 'quotation_details', 'followup_date'], 'safe'],
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
        $query = EnquiryOtherInfo::find();

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
            'enquiry_id' => $this->enquiry_id,
            'family_support' => $this->family_support,
            'care_currently_provided' => $this->care_currently_provided,
            'difficulty_in_movement' => $this->difficulty_in_movement,
            'service_required' => $this->service_required,
            'priority' => $this->priority,
            'followup_date' => $this->followup_date,
        ]);

        $query->andFilterWhere(['like', 'family_support_note', $this->family_support_note])
            ->andFilterWhere(['like', 'details_of_current_care', $this->details_of_current_care])
            ->andFilterWhere(['like', 'difficulty_in_movement_other', $this->difficulty_in_movement_other])
            ->andFilterWhere(['like', 'service_required_other', $this->service_required_other])
            ->andFilterWhere(['like', 'how_long_service_required', $this->how_long_service_required])
            ->andFilterWhere(['like', 'nursing_assessment', $this->nursing_assessment])
            ->andFilterWhere(['like', 'doctor_assessment', $this->doctor_assessment])
            ->andFilterWhere(['like', 'follow_up_notes', $this->follow_up_notes])
            ->andFilterWhere(['like', 'quotation_details', $this->quotation_details]);

        return $dataProvider;
    }
}
