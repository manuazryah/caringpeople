<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PatientInformation;

/**
 * PatientInformationSearch represents the model behind the search form about `common\models\PatientInformation`.
 */
class PatientInformationSearch extends PatientInformation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enquiry_id', 'patient_id', 'branch_id', 'contact_gender', 'contact_city', 'contact_perosn_relationship', 'patient_gender', 'patient_age', 'patient_weight', 'veteran_or_spouse', 'patient_current_status', 'status', 'CB', 'UB'], 'integer'],
            [['contact_address', 'contact_name', 'referral_source', 'contact_mobile_number_1', 'contact_mobile_number_2', 'contact_mobile_number_3', 'contact_zip_or_pc', 'contact_email', 'patient_name', 'other_relationships', 'patient_address', 'patient_city', 'patient_postal_code', 'follow_up_date', 'notes', 'DOC', 'DOU'], 'safe'],
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
        $query = PatientInformation::find();

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
            'patient_id' => $this->patient_id,
            'branch_id' => $this->branch_id,
            'contact_gender' => $this->contact_gender,
            'contact_city' => $this->contact_city,
            'contact_perosn_relationship' => $this->contact_perosn_relationship,
            'patient_gender' => $this->patient_gender,
            'patient_age' => $this->patient_age,
            'patient_weight' => $this->patient_weight,
            'veteran_or_spouse' => $this->veteran_or_spouse,
            'patient_current_status' => $this->patient_current_status,
            'follow_up_date' => $this->follow_up_date,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'contact_address', $this->contact_address])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'referral_source', $this->referral_source])
            ->andFilterWhere(['like', 'contact_mobile_number_1', $this->contact_mobile_number_1])
            ->andFilterWhere(['like', 'contact_mobile_number_2', $this->contact_mobile_number_2])
            ->andFilterWhere(['like', 'contact_mobile_number_3', $this->contact_mobile_number_3])
            ->andFilterWhere(['like', 'contact_zip_or_pc', $this->contact_zip_or_pc])
            ->andFilterWhere(['like', 'contact_email', $this->contact_email])
            ->andFilterWhere(['like', 'patient_name', $this->patient_name])
            ->andFilterWhere(['like', 'other_relationships', $this->other_relationships])
            ->andFilterWhere(['like', 'patient_address', $this->patient_address])
            ->andFilterWhere(['like', 'patient_city', $this->patient_city])
            ->andFilterWhere(['like', 'patient_postal_code', $this->patient_postal_code])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
