<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_present_medication".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $tablet_injection
 * @property string $medicine_name
 * @property string $dosage
 * @property string $mode
 * @property string $since
 */
class PatientPresentMedication extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'patient_present_medication';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['patient_id', 'tablet_injection'], 'integer'],
            [['since'], 'string'],
            [['medicine_name', 'dosage', 'mode'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'patient_id' => 'Patient ID',
            'tablet_injection' => 'Tablet/injection',
            'medicine_name' => 'Medicine Name',
            'dosage' => 'Dosage',
            'mode' => 'Mode',
            'since' => 'Since',
        ];
    }

}
