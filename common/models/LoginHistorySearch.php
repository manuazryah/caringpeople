<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LoginHistory;

/**
 * LoginHistorySearch represents the model behind the search form about `common\models\LoginHistory`.
 */
class LoginHistorySearch extends LoginHistory {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'type', 'staff_id', 'patient_id'], 'integer'],
                        [['logged_in', 'logged_out', 'DOC', 'DOU'], 'safe'],
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
                $query = LoginHistory::find();

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
                if (!empty($params['LoginHistorySearch']['logged_in'])) {

                        $query->andFilterWhere(['like', 'logged_in', date('Y-m-d', strtotime($params['LoginHistorySearch']['logged_in']))]);
                }
                if (!empty($params['LoginHistorySearch']['logged_out'])) {

                        $query->andFilterWhere(['like', 'logged_out', date('Y-m-d', strtotime($params['LoginHistorySearch']['logged_out']))]);
                }

                // grid filtering conditions
                $query->andFilterWhere([
                    'id' => $this->id,
                    'type' => $this->type,
                    'staff_id' => $this->staff_id,
                    'patient_id' => $this->patient_id,
                    //    'logged_in' => $this->logged_in,
                    //   'logged_out' => $this->logged_out,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);


                return $dataProvider;
        }

}
