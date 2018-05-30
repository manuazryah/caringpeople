<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_bin".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property string $service_id
 * @property integer $patient_id
 * @property integer $service
 * @property integer $sub_service
 * @property integer $gender_preference
 * @property integer $duty_type
 * @property integer $day_night_staff
 * @property string $frequency
 * @property string $hours
 * @property string $days
 * @property integer $staff_manager
 * @property string $from_date
 * @property string $to_date
 * @property string $estimated_price
 * @property string $service_staffs
 * @property integer $co_worker
 * @property string $rate_card_value
 * @property integer $registration_fees
 * @property string $registration_fees_amount
 * @property string $due_amount
 * @property string $client_notes
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class ServiceBin extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'service_bin';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['branch_id', 'patient_id', 'service', 'sub_service', 'gender_preference', 'duty_type', 'day_night_staff', 'staff_manager', 'co_worker', 'registration_fees', 'status', 'CB', 'UB','service_table_id', 'proforma_sent'], 'integer'],
                        [['from_date', 'to_date', 'DOC', 'DOU'], 'safe'],
                        [['estimated_price', 'registration_fees_amount', 'due_amount'], 'number'],
                        [['client_notes'], 'string'],
                        [['service_id', 'frequency', 'hours', 'days', 'rate_card_value'], 'string', 'max' => 200],
                        [['service_staffs'], 'string', 'max' => 255],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'branch_id' => 'Branch',
                    'service_id' => 'Service ID',
                    'patient_id' => 'Patient ID',
                    'service' => 'Service',
                    'sub_service' => 'Sub Service',
                    'gender_preference' => 'Gender Preference',
                    'duty_type' => 'Duty Type',
                    'day_night_staff' => 'Day Night Staff',
                    'frequency' => 'Frequency',
                    'hours' => 'Hours',
                    'days' => 'Days',
                    'staff_manager' => 'Staff Manager',
                    'from_date' => 'From Date',
                    'to_date' => 'To Date',
                    'estimated_price' => 'Estimated Price',
                    'service_staffs' => 'Service Staffs',
                    'co_worker' => 'Co Worker',
                    'rate_card_value' => 'Rate Card Value',
                    'registration_fees' => 'Registration Fees',
                    'registration_fees_amount' => 'Registration Fees Amount',
                    'due_amount' => 'Due Amount',
                    'client_notes' => 'Client Notes',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        public function getPatient() {
                return $this->hasOne(PatientGeneral::className(), ['id' => 'patient_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getService0() {
                return $this->hasOne(MasterServiceTypes::className(), ['id' => 'service']);
        }

        public function getSubservice() {
                return $this->hasOne(SubServices::className(), ['id' => 'sub_service']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getStaffManager() {
                return $this->hasOne(StaffInfo::className(), ['id' => 'staff_manager']);
        }

        public function getBranch() {
                return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
        }

        public static function PendingSchedules($id) {
                $pending_schedules = 0;
                $pending_schedules = ServiceSchedule::find()->where(['service_id' => $id, 'status' => 1])->count();
                return $pending_schedules;
        }

}
