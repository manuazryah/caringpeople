<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_schedule_history".
 *
 * @property integer $id
 * @property integer $service_id
 * @property integer $schedules
 * @property string $price
 * @property string $date
 */
class ServiceScheduleHistory extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'service_schedule_history';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['service_id', 'schedules'], 'integer'],
                        [['date'], 'safe'],
                        [['price'], 'number'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'service_id' => 'Service ID',
                    'schedules' => 'Schedules',
                    'price' => 'Price',
                    'date' => 'Date',
                ];
        }

}
