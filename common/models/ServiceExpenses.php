<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_expenses".
 *
 * @property integer $id
 * @property integer $service_id
 * @property string $expense
 * @property string $expense_amount
 *
 * @property Service $service
 */
class ServiceExpenses extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'service_expenses';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['service_id'], 'integer'],
                        [['expense_amount'], 'number'],
                        [['expense'], 'string', 'max' => 255],
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
                    'expense' => 'Expense',
                    'expense_amount' => 'Expense Amount',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getService() {
                return $this->hasOne(Service::className(), ['id' => 'service_id']);
        }

}
