<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AttendanceEntry;

/**
 * AttendanceEntrySearch represents the model behind the search form about `common\models\AttendanceEntry`.
 */
class AttendanceEntrySearch extends AttendanceEntry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'attendance_id', 'staff_id', 'total_hours', 'over_time', 'attendance', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
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
        $query = AttendanceEntry::find();

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
            'attendance_id' => $this->attendance_id,
            'staff_id' => $this->staff_id,
            'total_hours' => $this->total_hours,
            'over_time' => $this->over_time,
            'attendance' => $this->attendance,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        return $dataProvider;
    }
}
