<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServiceBin;

/**
 * ServiceBinSearch represents the model behind the search form about `common\models\ServiceBin`.
 */
class ServiceBinSearch extends ServiceBin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'branch_id', 'patient_id', 'service', 'sub_service', 'gender_preference', 'duty_type', 'day_night_staff', 'staff_manager', 'co_worker', 'registration_fees', 'status', 'CB', 'UB'], 'integer'],
            [['service_id', 'frequency', 'hours', 'days', 'from_date', 'to_date', 'service_staffs', 'rate_card_value', 'client_notes', 'DOC', 'DOU'], 'safe'],
            [['estimated_price', 'registration_fees_amount', 'due_amount'], 'number'],
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
        $query = ServiceBin::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['defaultOrder' => ['id' => SORT_DESC,
                        ]]
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
            'branch_id' => $this->branch_id,
            'patient_id' => $this->patient_id,
            'service' => $this->service,
            'sub_service' => $this->sub_service,
            'gender_preference' => $this->gender_preference,
            'duty_type' => $this->duty_type,
            'day_night_staff' => $this->day_night_staff,
            'staff_manager' => $this->staff_manager,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'estimated_price' => $this->estimated_price,
            'co_worker' => $this->co_worker,
            'registration_fees' => $this->registration_fees,
            'registration_fees_amount' => $this->registration_fees_amount,
            'due_amount' => $this->due_amount,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'service_id', $this->service_id])
            ->andFilterWhere(['like', 'frequency', $this->frequency])
            ->andFilterWhere(['like', 'hours', $this->hours])
            ->andFilterWhere(['like', 'days', $this->days])
            ->andFilterWhere(['like', 'service_staffs', $this->service_staffs])
            ->andFilterWhere(['like', 'rate_card_value', $this->rate_card_value])
            ->andFilterWhere(['like', 'client_notes', $this->client_notes]);

        return $dataProvider;
    }
}
