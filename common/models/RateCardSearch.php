<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RateCard;

/**
 * RateCardSearch represents the model behind the search form about `common\models\RateCard`.
 */
class RateCardSearch extends RateCard {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'service_id', 'status', 'CB', 'UB'], 'integer'],
                        [['rate_card_name', 'rate_per_hour', 'rate_per_visit', 'rate_per_day', 'rate_per_night', 'rate_per_day_night', 'period_from', 'period_to', 'DOC', 'DOU', 'branch_id', 'sub_service'], 'safe'],
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
                $query = RateCard::find();

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
                    'service_id' => $this->service_id,
                    'period_from' => $this->period_from,
                    'period_to' => $this->period_to,
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'rate_card_name', $this->rate_card_name])
                        ->andFilterWhere(['like', 'rate_per_hour', $this->rate_per_hour])
                        ->andFilterWhere(['like', 'rate_per_visit', $this->rate_per_visit])
                        ->andFilterWhere(['like', 'rate_per_day', $this->rate_per_day])
                        ->andFilterWhere(['like', 'rate_per_night', $this->rate_per_night])
                        ->andFilterWhere(['like', 'branch_id', $this->branch_id])
                        ->andFilterWhere(['like', 'sub_service', $this->sub_service])
                        ->andFilterWhere(['like', 'rate_per_day_night', $this->rate_per_day_night]);

                return $dataProvider;
        }

}
