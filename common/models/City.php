<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property integer $country_id
 * @property integer $state_id
 * @property string $city_name
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Country $country
 * @property State $state
 */
class City extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'city';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['country_id', 'state_id', 'city_name'], 'required'],
                        [['country_id', 'state_id', 'status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['city_name'], 'string', 'max' => 100],
                        [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
                        [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'country_id' => 'Country',
                    'state_id' => 'State',
                    'city_name' => 'City Name',
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
        public function getCountry() {
                return $this->hasOne(Country::className(), ['id' => 'country_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getState() {
                return $this->hasOne(State::className(), ['id' => 'state_id']);
        }

}
