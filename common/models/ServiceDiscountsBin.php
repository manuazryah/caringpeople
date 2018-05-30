<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_discounts_bin".
 *
 * @property integer $id
 * @property integer $service_id
 * @property string $rate
 * @property integer $discount_type
 * @property string $discount_value
 * @property string $total_amount
 * @property string $date
 */
class ServiceDiscountsBin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_discounts_bin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'discount_type'], 'integer'],
            [['date'], 'safe'],
            [['rate', 'discount_value', 'total_amount'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'rate' => 'Rate',
            'discount_type' => 'Discount Type',
            'discount_value' => 'Discount Value',
            'total_amount' => 'Total Amount',
            'date' => 'Date',
        ];
    }
}
