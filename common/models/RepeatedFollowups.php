<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "repeated_followups".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $sub_type
 * @property integer $type_id
 * @property string $followup_date
 * @property string $followup_notes
 * @property integer $assigned_to
 * @property integer $assigned_from
 * @property string $attachments
 * @property string $related_staffs
 * @property integer $repeated_type
 * @property string $repeated_days
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class RepeatedFollowups extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'repeated_followups';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['type', 'sub_type', 'type_id', 'assigned_to', 'repeated_type', 'status', 'CB', 'UB', 'releated_notification_patient', 'repeated_days', 'repeated'], 'integer'],
                        [['followup_date', 'DOC', 'DOU'], 'safe'],
                        [['followup_notes'], 'string'],
                    //   [['status'], 'required'],
                    [['attachments'], 'string', 'max' => 200],
                        [['assigned_to',], 'required'],
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
                    'assigned_from' => 'Assigned From',
                    'attachments' => 'Attachments',
                    'related_staffs' => 'Related Staffs',
                    'repeated_type' => 'Followup to be set for',
                    'repeated_days' => 'Repeated Days',
                    'repeated' => 'Repeated Followups',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                    'releated_notification_patient' => 'Notification to patient',
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

//        public static function Image($image, $id) {
//
//                return Yii::$app->homeUrl . '../uploads/followups/repeated' . $id . '/' . $image;
//        }
}
