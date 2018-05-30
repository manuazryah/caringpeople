<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ContactDirectory;

/**
 * ContactDirectorySearch represents the model behind the search form about `common\models\ContactDirectory`.
 */
class ContactDirectorySearch extends ContactDirectory {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'category_type', 'field_1', 'field_2', 'CB', 'UB'], 'integer'],
                        [['name', 'email_1', 'email_2', 'phone_1', 'phone_2', 'designation', 'company_name', 'references', 'remarks', 'DOC', 'DOU', 'subcategory_type'], 'safe'],
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
                $query = ContactDirectory::find();

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
                    'category_type' => $this->category_type,
                    'subcategory_type' => $this->subcategory_type,
                    'field_1' => $this->field_1,
                    'field_2' => $this->field_2,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'name', $this->name])
                        ->andFilterWhere(['like', 'email_1', $this->email_1])
                        ->andFilterWhere(['like', 'email_2', $this->email_2])
                        ->andFilterWhere(['like', 'phone_1', $this->phone_1])
                        ->andFilterWhere(['like', 'phone_2', $this->phone_2])
                        ->andFilterWhere(['like', 'designation', $this->designation])
                        ->andFilterWhere(['like', 'company_name', $this->company_name])
                        ->andFilterWhere(['like', 'references', $this->references])
                        ->andFilterWhere(['like', 'remarks', $this->remarks]);

                return $dataProvider;
        }

}
