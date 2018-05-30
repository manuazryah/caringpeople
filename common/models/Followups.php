<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "followups".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $sub_type
 * @property integer $type_id
 * @property string $followup_date
 * @property string $followup_notes
 * @property integer $assigned_to
 * @property integer $assigned_from
 * @property string $DOC
 */
class Followups extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'followups';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['type', 'sub_type', 'type_id', 'assigned_to', 'status', 'CB', 'UB', 'assigned_to_type', 'releated_notification_patient'], 'integer'],
                        [['followup_date', 'DOC'], 'safe'],
                        [['followup_notes'], 'string'],
                        [['attachments'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'type' => 'Type',
                    'sub_type' => 'Category',
                    'type_id' => 'Type ID',
                    'followup_date' => 'Followup Date',
                    'followup_notes' => 'Followup Notes',
                    'assigned_to' => 'Assigned To',
                    'assigned_to_type' => 'assigned_to_type',
                    'assigned_from' => 'Assigned From',
                    'attachments' => 'Attachments',
                    'status' => 'Status',
                    'related_staffs' => 'Related Staffs',
                    'DOC' => 'Doc',
                    'releated_notification_patient' => 'releated_notification_patient',
                ];
        }

        public static function Relatedstaffs($related_staffs) {

                if (isset($related_staffs) && $related_staffs != '') {
                        $related_staffs = explode(',', $related_staffs);
                        $relatedstaffs = '';
                        $i = 0;
                        if (!empty($related_staffs)) {
                                foreach ($related_staffs as $related) {
                                        if ($i != 0) {
                                                $relatedstaffs .= ',';
                                        }
                                        $staff_name = StaffInfo::findOne($related);
                                        $relatedstaffs .= $staff_name->staff_name;
                                        $i++;
                                }
                        }
                        return $relatedstaffs;
                }
        }

        public function getTo0() {
                return $this->hasOne(FollowupSubType::className(), ['id' => 'sub_type']);
        }

        public function getAssigned0() {
                return $this->hasOne(StaffInfo::className(), ['id' => 'assigned_to']);
        }

        public function getAssignedfrom0() {
                return $this->hasOne(StaffInfo::className(), ['id' => 'assigned_from']);
        }

}
