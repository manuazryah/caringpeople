<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_bystander_details".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $service_need_for
 * @property string $hospital_name
 * @property integer $room_no
 * @property string $consulting_doctor
 * @property integer $no_of_days
 * @property string $mode
 * @property integer $can_provide
 *
 * @property PatientGeneral $patient
 */
class PatientBystanderDetails extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'patient_bystander_details';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['patient_id', 'room_no', 'no_of_days'], 'integer'],
            [['hospital_name', 'consulting_doctor', 'mode'], 'string', 'max' => 100],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => PatientGeneral::className(), 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'patient_id' => 'Patient ID',
            'service_need_for' => 'Service Need For',
            'hospital_name' => 'Hospital Name',
            'room_no' => 'Room No',
            'consulting_doctor' => 'Consulting Doctor',
            'no_of_days' => 'No Of Days',
            'mode' => 'Mode',
            'can_provide' => 'Can Provide',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient() {
        return $this->hasOne(PatientGeneral::className(), ['id' => 'patient_id']);
    }

}
