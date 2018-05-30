<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_salary".
 *
 * @property integer $id
 * @property integer $staff_id
 * @property string $basic_salary
 * @property string $food_and_accomodation
 * @property string $conveyance
 * @property string $lta
 * @property string $medical_allowance
 * @property string $other_allowances
 * @property string $stipend
 * @property string $PF_deduction
 * @property string $ESI_deduction
 * @property string $other_deduction
 * @property string $date_of_salary
 *
 * @property StaffInfo $staff
 */
class StaffSalary extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_salary';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['staff_id'], 'integer'],
                        [['date_of_salary'], 'safe'],
                        [['basic_salary', 'hra', 'food_and_accomodation', 'conveyance', 'lta', 'medical_allowance', 'other_allowances', 'stipend', 'PF_deduction', 'ESI_deduction', 'other_deduction'], 'string', 'max' => 200],
                        [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaffInfo::className(), 'targetAttribute' => ['staff_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'staff_id' => 'Staff ID',
                    'basic_salary' => 'Basic Salary',
                    'hra' => 'HRA',
                    'food_and_accomodation' => 'Food And Accomodation',
                    'conveyance' => 'Conveyance',
                    'lta' => 'Lta',
                    'medical_allowance' => 'Medical Allowance',
                    'other_allowances' => 'Other Allowances',
                    'stipend' => 'Stipend',
                    'PF_deduction' => 'Pf Deduction',
                    'ESI_deduction' => 'Esi Deduction',
                    'other_deduction' => 'Other Deduction',
                    'date_of_salary' => 'Date Of Salary',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getStaff() {
                return $this->hasOne(StaffInfo::className(), ['id' => 'staff_id']);
        }

}
