<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\NotificationViewStatus;

/**
 * NotificationViewStatusSearch represents the model behind the search form about `common\models\NotificationViewStatus`.
 */
class NotificationViewStatusSearch extends NotificationViewStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'reference_id', 'history_id', 'notifiaction_type_id', 'staff_type', 'staff_id_', 'view_status'], 'integer'],
            [['content', 'date'], 'safe'],
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
        $query = NotificationViewStatus::find();

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
            'reference_id' => $this->reference_id,
            'history_id' => $this->history_id,
            'notifiaction_type_id' => $this->notifiaction_type_id,
            'staff_type' => $this->staff_type,
            'staff_id_' => $this->staff_id_,
            'view_status' => $this->view_status,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
