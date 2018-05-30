<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_discounts".
 *
 * @property integer $id
 * @property integer $service_id
 * @property string $rate
 * @property integer $discount_type
 * @property string $discount_value
 * @property string $total_amount
 *
 * @property Service $service
 */
class ServiceDiscounts extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'service_discounts';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['total_amount'], 'required'],
                        [['service_id', 'discount_type'], 'integer'],
                        [['rate', 'discount_value', 'total_amount'], 'string', 'max' => 200],
                        [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'service_id' => 'Service ID',
                    'rate' => 'Rate',
                    'discount_type' => 'Discount Type',
                    'discount_value' => 'Discount Value',
                    'total_amount' => 'Total Amount',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getService() {
                return $this->hasOne(Service::className(), ['id' => 'service_id']);
        }

}
