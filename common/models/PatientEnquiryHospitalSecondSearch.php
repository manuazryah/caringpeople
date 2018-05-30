<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PatientEnquiryHospitalSecond;

/**
 * PatientEnquiryHospitalSecondSearch represents the model behind the search form about `common\models\PatientEnquiryHospitalSecond`.
 */
class PatientEnquiryHospitalSecondSearch extends PatientEnquiryHospitalSecond
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enquiry_id', 'family_support', 'care_currently_provided', 'difficulty_in_movement'], 'integer'],
            [['diabetic', 'diabetic_note', 'hypertension', 'feeding', 'urine', 'oxygen', 'tracheostomy', 'iv_line', 'family_support_note', 'care_currently_provided_others', 'date_of_discharge', 'details_of_current_care', 'difficulty_in_movement_other'], 'safe'],
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
        $query = PatientEnquiryHospitalSecond::find();

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
            'date_of_discharge' => $this->date_of_discharge,
            'difficulty_in_movement' => $this->difficulty_in_movement,
        ]);

        $query->andFilterWhere(['like', 'diabetic', $this->diabetic])
            ->andFilterWhere(['like', 'diabetic_note', $this->diabetic_note])
            ->andFilterWhere(['like', 'hypertension', $this->hypertension])
            ->andFilterWhere(['like', 'feeding', $this->feeding])
            ->andFilterWhere(['like', 'urine', $this->urine])
            ->andFilterWhere(['like', 'oxygen', $this->oxygen])
            ->andFilterWhere(['like', 'tracheostomy', $this->tracheostomy])
            ->andFilterWhere(['like', 'iv_line', $this->iv_line])
            ->andFilterWhere(['like', 'family_support_note', $this->family_support_note])
            ->andFilterWhere(['like', 'care_currently_provided_others', $this->care_currently_provided_others])
            ->andFilterWhere(['like', 'details_of_current_care', $this->details_of_current_care])
            ->andFilterWhere(['like', 'difficulty_in_movement_other', $this->difficulty_in_movement_other]);

        return $dataProvider;
    }
}
