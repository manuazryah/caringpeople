<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_enquiry_hospital_first".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property string $required_person_name
 * @property integer $patient_gender
 * @property integer $patient_age
 * @property integer $patient_weight
 * @property string $relationship
 * @property string $relationship_others
 * @property string $person_address
 * @property string $person_city
 * @property string $person_postal_code
 * @property string $hospital_name
 * @property string $consultant_doctor
 * @property string $department
 * @property string $hospital_room_no
 */
class PatientEnquiryHospitalFirst extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'patient_enquiry_hospital_first';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['enquiry_id', 'patient_gender', 'patient_weight', 'patient_age'], 'integer'],
                        [['required_person_name', 'relationship', 'relationship_others', 'person_address', 'person_city', 'person_postal_code', 'hospital_name', 'consultant_doctor', 'department', 'hospital_room_no'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'enquiry_id' => 'Enquiry ID',
                    'required_person_name' => 'Required Person Name',
                    'patient_gender' => 'Gender',
                    'patient_age' => 'Age',
                    'patient_dob' => 'DOB',
                    'patient_weight' => 'Weight',
                    'relationship' => 'Relationship',
                    'relationship_others' => 'Relationship Details',
                    'person_address' => 'Person Address',
                    'person_city' => 'Person City',
                    'person_postal_code' => 'Person Postal Code',
                    'hospital_name' => 'Hospital Name',
                    'consultant_doctor' => 'Consultant Doctor',
                    'department' => 'Department',
                    'hospital_room_no' => 'Hospital Room No',
                ];
        }

}
