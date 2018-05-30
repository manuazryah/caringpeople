<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PatientEnquiryHospitalFirst;

/**
 * PatientEnquiryHospitalFirstSearch represents the model behind the search form about `common\models\PatientEnquiryHospitalFirst`.
 */
class PatientEnquiryHospitalFirstSearch extends PatientEnquiryHospitalFirst
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enquiry_id', 'patient_gender', 'patient_age', 'patient_weight'], 'integer'],
            [['required_person_name', 'relationship', 'relationship_others', 'person_address', 'person_city', 'person_postal_code', 'hospital_name', 'consultant_doctor', 'department', 'hospital_room_no'], 'safe'],
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
        $query = PatientEnquiryHospitalFirst::find();

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
            'patient_gender' => $this->patient_gender,
            'patient_age' => $this->patient_age,
            'patient_weight' => $this->patient_weight,
        ]);

        $query->andFilterWhere(['like', 'required_person_name', $this->required_person_name])
            ->andFilterWhere(['like', 'relationship', $this->relationship])
            ->andFilterWhere(['like', 'relationship_others', $this->relationship_others])
            ->andFilterWhere(['like', 'person_address', $this->person_address])
            ->andFilterWhere(['like', 'person_city', $this->person_city])
            ->andFilterWhere(['like', 'person_postal_code', $this->person_postal_code])
            ->andFilterWhere(['like', 'hospital_name', $this->hospital_name])
            ->andFilterWhere(['like', 'consultant_doctor', $this->consultant_doctor])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'hospital_room_no', $this->hospital_room_no]);

        return $dataProvider;
    }
}
