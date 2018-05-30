<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rate_card".
 *
 * @property integer $id
 * @property integer $service_id
 * @property string $rate_card_name
 * @property string $rate_per_hour
 * @property string $rate_per_visit
 * @property string $rate_per_day
 * @property string $rate_per_night
 * @property string $rate_per_day_night
 * @property string $period_from
 * @property string $period_to
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property MasterServiceTypes $service
 */
class RateCard extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'rate_card';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['service_id', 'branch_id'], 'required'],
                        [['service_id', 'status', 'CB', 'UB', 'branch_id', 'sub_service'], 'integer'],
                        [['period_from', 'period_to', 'DOC', 'DOU'], 'safe'],
                        [['rate_card_name', 'rate_per_hour', 'rate_per_visit', 'rate_per_day', 'rate_per_night', 'rate_per_day_night', 'staff_price', 'estimated_staff_price'], 'string', 'max' => 200],
                        [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => MasterServiceTypes::className(), 'targetAttribute' => ['service_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'service_id' => 'Service',
                    'sub_service' => 'Sub Service',
                    'rate_card_name' => 'Rate Card Name',
                    'rate_per_hour' => 'Rate Per Hour',
                    'rate_per_visit' => 'Rate Per Visit',
                    'rate_per_day' => 'Rate Per Day',
                    'rate_per_night' => 'Rate Per Night',
                    'rate_per_day_night' => 'Rate Per Day & Night',
                    'period_from' => 'Period From',
                    'period_to' => 'Period To',
                    'staff_price' => 'Staff Price',
                    'estimated_staff_price' => 'Estimated Staff Price',
                    'branch_id' => 'Branch',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getService() {
                return $this->hasOne(MasterServiceTypes::className(), ['id' => 'service_id']);
        }

        public function getSubservice() {
                return $this->hasOne(SubServices::className(), ['id' => 'sub_service']);
        }

}
