<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_information".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property integer $patient_id
 * @property integer $branch_id
 * @property string $contact_address
 * @property string $contact_name
 * @property integer $contact_gender
 * @property string $referral_source
 * @property string $contact_mobile_number_1
 * @property string $contact_mobile_number_2
 * @property string $contact_mobile_number_3
 * @property integer $contact_city
 * @property string $contact_zip_or_pc
 * @property string $contact_email
 * @property integer $contact_perosn_relationship
 * @property string $patient_name
 * @property integer $patient_gender
 * @property integer $patient_age
 * @property integer $patient_weight
 * @property string $other_relationships
 * @property integer $veteran_or_spouse
 * @property string $patient_address
 * @property string $patient_city
 * @property string $patient_postal_code
 * @property integer $patient_current_status
 * @property string $follow_up_date
 * @property string $notes
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class PatientInformation extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'patient_information';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['enquiry_id', 'branch_id', 'contact_gender', 'contact_perosn_relationship', 'patient_gender', 'patient_age', 'patient_weight', 'veteran_or_spouse', 'patient_current_status', 'status', 'CB', 'UB'], 'integer'],
                        [['follow_up_date', 'DOC', 'DOU'], 'safe'],
                        [['notes'], 'string'],
                        [['status'], 'required'],
                        [['contact_address', 'contact_name', 'referral_source', 'contact_mobile_number_1', 'contact_mobile_number_2', 'contact_mobile_number_3', 'contact_zip_or_pc', 'contact_email', 'patient_name', 'other_relationships', 'patient_address', 'patient_city', 'patient_postal_code', 'patient_id'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'enquiry_id' => 'Enquiry ID',
                    'patient_id' => 'Client ID',
                    'branch_id' => 'Branch',
                    'contact_address' => 'Contact Address',
                    'contact_name' => 'Contact Name',
                    'contact_gender' => 'Contact Gender',
                    'referral_source' => 'Referral Source',
                    'contact_mobile_number_1' => 'Contact Mobile Number 1',
                    'contact_mobile_number_2' => 'Contact Mobile Number 2',
                    'contact_mobile_number_3' => 'Contact Mobile Number 3',
                    'contact_city' => 'Contact City',
                    'contact_zip_or_pc' => 'Contact Zip Or Pc',
                    'contact_email' => 'Contact Email',
                    'contact_perosn_relationship' => 'Contact Person Relationship',
                    'patient_name' => 'Patient Name',
                    'patient_gender' => 'Patient Gender',
                    'patient_age' => 'Patient Age',
                    'patient_weight' => 'Patient Weight',
                    'other_relationships' => 'Other Relationships',
                    'veteran_or_spouse' => 'Veteran Or Spouse',
                    'patient_address' => 'Patient Address',
                    'patient_city' => 'Patient City',
                    'patient_postal_code' => 'Patient Postal Code',
                    'patient_current_status' => 'Patient Current Status',
                    'follow_up_date' => 'Follow Up Date',
                    'notes' => 'Notes',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
