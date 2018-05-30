<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_present_condition".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property string $diagnosis
 * @property integer $paralised_or_bedridden
 * @property string $paralised_specify
 * @property integer $ryles_tube_or_feeding_tube
 * @property string $tube_size
 * @property string $last_change_date
 * @property integer $iv_cannula
 * @property string $specify
 * @property integer $foleys_cath_or_urine_tube
 * @property string $tube_no
 * @property string $foleys_tube_type
 * @property string $foleys_last_change_date
 * @property integer $bladder_wash
 * @property string $bladder_wash_data
 * @property string $cath_care
 * @property integer $bed_sore
 * @property string $others_specify
 *
 * @property PatientGeneral $patient
 */
class PatientPresentCondition extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'patient_present_condition';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['patient_id', 'paralised_or_bedridden', 'ryles_tube_or_feeding_tube', 'iv_cannula', 'foleys_cath_or_urine_tube', 'bladder_wash', 'bed_sore'], 'integer'],
            [['paralised_specify', 'specify', 'bladder_wash_data', 'cath_care', 'others_specify'], 'string'],
            [['last_change_date', 'foleys_last_change_date'], 'safe'],
            [['diagnosis', 'tube_size', 'tube_no', 'foleys_tube_type'], 'string', 'max' => 100],
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
            'diagnosis' => 'Diagnosis',
            'paralised_or_bedridden' => 'Paralised/Bedridden',
            'paralised_specify' => 'Specify',
            'ryles_tube_or_feeding_tube' => 'Ryles Tube/Feeding Tube',
            'tube_size' => 'Tube Size',
            'last_change_date' => 'Last Change Date',
            'iv_cannula' => 'Iv Cannula',
            'specify' => 'Specify',
            'foleys_cath_or_urine_tube' => 'Foleys Cath/Urine Tube',
            'tube_no' => 'Tube No',
            'foleys_tube_type' => 'Foleys Tube Type',
            'foleys_last_change_date' => 'Foleys Last Change Date',
            'bladder_wash' => 'Bladder Wash',
            'bladder_wash_data' => 'Bladder Wash Data',
            'cath_care' => 'Cath Care',
            'bed_sore' => 'Bed Sore',
            'others_specify' => 'Others Specify',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient() {
        return $this->hasOne(PatientGeneral::className(), ['id' => 'patient_id']);
    }

}
