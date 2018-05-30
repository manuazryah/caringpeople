<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_chronic".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $asthma
 * @property integer $cardiac
 * @property integer $emotional_behaviour_disturbance
 * @property integer $bleeding_disorders
 * @property integer $urinary_infection
 * @property integer $vision_contacts
 * @property integer $convolutions
 * @property integer $syncope
 * @property integer $teeth_dentures
 * @property integer $ear_infection
 * @property integer $psychiatry
 * @property integer $Other
 * @property string $othersspecify
 * @property integer $diabetic
 * @property string $diabetic_since
 * @property string $diabetic_medication
 * @property integer $hypertension
 * @property string $hypertension_since
 * @property string $hypertension_medication
 * @property integer $allergy
 * @property string $allergy_specify
 * @property integer $serology
 * @property string $serology_specify
 * @property integer $psychiatry_disease
 * @property integer $communicable_disease
 * @property string $others_specify
 * @property integer $history_of_surgery
 * @property string $specify_surgery_details
 * @property string $name_of_doctor_1
 * @property integer $doctor1_mob
 * @property string $name_of_hospital_1
 * @property integer $hospital1_phone_no
 * @property string $name_of_doctor_2
 * @property integer $doctor2_mob
 * @property string $name_of_hospital_2
 * @property integer $hospital2_phone_no
 *
 * @property PatientGeneral $patient
 */
class PatientChronic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_chronic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'asthma', 'cardiac', 'emotional_behaviour_disturbance', 'bleeding_disorders', 'urinary_infection', 'vision_contacts', 'convolutions', 'syncope', 'teeth_dentures', 'ear_infection', 'psychiatry', 'Other', 'diabetic', 'hypertension', 'allergy', 'serology', 'psychiatry_disease', 'communicable_disease', 'history_of_surgery', 'doctor1_mob', 'hospital1_phone_no', 'doctor2_mob', 'hospital2_phone_no'], 'integer'],
            [['othersspecify', 'diabetic_since', 'diabetic_medication', 'hypertension_since', 'hypertension_medication', 'allergy_specify', 'serology_specify', 'others_specify', 'specify_surgery_details'], 'string'],
            [['name_of_doctor_1', 'name_of_hospital_1', 'name_of_doctor_2', 'name_of_hospital_2'], 'string', 'max' => 100],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => PatientGeneral::className(), 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'patient_id' => 'Patient ID',
            'asthma' => 'Asthma',
            'cardiac' => 'Cardiac',
            'emotional_behaviour_disturbance' => 'Emotional Behaviour Disturbance',
            'bleeding_disorders' => 'Bleeding Disorders',
            'urinary_infection' => 'Urinary Infection',
            'vision_contacts' => 'Vision Contacts',
            'convolutions' => 'Convolutions',
            'syncope' => 'Syncope',
            'teeth_dentures' => 'Teeth Dentures',
            'ear_infection' => 'Ear Infection',
            'psychiatry' => 'Psychiatry',
            'Other' => 'Other',
            'othersspecify' => 'Othersspecify',
            'diabetic' => 'Diabetic',
            'diabetic_since' => 'Diabetic Since',
            'diabetic_medication' => 'Diabetic Medication',
            'hypertension' => 'Hypertension',
            'hypertension_since' => 'Hypertension Since',
            'hypertension_medication' => 'Hypertension Medication',
            'allergy' => 'Allergy',
            'allergy_specify' => 'Allergy Specify',
            'serology' => 'Serology',
            'serology_specify' => 'Serology Specify',
            'psychiatry_disease' => 'Psychiatry Disease',
            'communicable_disease' => 'Communicable Disease',
            'others_specify' => 'Others Specify',
            'history_of_surgery' => 'History Of Surgery',
            'specify_surgery_details' => 'Specify Surgery Details',
            'name_of_doctor_1' => 'Name Of Doctor 1',
            'doctor1_mob' => 'Doctor1 Mob',
            'name_of_hospital_1' => 'Name Of Hospital 1',
            'hospital1_phone_no' => 'Hospital1 Phone No',
            'name_of_doctor_2' => 'Name Of Doctor 2',
            'doctor2_mob' => 'Doctor2 Mob',
            'name_of_hospital_2' => 'Name Of Hospital 2',
            'hospital2_phone_no' => 'Hospital2 Phone No',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(PatientGeneral::className(), ['id' => 'patient_id']);
    }
}
