<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_general".
 *
 * @property integer $id
 * @property integer $patient_enquiry_id
 * @property integer $branch_id
 * @property string $patient_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $gender
 * @property integer $age
 * @property string $blood_group
 * @property string $patient_image
 * @property string $present_address
 * @property integer $pin_code
 * @property string $landmark
 * @property integer $contact_number
 * @property string $email
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class PatientGeneral extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'patient_general';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['patient_id', 'first_name'], 'required'],
                        [['id', 'patient_enquiry_id', 'branch_id', 'gender', 'pin_code', 'contact_number', 'status', 'CB', 'UB', 'age', 'terms_conditions', 'average_point'], 'integer'],
                        [['present_address'], 'string'],
                        [['DOC', 'DOU'], 'safe'],
                        [['patient_id', 'first_name', 'last_name', 'patient_image', 'landmark', 'email', 'patient_old_id', 'staff_manager'], 'string', 'max' => 100],
                        [['blood_group'], 'string', 'max' => 50],
                        [['patient_id'], 'unique', 'message' => 'Patient ID must be unique.'],
                        [['branch_id'], 'required', 'when' => function ($model) {
                                return Yii::$app->user->identity->branch_id == 0;
                        },],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'patient_enquiry_id' => 'Patient Enquiry ID',
                    'branch_id' => 'Branch',
                    'patient_id' => 'Patient ID',
                    'patient_old_id' => 'Patient Old ID',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'gender' => 'Gender',
                    'age' => 'Age',
                    'dob' => 'DOB',
                    'blood_group' => 'Blood Group',
                    'patient_image' => 'Patient Image',
                    'present_address' => 'Present Address',
                    'pin_code' => 'Pin Code',
                    'landmark' => 'Landmark',
                    'contact_number' => 'Contact Number',
                    'email' => 'Email',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                    'average_point' => 'Rating',
                    'staff_manager' => ' Manager',
                ];
        }

        public function getPatientGuardianInfo() {
                return $this->hasOne(PatientGuardianDetails::className(), ['patient_id' => 'id']);
        }

        public static function Total($from, $to, $id) {
                $services = ServiceSchedule::find()->where(['patient_id' => $id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->groupBy(['service_id'])->all();
                $due_amount = 0;
                foreach ($services as $value) {
                        $service_detail = Service::findOne($value->service_id);

                        $due_amount += $service_detail->due_amount;
                }
                $due_amount = Yii::$app->NumToWord->NumberFormat($due_amount);
                return $due_amount;
        }

         public static function Check($id) {
                $not_uploaded = \common\components\SetValues::Check($id, 1);

                if (count($not_uploaded) > 0)
                        return '1';
                else
                        return '0';
        }

}
