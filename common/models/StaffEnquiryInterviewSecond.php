<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_enquiry_interview_second".
 *
 * @property integer $id
 * @property integer $staff_id
 * @property string $contact_verified_by
 * @property string $contact_verified_date
 * @property string $contact_verified_note
 * @property string $alt_contact_verified_by
 * @property string $alt_contact_verified_date
 * @property string $alt_contact_verified_note
 * @property string $verified_name_1
 * @property string $verified_designation_1
 * @property string $verified_date_1
 * @property string $verified_mobile_no_1
 * @property string $verified_name_2
 * @property string $verified_designation_2
 * @property string $verified_date_2
 * @property string $verified_mobile_no_2
 * @property string $verified_name_3
 * @property string $verified_designation_3
 * @property string $verified_date_3
 * @property string $verified_mobile_no_3
 *
 * @property StaffInfo $staff
 */
class StaffEnquiryInterviewSecond extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_enquiry_interview_second';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['staff_id'], 'integer'],
                        [['contact_verified_date', 'alt_contact_verified_date', 'verified_date_1', 'verified_date_2', 'verified_date_3'], 'safe'],
                        [['contact_verified_note', 'alt_contact_verified_note'], 'string'],
                        [['contact_verified_by', 'alt_contact_verified_by', 'verified_name_1', 'verified_designation_1', 'verified_mobile_no_1', 'verified_name_2', 'verified_designation_2', 'verified_mobile_no_2', 'verified_name_3', 'verified_designation_3', 'verified_mobile_no_3'], 'string', 'max' => 200],
                        [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaffInfo::className(), 'targetAttribute' => ['staff_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'staff_id' => 'Staff ID',
                    'contact_verified_by' => 'Contact Verified By',
                    'contact_verified_date' => 'Contact Verified Date',
                    'contact_verified_note' => 'Contact Verified Note',
                    'alt_contact_verified_by' => 'Alternate Contact Verified By',
                    'alt_contact_verified_date' => 'Alternate Contact Verified Date',
                    'alt_contact_verified_note' => 'Alternate Contact Verified Note',
                    'verified_name_1' => ' Verified By ',
                    'verified_designation_1' => ' Designation ',
                    'verified_date_1' => ' Date ',
                    'verified_mobile_no_1' => ' Mobile No ',
                    'verified_name_2' => ' Verified By ',
                    'verified_designation_2' => ' Designation ',
                    'verified_date_2' => ' Date ',
                    'verified_mobile_no_2' => ' Mobile No ',
                    'verified_name_3' => ' Name ',
                    'verified_designation_3' => ' Designation ',
                    'verified_date_3' => ' Date ',
                    'verified_mobile_no_3' => ' Mobile No ',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getStaff() {
                return $this->hasOne(StaffInfo::className(), ['id' => 'staff_id']);
        }

}
