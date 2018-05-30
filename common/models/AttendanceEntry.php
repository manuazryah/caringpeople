<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attendance_entry".
 *
 * @property integer $id
 * @property integer $attendance_id
 * @property integer $staff_id
 * @property integer $total_hours
 * @property integer $over_time
 * @property integer $attendance
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Attendance $attendance0
 * @property StaffInfo $staff
 */
class AttendanceEntry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attendance_entry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attendance_id', 'staff_id', 'total_hours', 'over_time', 'attendance', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['attendance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attendance::className(), 'targetAttribute' => ['attendance_id' => 'id']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaffInfo::className(), 'targetAttribute' => ['staff_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attendance_id' => 'Attendance ID',
            'staff_id' => 'Staff ID',
            'total_hours' => 'Total Hours',
            'over_time' => 'Over Time',
            'attendance' => 'Attendance',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendance0()
    {
        return $this->hasOne(Attendance::className(), ['id' => 'attendance_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(StaffInfo::className(), ['id' => 'staff_id']);
    }
}
