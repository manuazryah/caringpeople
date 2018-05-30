<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Service;

/**
 * ServiceSearch represents the model behind the search form about `common\models\Service`.
 */
class ServiceSearch extends Service {

        public $staffName;
        public $pending_schedules;
        public $compare; //compare value
        public $compareOp; //compare operator, for example [>,<,>=,<=]

        /**
         * @inheritdoc
         */

        public function rules() {
                return [
                        [['id', 'patient_id', 'service', 'staff_manager', 'status', 'branch_id', 'CB', 'UB'], 'integer'],
                        [['from_date', 'to_date', 'estimated_price', 'service_id', 'DOC', 'DOU', 'duty_type', 'pending_schedules', 'days', 'due_amount', 'compare', 'compareOp','proforma_sent'], 'safe'],
                        [['staffName'], 'safe']
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
                $query = Service::find();


                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['defaultOrder' => ['id' => SORT_DESC,
                        ]]
                ]);


                $this->load($params);


                if (!isset($params["Service"]["compareOp"])) {
                        $operator = '';
                } else {
                        $operator = $params["Service"]["compareOp"];
                }
                if (!isset($params["Service"]["compare"])) {
                        $val = '';
                } else {
                        $val = $params["Service"]["compare"];
                }
                if (!$this->validate()) {
                        // uncomment the following line if you do not want to return any records when validation fails
                        // $query->where('0=1');
                        return $dataProvider;
                }

                // grid filtering conditions
                $query->andFilterWhere([
                    'id' => $this->id,
                    'patient_id' => $this->patient_id,
                    'service' => $this->service,
                    'duty_type' => $this->duty_type,
                    'staff_manager' => $this->staff_manager,
                    'from_date' => $this->from_date,
                    'to_date' => $this->to_date,
                    'branch_id' => $this->branch_id,
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);


                $query->andFilterWhere(['like', 'estimated_price', $this->estimated_price])
                        ->andFilterWhere([$operator, 'due_amount', $val])
                        ->andFilterWhere(['like', 'days', $this->days])
                        ->andFilterWhere(['like', 'proforma_sent', $this->proforma_sent])
                        ->andFilterWhere(['like', 'service_id', $this->service_id]);

                return $dataProvider;
        }

}
