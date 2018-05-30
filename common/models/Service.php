<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $service_id
 * @property integer $service
 * @property integer $staff_id
 * @property integer $staff_manager
 * @property string $from_date
 * @property string $to_date

 * @property string $estimated_price
 * @property string $branch_id
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property PatientGeneral $patient
 * @property MasterServiceTypes $service0
 * @property StaffInfo $staff
 * @property StaffInfo $staffManager
 */
class Service extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'service';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['patient_id', 'service', 'staff_manager', 'status', 'CB', 'UB', 'duty_type', 'gender_preference', 'day_night_staff', 'sub_service', 'status', 'co_worker','registration_fees','proforma_sent','change_estimated_price'], 'integer'],
                        [['from_date', 'to_date', 'DOC', 'DOU', 'estimated_bill_date'], 'safe'],
                        [['frequency', 'hours', 'days'], 'string', 'max' => 255],
                        [['estimated_price', 'due_amount', 'registration_fees_amount',  'rate_card_value'], 'number'],
                        [['client_notes'], 'string'],
                        [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => PatientGeneral::className(), 'targetAttribute' => ['patient_id' => 'id']],
                        [['service'], 'exist', 'skipOnError' => true, 'targetClass' => MasterServiceTypes::className(), 'targetAttribute' => ['service' => 'id']],
                        [['staff_manager'], 'exist', 'skipOnError' => true, 'targetClass' => StaffInfo::className(), 'targetAttribute' => ['staff_manager' => 'id']],
                        [['patient_id', 'service', 'from_date', 'to_date', 'status'], 'required', 'on' => 'create'],
                        [['patient_id', 'service', 'from_date', 'to_date', 'status', 'days'], 'required', 'on' => 'create'],
                        [['branch_id', 'duty_type'], 'required', 'on' => 'create'],
                        [['day_night_staff'], 'required', 'when' => function ($model) {

                        }, 'whenClient' => "function (attribute, value) {
               return $('#service-duty_type').val() == '5';
            }"],
                ];
        }

//        public function getStaffName() {
//                return $this->day_staff . ' ' . $this->night_staff;
//        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'patient_id' => 'Patient',
                    'service' => 'Service',
                    'sub_service' => 'Sub Service',
                    'gender_preference' => 'Staff Preference',
                    'staff_manager' => 'Staff Manager',
                    'duty_type' => 'Duty Type',
                    'staff_manager' => 'Staff Manager',
                    'from_date' => 'Period From',
                    'to_date' => 'Period To',
                    'estimated_price' => 'Estimated Price',
                    'branch_id' => 'Branch',
                    'status' => 'Status',
                    'staffName' => Yii::t('app', 'Staff'),
                    'frequency' => 'Frequency',
                    'day_night_staff' => 'Staff for Day and Night',
                    'hours' => 'Hours',
                    'days' => 'Days',
                    'service_staffs' => 'service_staffs',
                    'co_worker' => 'Co-Worker',
                    'due_amount' => 'Due amount',
                    'registration_fees'=>'Registration fees',
                    'registration_fees_amount' => 'Amount',
                    'client_notes' => 'Client Notes',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                    'status' => 'Status',
                    'proforma_sent' => 'Sent Proforma',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
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
