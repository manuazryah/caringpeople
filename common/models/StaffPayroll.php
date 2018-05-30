<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_payroll".
 *
 * @property integer $id
 * @property integer $staff_id
 * @property string $month
 * @property string $year
 * @property integer $type
 * @property string $amount
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property StaffInfo $staff
 */
class StaffPayroll extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_payroll';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['staff_id', 'type', 'CB', 'UB', 'branch_id', 'selected_month'], 'integer'],
                        [['DOC', 'DOU', 'payment_date', 'date_from', 'date_to'], 'safe'],
                        [['month', 'year', 'amount'], 'string', 'max' => 200],
                        [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaffInfo::className(), 'targetAttribute' => ['staff_id' => 'id']],
                        [['staff_id', 'branch_id', 'month'], 'required', 'on' => 'payment'],
                        [['amount', 'type'], 'required', 'on' => 'cash-payment'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'branch_id' => 'Branch',
                    'staff_id' => 'Staff',
                    'month' => 'Month',
                    'year' => 'Year',
                    'type' => 'Type',
                    'amount' => 'Amount',
                    'payment_date' => 'Payment Date',
                    'selected_month' => 'Month',
                    'date_from' => 'Date From',
                    'date_to' => 'Date To',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getStaff() {
                return $this->hasOne(StaffInfo::className(), ['id' => 'staff_id']);
        }

        public static function Liststaffs() {
                $currently_selected = date('Y');
                $earliest_year = date("Y", strtotime("-5 year"));
                $latest_year = date("Y", strtotime("+10 year"));
                foreach (range($earliest_year, $latest_year) as $i) {
                        $year[$i] .= $i;
                }
                return $year;
        }

}
