<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_schedule_bin".
 *
 * @property integer $id
 * @property integer $service_id
 * @property integer $patient_id
 * @property string $date
 * @property integer $staff
 * @property string $remarks_from_manager
 * @property string $remarks_from_staff
 * @property string $remarks_from_patient
 * @property string $rate
 * @property string $patient_rate
 * @property string $time_in
 * @property string $time_out
 * @property integer $rating
 * @property integer $status
 * @property integer $day_night
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class ServiceScheduleBin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_schedule_bin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'patient_id', 'staff', 'rating', 'status', 'day_night', 'CB', 'UB'], 'integer'],
            [['date', 'DOC', 'DOU'], 'safe'],
            [['remarks_from_manager', 'remarks_from_staff', 'remarks_from_patient'], 'string'],
            [['rate'], 'string', 'max' => 255],
            [['patient_rate'], 'string', 'max' => 250],
            [['time_in', 'time_out'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'patient_id' => 'Patient ID',
            'date' => 'Date',
            'staff' => 'Staff',
            'remarks_from_manager' => 'Remarks From Manager',
            'remarks_from_staff' => 'Remarks From Staff',
            'remarks_from_patient' => 'Remarks From Patient',
            'rate' => 'Rate',
            'patient_rate' => 'Patient Rate',
            'time_in' => 'Time In',
            'time_out' => 'Time Out',
            'rating' => 'Rating',
            'status' => 'Status',
            'day_night' => 'Day Night',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
