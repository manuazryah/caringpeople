<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property integer $id
 * @property string $date
 * @property integer $branch_id
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Branch $branch
 * @property AttendanceEntry[] $attendanceEntries
 */
class Attendance extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'attendance';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['date', 'branch_id'], 'required'],
                        [['date', 'DOC', 'branch_id'], 'required', 'on' => 'report'],
                        [['date', 'DOC', 'DOU'], 'safe'],
                        [['branch_id', 'CB', 'UB'], 'integer'],
                        [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'date' => ($this->scenario == 'report' ? 'Date From' : 'Date'),
                    'branch_id' => 'Branch',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Date To',
                    'DOU' => 'Dou',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getBranch() {
                return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getAttendanceEntries() {
                return $this->hasMany(AttendanceEntry::className(), ['attendance_id' => 'id']);
        }

}
