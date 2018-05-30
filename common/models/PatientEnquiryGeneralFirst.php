<?php

namespace common\models;

use Yii;
use common\models\PatientEnquiryGeneralSecond;

/**
 * This is the model class for table "patient_enquiry_general_first".
 *
 * @property integer $id
 * @property string $enquiry_number
 * @property integer $contacted_source
 * @property string $contacted_date
 * @property string $incoming_missed
 * @property string $outgoing_number_from
 * @property string $outgoing_number_from_other
 * @property string $outgoing_call_date
 * @property string $caller_name
 * @property integer $caller_gender
 * @property string $referral_source
 * @property string $referral_source_others
 * @property string $mobile_number
 * @property string $mobile_number_2
 * @property string $mobile_number_3
 * @property integer $branch_id
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class PatientEnquiryGeneralFirst extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'patient_enquiry_general_first';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['contacted_source', 'status', 'referral_source'], 'required', 'on' => 'create'],
                        [['incoming_missed'], 'required', 'message' => "Contact Source Data cannot be blank"],
                        [['contacted_source', 'caller_gender', 'branch_id', 'status', 'CB', 'UB', 'terms_conditions'], 'integer'],
                        [['contacted_date', 'outgoing_call_date', 'DOC', 'DOU'], 'safe'],
                        [['enquiry_number', 'outgoing_number_from_other', 'referral_source_others'], 'string', 'max' => 200],
                        [['incoming_missed', 'outgoing_number_from', 'caller_name', 'referral_source', 'mobile_number', 'mobile_number_2', 'mobile_number_3', 'incoming_missed_other'], 'string', 'max' => 100],
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
                    'enquiry_number' => 'Enquiry Number',
                    'contacted_source' => 'Contacted Source',
                    'contacted_date' => 'Contacted Date',
                    'incoming_missed' => 'Incoming Missed',
                    'incoming_missed_other' => 'Incoming/Missed Other',
                    'outgoing_number_from' => 'Outgoing Number From',
                    'outgoing_number_from_other' => 'Outgoing Number From Other',
                    'outgoing_call_date' => 'Outgoing Call Date',
                    'caller_name' => 'Caller Name',
                    'caller_gender' => 'Gender',
                    'referral_source' => 'Referral Source',
                    'referral_source_others' => 'Referral Source Others',
                    'mobile_number' => 'Mobile Number',
                    'mobile_number_2' => 'Mobile Number 2',
                    'mobile_number_3' => 'Mobile Number 3',
                    'branch_id' => 'Branch',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        public function getPatientGeneralInfo() {
                return $this->hasOne(PatientEnquiryGeneralSecond::className(), ['enquiry_id' => 'id']);
        }

        public function getPatientHospitalInfo() {
                return $this->hasOne(PatientEnquiryHospitalFirst::className(), ['enquiry_id' => 'id']);
        }

        public function getPatientHospitalMedical() {
                return $this->hasOne(PatientEnquiryHospitalSecond::className(), ['enquiry_id' => 'id']);
        }

       public function getPatientAssessment() {
                return $this->hasOne(PatientAssessment::className(), ['patient_enquiry_id' => 'id']);
        }

        public static function Service($id) {
                $patient_details = PatientEnquiryGeneralSecond::find()->where(['enquiry_id' => $id])->one();
                $required_services = explode(',', $patient_details->required_service);
                $services = '';
                $i = 0;
                if (!empty($required_services)) {
                        foreach ($required_services as $service) {

                                if ($i != 0) {
                                        $services .= ',';
                                }
                                if ($service == '1') {
                                        $services .= 'DV';
                                } else if ($service == '2') {
                                        $services .= 'Nursing Care';
                                } else if ($service == '3') {
                                        $services .= 'Physiotherapy';
                                } else if ($service == '5') {
                                        $services .= 'Caregiver';
                                } else if ($service == '4') {
                                        $services .= 'Helath Checkup';
                                } else if ($service == '6') {
                                        $services .= 'Lab';
                                } else if ($service == '7') {
                                        $services .= 'Equipment';
                                } else if ($service == '8') {
                                        $services .= 'Other';
                                } else if ($service == '9') {
                                        $services .= 'General Enquiry';
                                } else if ($service == '10') {
                                        $services .= 'Wrong Number';
                                }
                                $i++;
                        }
                }

                return $services;
        }

}
