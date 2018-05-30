<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "expense_type".
 *
 * @property integer $id
 * @property string $type
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Expenses[] $expenses
 */
class ExpenseType extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'expense_type';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['type'], 'required'],
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['type'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'type' => 'Type',
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
        public function getExpenses() {
                return $this->hasMany(Expenses::className(), ['expense_type' => 'id']);
        }

}
