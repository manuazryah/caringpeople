<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MasterDesignations;

/**
 * MasterDesignationsSearch represents the model behind the search form about `common\models\MasterDesignations`.
 */
class MasterDesignationsSearch extends MasterDesignations {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'status', 'CB', 'UB'], 'integer'],
                        [['title', 'DOC', 'DOU'], 'safe'],
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
                $query = MasterDesignations::find();

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
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'title', $this->title]);

                return $dataProvider;
        }

}
