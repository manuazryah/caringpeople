<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EnquiryHospital;

/**
 * EnquiryHospitalSearch represents the model behind the search form about `common\models\EnquiryHospital`.
 */
class EnquiryHospitalSearch extends EnquiryHospital {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'enquiry_id'], 'integer'],
                        [['hospital_name', 'consultant_doctor', 'hospital_room_no', 'required_service', 'other_services', 'diabetic', 'hypertension', 'tubes', 'feeding', 'urine', 'oxygen', 'tracheostomy', 'iv_line', 'dressing', 'visit_type', 'visit_date', 'bedridden'], 'safe'],
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
                $query = EnquiryHospital::find();

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
                    'visit_date' => $this->visit_date,
                ]);

                $query->andFilterWhere(['like', 'hospital_name', $this->hospital_name])
                        ->andFilterWhere(['like', 'consultant_doctor', $this->consultant_doctor])
                        ->andFilterWhere(['like', 'hospital_room_no', $this->hospital_room_no])
                        ->andFilterWhere(['like', 'required_service', $this->required_service])
                        ->andFilterWhere(['like', 'other_services', $this->other_services])
                        ->andFilterWhere(['like', 'diabetic', $this->diabetic])
                        ->andFilterWhere(['like', 'hypertension', $this->hypertension])
                        ->andFilterWhere(['like', 'tubes', $this->tubes])
                        ->andFilterWhere(['like', 'feeding', $this->feeding])
                        ->andFilterWhere(['like', 'urine', $this->urine])
                        ->andFilterWhere(['like', 'oxygen', $this->oxygen])
                        ->andFilterWhere(['like', 'tracheostomy', $this->tracheostomy])
                        ->andFilterWhere(['like', 'iv_line', $this->iv_line])
                        ->andFilterWhere(['like', 'dressing', $this->dressing])
                        ->andFilterWhere(['like', 'visit_type', $this->home_or_hospital_visit])
                        ->andFilterWhere(['like', 'bedridden', $this->bedridden]);

                return $dataProvider;
        }

}
