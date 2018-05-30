<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $state_name
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property City[] $cities
 * @property Country $country
 */
class State extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'state';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['country_id', 'state_name','status'], 'required'],
                        [['country_id', 'status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['state_name'], 'string', 'max' => 100],
                        [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'country_id' => 'Country',
                    'state_name' => 'State Name',
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
                return $this->hasMany(City::className(), ['state_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getCountry() {
                return $this->hasOne(Country::className(), ['id' => 'country_id']);
        }

}
