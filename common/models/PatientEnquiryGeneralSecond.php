<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_enquiry_general_second".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property string $address
 * @property string $city
 * @property string $zip_pc
 * @property string $email
 * @property string $email1
 * @property integer $whatsapp_reply
 * @property string $whatsapp_number
 * @property string $whatsapp_note
 * @property string $required_service
 * @property string $required_service_other
 * @property string $service_required
 * @property string $service_required_other
 * @property integer $expected_date_of_service
 * @property string $how_long_service_required
 * @property integer $visit_type
 * @property string $quotation_details
 * @property string $notes
 * @property integer $priority
 */
class PatientEnquiryGeneralSecond extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'patient_enquiry_general_second';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['required_service', 'priority'], 'required'],
                        [['email', 'email1'], 'email'],
                        [['enquiry_id', 'whatsapp_reply', 'visit_type', 'priority',], 'integer'],
                        [['whatsapp_note', 'quotation_details', 'notes'], 'string'],
                        [['address', 'email1', 'whatsapp_number', 'required_service_other', 'service_required', 'service_required_other', 'how_long_service_required'], 'string', 'max' => 200],
                        [['city', 'zip_pc', 'email'], 'string', 'max' => 100],
                        [['caller_name_1', 'caller_gender_1', 'mobile_number_alt_1', 'mobile_number_alt_2', 'mobile_number_alt_3', 'address_1', 'city_1', 'zip_pc_1', 'email_1', 'email_2', 'caller_name_2',
                    'caller_gender_2', 'mobile_number_alt_4', 'mobile_number_alt_5', 'mobile_number_alt_6', 'address_2', 'city_2', 'zip_pc_2', 'email_3', 'email_4'], 'string', 'max' => 250],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'enquiry_id' => 'Enquiry ID',
                    'address' => 'Address',
                    'city' => 'City',
                    'zip_pc' => 'Zip/Pc',
                    'email' => 'Email',
                    'email1' => 'Alternate Email',
                    'whatsapp_reply' => 'Whatsapp Reply',
                    'whatsapp_number' => 'Whatsapp Number',
                    'whatsapp_note' => 'Whatsapp Note',
                    'required_service' => 'Required Service',
                    'required_service_other' => 'Required Service Other',
                    'service_required' => 'Service Required',
                    'service_required_other' => 'Service Required Other',
                    'expected_date_of_service' => 'Expected Date Of Service',
                    'how_long_service_required' => 'Estimated Duration',
                    'visit_type' => 'Visit Type',
                    'quotation_details' => 'Quotation Details',
                    'notes' => 'Notes',
                    'caller_name_1' => 'Caller Name',
                    'caller_gender_1' => 'Caller Gender',
                    'mobile_number_alt_1' => 'Mobile Number',
                    'mobile_number_alt_2' => 'Mobile Number 1',
                    'mobile_number_alt_3' => 'Mobile Number 2',
                    'address_1' => 'Address',
                    'city_1' => 'City',
                    'zip_pc_1' => 'Zip /Pc',
                    'email_1' => 'Email',
                    'email_2' => 'Alternate Email',
                    'caller_name_2' => 'Caller Name',
                    'caller_gender_2' => 'Caller Gender',
                    'mobile_number_alt_4' => 'Mobile Number',
                    'mobile_number_alt_5' => 'Mobile Number 1',
                    'mobile_number_alt_6' => 'Mobile Number 2',
                    'address_2' => 'Address',
                    'city_2' => 'City',
                    'zip_pc_2' => 'Zip/Pc',
                    'email_3' => 'Email',
                    'email_4' => 'Alternate Email',
                ];
        }

}
