<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_enquiry_hospital_details".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property string $hospital_name
 * @property string $consultant_doctor
 * @property string $department
 * @property string $hospital_room_no
 */
class PatientEnquiryHospitalDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_enquiry_hospital_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enquiry_id'], 'integer'],
            [['hospital_name', 'consultant_doctor', 'department', 'hospital_room_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enquiry_id' => 'Enquiry ID',
            'hospital_name' => 'Hospital Name',
            'consultant_doctor' => 'Consultant Doctor',
            'department' => 'Department',
            'hospital_room_no' => 'Hospital Room No',
        ];
    }
}
