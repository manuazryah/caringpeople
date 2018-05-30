<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "refund_amount".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $service_id
 * @property string $refund_amount
 */
class RefundAmount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'refund_amount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'service_id'], 'integer'],
            [['refund_amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'service_id' => 'Service ID',
            'refund_amount' => 'Refund Amount',
        ];
    }
}
