<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServiceSchedule;

/**
 * ServiceScheduleSearch represents the model behind the search form about `common\models\ServiceSchedule`.
 */
class ServiceScheduleSearch extends ServiceSchedule {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'service_id', 'patient_id', 'staff', 'rating', 'status', 'CB', 'UB'], 'integer'],
                        [['date', 'remarks_from_manager', 'remarks_from_staff', 'remarks_from_patient', 'rate', 'patient_rate', 'time_in', 'time_out', 'DOC', 'DOU'], 'safe'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function scenarios() {
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
        public function search($params) {
                $query = ServiceSchedule::find();

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
                    'service_id' => $this->service_id,
                    'patient_id' => $this->patient_id,
                    //  'date' => $this->date,
                    'staff' => $this->staff,
                    'rating' => $this->rating,
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'remarks_from_manager', $this->remarks_from_manager])
                        ->andFilterWhere(['like', 'date', $this->date])
                        ->andFilterWhere(['like', 'remarks_from_staff', $this->remarks_from_staff])
                        ->andFilterWhere(['like', 'remarks_from_patient', $this->remarks_from_patient])
                        ->andFilterWhere(['like', 'rate', $this->rate])
                        ->andFilterWhere(['like', 'patient_rate', $this->patient_rate])
                        ->andFilterWhere(['like', 'time_in', $this->time_in])
                        ->andFilterWhere(['like', 'time_out', $this->time_out]);

                return $dataProvider;
        }

}
