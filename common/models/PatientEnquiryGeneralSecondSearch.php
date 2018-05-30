<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PatientEnquiryGeneralSecond;

/**
 * PatientEnquiryGeneralSecondSearch represents the model behind the search form about `common\models\PatientEnquiryGeneralSecond`.
 */
class PatientEnquiryGeneralSecondSearch extends PatientEnquiryGeneralSecond
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enquiry_id', 'whatsapp_reply', 'expected_date_of_service', 'visit_type', 'priority'], 'integer'],
            [['address', 'city', 'zip_pc', 'email', 'email1', 'whatsapp_number', 'whatsapp_note', 'required_service', 'required_service_other', 'service_required', 'service_required_other', 'how_long_service_required', 'quotation_details', 'notes'], 'safe'],
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
        $query = PatientEnquiryGeneralSecond::find();

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
            'whatsapp_reply' => $this->whatsapp_reply,
            'expected_date_of_service' => $this->expected_date_of_service,
            'visit_type' => $this->visit_type,
            'priority' => $this->priority,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zip_pc', $this->zip_pc])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'email1', $this->email1])
            ->andFilterWhere(['like', 'whatsapp_number', $this->whatsapp_number])
            ->andFilterWhere(['like', 'whatsapp_note', $this->whatsapp_note])
            ->andFilterWhere(['like', 'required_service', $this->required_service])
            ->andFilterWhere(['like', 'required_service_other', $this->required_service_other])
            ->andFilterWhere(['like', 'service_required', $this->service_required])
            ->andFilterWhere(['like', 'service_required_other', $this->service_required_other])
            ->andFilterWhere(['like', 'how_long_service_required', $this->how_long_service_required])
            ->andFilterWhere(['like', 'quotation_details', $this->quotation_details])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
