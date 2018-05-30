<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_guardian_details".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $gender
 * @property string $id_card_or_passport_no
 * @property string $religion
 * @property string $nationality
 * @property string $occupatiion
 * @property string $permanent_address
 * @property integer $pincode
 * @property string $landmark
 * @property integer $contact_number
 * @property string $email
 * @property string $adhar_card_no
 * @property string $passport
 * @property string $driving_license
 * @property string $pan_card
 * @property string $voters_id
 * @property string $guardian_profile_image
 */
class PatientGuardianDetails extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'patient_guardian_details';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    //[['id'], 'required'],
                        [['id', 'patient_id', 'gender', 'pincode', 'contact_number', 'gender_1', 'gender_2'], 'integer'],
                        [['permanent_address', 'permanent_address_1', 'permanent_address_2', 'contact_number_1', 'contact_number_2'], 'string'],
                        [['first_name', 'last_name', 'id_card_or_passport_no', 'religion', 'nationality', 'occupatiion', 'landmark', 'email', 'adhar_card_no', 'passport', 'driving_license', 'pan_card', 'voters_id', 'police_station_name', 'police_station_email', 'panchayath_name', 'ward_no', 'contact_person_name', 'contact_person_mobile_no', 'diagnosis'], 'string', 'max' => 100],
                        [['first_name_1', 'last_name_1', 'religion_1', 'nationality_1', 'occupatiion_1', 'landmark_1', 'email_1', 'pincode_1'], 'string'],
                        [['first_name_2', 'last_name_2', 'religion_2', 'nationality_2', 'occupatiion_2', 'landmark_2', 'email_2', 'pincode_2'], 'string'],
                        [['police_station_email', 'email'], 'email'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'patient_id' => 'Patient ID',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'gender' => 'Gender',
                    'id_card_or_passport_no' => 'Id Card/Passport No',
                    'religion' => 'Religion',
                    'nationality' => 'Nationality',
                    'occupatiion' => 'Occupatiion',
                    'permanent_address' => 'Permanent Address',
                    'pincode' => 'Pincode',
                    'landmark' => 'Landmark',
                    'contact_number' => 'Contact Number',
                    'email' => 'Email',
                    'adhar_card_no' => 'Adhar Card No',
                    'passport' => 'Passport/Driving License/Pan Card/Voters ID',
                    'driving_license' => 'Driving License',
                    'pan_card' => 'Pan Card',
                    'voters_id' => 'Voters ID',
                    'guardian_profile_image' => 'Guardian Image',
                    'police_station_name' => 'Police Station Name',
                    'police_station_email' => 'Police Station Email',
                    'panchayath_name' => 'Panchayath / Munciplaity Name',
                    'ward_no' => 'Ward No',
                    'contact_person_name' => 'Contact Person Name',
                    'contact_person_mobile_no' => 'Contact Person Mobile No',
                    'diagnosis' => 'Diagnosis',
                    'first_name_1' => 'First Name',
                    'last_name_1' => 'Last Name',
                    'gender_1' => 'Gender',
                    'religion_1' => 'Religion',
                    'nationality_1' => 'Nationality',
                    'occupatiion_1' => 'Occupatiion',
                    'permanent_address_1' => 'Permanent Address',
                    'pincode_1' => 'Pincode',
                    'landmark_1' => 'Landmark',
                    'contact_number_1' => 'Contact Number',
                    'email_1' => 'Email',
                    'first_name_2' => 'First Name',
                    'last_name_2' => 'Last Name',
                    'gender_2' => 'Gender',
                    'religion_2' => 'Religion',
                    'nationality_2' => 'Nationality',
                    'occupatiion_2' => 'Occupatiion',
                    'permanent_address_2' => 'Permanent Address',
                    'pincode_2' => 'Pincode',
                    'landmark_2' => 'Landmark',
                    'contact_number_2' => 'Contact Number',
                    'email_2' => 'Email',
                ];
        }

}
