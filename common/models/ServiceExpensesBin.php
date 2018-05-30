<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_expenses_bin".
 *
 * @property integer $id
 * @property integer $service_id
 * @property string $expense
 * @property string $expense_amount
 */
class ServiceExpensesBin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_expenses_bin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id'], 'integer'],
            [['expense_amount'], 'number'],
            [['expense'], 'string', 'max' => 255],
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
            'expense' => 'Expense',
            'expense_amount' => 'Expense Amount',
        ];
    }
}
