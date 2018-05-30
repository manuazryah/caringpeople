<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_assessment".
 *
 * @property integer $id
 * @property integer $pateient_id
 * @property integer $service_id
 * @property integer $patient_condition
 * @property string $patient_medical_procedures
 * @property string $suggested_professional
 * @property string $other_notes
 * @property string $assessment_date
 * @property string $assessed_by
 */
class PatientAssessment extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'patient_assessment';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['patient_id', 'service_id', 'patient_condition','patient_conscious','patient_enquiry_id'], 'integer'],
                        [['other_notes'], 'string'],
                        [['assessment_date'], 'safe'],
                        [['patient_medical_procedures'], 'string', 'max' => 200],
                        [['suggested_professional', 'assessed_by'], 'string', 'max' => 250],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'patient_enquiry_id'=>'patient_enquiry_id',
                    'patient_id' => 'Patient ID',
                    'service_id' => 'Service ID',
                    'patient_condition' => 'Patient Condition',
                    'patient_conscious'=>'Patient Conscious',
                    'patient_medical_procedures' => 'Patient Medical Procedures',
                    'suggested_professional' => 'Suggested Professional',
                    'other_notes' => 'Other Notes',
                    'assessment_date' => 'Assessment Date',
                    'assessed_by' => 'Assessed By',
                ];
        }

}
