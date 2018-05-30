<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_medical_assessment".
 *
 * @property integer $id
 * @property integer $patient_enquiry_id
 * @property integer $patient_id
 * @property string $primary_diagnoses
 * @property string $allergies
 * @property integer $skin_condition
 * @property integer $diabetic
 * @property integer $mental_status
 * @property integer $behaviour
 * @property integer $aggression
 * @property integer $inappropriateness
 * @property integer $abuse
 * @property integer $risks
 * @property string $social_concerns
 * @property integer $transferring
 * @property integer $appetite
 * @property integer $meal_prep
 * @property integer $housework
 * @property integer $toiletting
 * @property string $notes
 * @property integer $feeding_1
 * @property integer $bathing
 * @property integer $appetite_1
 * @property integer $vision
 * @property integer $hearing
 * @property integer $speech
 * @property integer $literacy
 * @property integer $pain
 * @property string $sensory_notes
 * @property integer $mobility
 * @property integer $assistive_devices
 * @property integer $limbs
 * @property string $activity_notes
 * @property integer $height
 * @property integer $weight
 * @property string $on_date
 * @property integer $mouth
 * @property integer $feeding
 * @property string $diet
 * @property string $supplement
 * @property string $nutrition_notes
 * @property integer $bladder
 * @property integer $bowels
 * @property string $elimination_notes
 */
class PatientMedicalAssessment extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'patient_medical_assessment';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['patient_enquiry_id', 'patient_id', 'skin_condition', 'diabetic', 'mental_status', 'behaviour', 'aggression', 'inappropriateness', 'abuse', 'risks', 'transferring', 'appetite', 'meal_prep', 'housework', 'toiletting', 'feeding_1', 'bathing', 'appetite_1', 'vision', 'hearing', 'speech', 'literacy', 'pain', 'mobility', 'assistive_devices', 'limbs', 'height', 'weight', 'mouth', 'feeding', 'bladder', 'bowels'], 'integer'],
                        [['primary_diagnoses', 'allergies', 'social_concerns', 'notes', 'sensory_notes', 'activity_notes', 'nutrition_notes', 'elimination_notes'], 'string'],
                        [['on_date'], 'safe'],
                        [['diet', 'supplement', 'type_size', 'type_size_1', 'appliance_changed', 'ostomy_type', 'mushrrom_catheter', 'type_size_2'], 'string', 'max' => 250],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'patient_enquiry_id' => 'Patient Enquiry ID',
                    'patient_id' => 'Patient ID',
                    'primary_diagnoses' => 'Primary Diagnoses',
                    'allergies' => 'Allergies',
                    'skin_condition' => 'Skin Condition',
                    'diabetic' => 'Diabetic',
                    'mental_status' => 'Mental Status',
                    'behaviour' => 'Behaviour',
                    'aggression' => 'Aggression',
                    'inappropriateness' => 'Inappropriateness',
                    'abuse' => 'Abuse',
                    'risks' => 'Risks',
                    'social_concerns' => 'Social Concerns',
                    'transferring' => 'Transferring',
                    'appetite' => 'Appetite',
                    'meal_prep' => 'Meal Prep',
                    'housework' => 'Housework',
                    'toiletting' => 'Toiletting',
                    'notes' => 'Notes',
                    'feeding_1' => 'Feeding',
                    'bathing' => 'Bathing',
                    'appetite_1' => 'Appetite',
                    'vision' => 'Vision',
                    'hearing' => 'Hearing',
                    'speech' => 'Speech',
                    'literacy' => 'Literacy',
                    'pain' => 'Pain',
                    'sensory_notes' => 'Notes',
                    'mobility' => 'Mobility',
                    'assistive_devices' => ' Devices',
                    'limbs' => 'Limbs',
                    'activity_notes' => 'Notes',
                    'height' => 'Height',
                    'weight' => 'Weight',
                    'on_date' => 'On Date',
                    'mouth' => 'Mouth',
                    'feeding' => 'Feeding',
                    'diet' => 'Diet',
                    'supplement' => 'Supplement',
                    'nutrition_notes' => ' Notes',
                    'bladder' => 'Bladder',
                    'bowels' => 'Bowels',
                    'elimination_notes' => ' Notes',
                ];
        }

}
