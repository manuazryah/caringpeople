<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_enquiry_hospital_second".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property string $diabetic
 * @property string $diabetic_note
 * @property string $hypertension
 * @property string $feeding
 * @property string $urine
 * @property string $oxygen
 * @property string $tracheostomy
 * @property string $iv_line
 * @property integer $family_support
 * @property string $family_support_note
 * @property integer $care_currently_provided
 * @property string $care_currently_provided_others
 * @property string $date_of_discharge
 * @property string $details_of_current_care
 * @property integer $difficulty_in_movement
 * @property string $difficulty_in_movement_other
 */
class PatientEnquiryHospitalSecond extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'patient_enquiry_hospital_second';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['diabetic', 'feeding', 'urine', 'oxygen', 'care_currently_provided'], 'required'],
                        [['enquiry_id', 'family_support', 'care_currently_provided', 'difficulty_in_movement'], 'integer'],
                        [['family_support_note', 'details_of_current_care', 'difficulty_in_movement_other','diagnosis'], 'string'],
                        [['date_of_discharge'], 'safe'],
                        [['diabetic', 'diabetic_note', 'hypertension', 'feeding', 'urine', 'oxygen', 'tracheostomy', 'iv_line', 'care_currently_provided_others'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'enquiry_id' => 'Enquiry ID',
                    'diabetic' => 'Diabetic',
                    'diabetic_note' => 'Diabetic Note',
                    'hypertension' => 'Hypertension',
                    'feeding' => 'Feeding Tube',
                    'urine' => 'Urine Tube',
                    'oxygen' => 'Oxygen',
                    'tracheostomy' => 'Tracheostomy',
                    'iv_line' => 'IV LINE',
                    'family_support' => 'Nearby Family Support',
                    'family_support_note' => 'Nearby Family Support Note',
                    'care_currently_provided' => 'Care Currently Provided',
                    'care_currently_provided_others' => 'Care Currently Provided Others',
                    'date_of_discharge' => 'Date Of Discharge',
                    'details_of_current_care' => 'Details Of Current Care',
                    'difficulty_in_movement' => 'Difficulty In Movement',
                    'difficulty_in_movement_other' => 'Difficulty In Movement Other',
                    'diagnosis' => 'Diagnosis',
                ];
        }

}
