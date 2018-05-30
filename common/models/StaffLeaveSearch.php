<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StaffLeave;

/**
 * StaffLeaveSearch represents the model behind the search form about `common\models\StaffLeave`.
 */
class StaffLeaveSearch extends StaffLeave {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id', 'employee_id', 'no_of_days', 'leave_type', 'status', 'CB'], 'integer'],
			[['commencing_date', 'ending_date', 'purpose', 'DOC'], 'safe'],
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
		$query = StaffLeave::find();

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
		    'employee_id' => $this->employee_id,
		    'no_of_days' => $this->no_of_days,
		    'leave_type' => $this->leave_type,
		    'commencing_date' => $this->commencing_date,
		    'ending_date' => $this->ending_date,
		    'status' => $this->status,
		    'CB' => $this->CB,
		    'DOC' => $this->DOC,
		]);

		$query->andFilterWhere(['like', 'purpose', $this->purpose]);

		return $dataProvider;
	}

}
