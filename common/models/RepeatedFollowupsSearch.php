<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RepeatedFollowups;

/**
 * RepeatedFollowupsSearch represents the model behind the search form about `common\models\RepeatedFollowups`.
 */
class RepeatedFollowupsSearch extends RepeatedFollowups
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'sub_type', 'type_id', 'assigned_to', 'assigned_from', 'assigned_to_type', 'releated_notification_patient', 'repeated', 'repeated_type', 'status', 'CB', 'UB'], 'integer'],
            [['followup_date', 'followup_notes', 'attachments', 'related_staffs', 'repeated_days', 'DOC', 'DOU'], 'safe'],
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
        $query = RepeatedFollowups::find();

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
            'type' => $this->type,
            'sub_type' => $this->sub_type,
            'type_id' => $this->type_id,
            'followup_date' => $this->followup_date,
            'assigned_to' => $this->assigned_to,
            'assigned_from' => $this->assigned_from,
            'assigned_to_type' => $this->assigned_to_type,
            'releated_notification_patient' => $this->releated_notification_patient,
            'repeated' => $this->repeated,
            'repeated_type' => $this->repeated_type,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'followup_notes', $this->followup_notes])
            ->andFilterWhere(['like', 'attachments', $this->attachments])
            ->andFilterWhere(['like', 'related_staffs', $this->related_staffs])
            ->andFilterWhere(['like', 'repeated_days', $this->repeated_days]);

        return $dataProvider;
    }
}
