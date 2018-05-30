<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "expenses".
 *
 * @property integer $id
 * @property integer $expense_type
 * @property string $expense_subtype
 * @property string $amount
 * @property string $date
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property ExpenseType $expenseType
 */
class Expenses extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'expenses';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['expense_type', 'expense_subtype', 'amount', 'date'], 'required'],
                        [['expense_type', 'status', 'CB', 'UB'], 'integer'],
                        [['date', 'DOC', 'DOU'], 'safe'],
                        [['expense_subtype', 'amount', 'notes'], 'string', 'max' => 200],
                        [['expense_type'], 'exist', 'skipOnError' => true, 'targetClass' => ExpenseType::className(), 'targetAttribute' => ['expense_type' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'expense_type' => 'Expense Type',
                    'expense_subtype' => 'Expense Subtype',
                    'amount' => 'Amount',
                    'date' => 'Date',
                    'notes' => 'Notes',
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
        public function getExpenseType() {
                return $this->hasOne(ExpenseType::className(), ['id' => 'expense_type']);
        }

}
