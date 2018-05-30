<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $country_name
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property City[] $cities
 * @property State[] $states
 */
class Country extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['country_name', 'status'], 'required'],
            [['status'], 'integer'],
            [['DOC', 'DOU', 'CB', 'UB'], 'safe'],
            [['country_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'country_name' => 'Country Name',
            'status' => 'Status',
            'CB' => 'Created By',
            'UB' => 'Updated By',
            'DOC' => 'Date of Creation',
            'DOU' => 'Date of Updation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities() {
        return $this->hasMany(City::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStates() {
        return $this->hasMany(State::className(), ['country_id' => 'id']);
    }

}
