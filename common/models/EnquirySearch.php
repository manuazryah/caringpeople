<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Enquiry;

/**
 * EnquirySearch represents the model behind the search form about `common\models\Enquiry`.
 */
class EnquirySearch extends Enquiry
{

/**
         * @var string
         */
        public $contactedFrom;
        public $contactedTo;
        public $outgoingFrom;
        public $outgoingTo;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enquiry_id', 'contacted_source', 'age', 'relationship', 'veteran_or_spouse', 'branch_id', 'status', 'CB', 'UB'], 'integer'],
            [['contacted_date', 'incoming_missed', 'contacted_source_others', 'outgoing_number_from', 'outgoing_call_date', 'caller_name', 'referral_source', 'mobile_number', 'mobile_number_2', 'mobile_number_3', 'address', 'city', 'zip_pc', 'email', 'service_required_for', 'service_required_for_others', 'person_address', 'person_city', 'person_postal_code', 'DOC', 'DOU'], 'safe'],
            [['weight'], 'number'],
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
        $query = Enquiry::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'contacted_source' => $this->contacted_source,
            'contacted_date' => $this->contacted_date,
            'outgoing_call_date' => $this->outgoing_call_date,
            'age' => $this->age,
            'weight' => $this->weight,
            'relationship' => $this->relationship,
            'veteran_or_spouse' => $this->veteran_or_spouse,
            'branch_id' => $this->branch_id,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'incoming_missed', $this->incoming_missed])
            ->andFilterWhere(['like', 'contacted_source_others', $this->contacted_source_others])
            ->andFilterWhere(['like', 'outgoing_number_from', $this->outgoing_number_from])
            ->andFilterWhere(['like', 'caller_name', $this->caller_name])
            ->andFilterWhere(['like', 'referral_source', $this->referral_source])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'mobile_number_2', $this->mobile_number_2])
            ->andFilterWhere(['like', 'mobile_number_3', $this->mobile_number_3])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zip_pc', $this->zip_pc])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'service_required_for', $this->service_required_for])
            ->andFilterWhere(['like', 'service_required_for_others', $this->service_required_for_others])
            ->andFilterWhere(['like', 'person_address', $this->person_address])
            ->andFilterWhere(['like', 'person_city', $this->person_city])
            ->andFilterWhere(['like', 'person_postal_code', $this->person_postal_code])
            ->andFilterWhere(['>=', 'contacted_date', $params['Enquiry']['contactedFrom']])
                        ->andFilterWhere(['<=', 'contacted_date', $params['Enquiry']['contactedTo']])
                        ->andFilterWhere(['>=', 'outgoing_call_date', $params['Enquiry']['$outgoingFrom']])
                        ->andFilterWhere(['<=', 'outgoing_call_date', $params['Enquiry']['$outgoingTo']]);

        return $dataProvider;
    }
}
