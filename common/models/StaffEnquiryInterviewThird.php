<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_enquiry_interview_third".
 *
 * @property integer $id
 * @property integer $staff_id
 * @property string $bank_ac_no
 * @property string $bank_ac_hodername
 * @property string $bank_name
 * @property string $bank_branch
 * @property string $bank_ifsc
 * @property string $staff_experience
 * @property string $document_required
 * @property string $document_received
 * @property integer $form_filled
 * @property integer $interest_level
 * @property string $expected_date_of_joining
 * @property string $interview_notes
 * @property string $interviewed_by
 * @property string $interviewed_date
 *
 * @property StaffInfo $staff
 */
class StaffEnquiryInterviewThird extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_enquiry_interview_third';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['staff_id', 'form_filled', 'interest_level'], 'integer'],
                        [['expected_date_of_joining', 'interviewed_date', 'caution_deposit', 'caution_refund', 'resignation_letter', 'id_card_return', 'uniform_return', 'experience_certificate'], 'safe'],
                        [['interview_notes'], 'string'],
                        [['bank_ac_no', 'bank_ac_hodername', 'bank_name', 'bank_branch', 'bank_ifsc', 'document_required', 'document_received', 'interviewed_by'], 'string', 'max' => 200],
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
                    'bank_ac_no' => ' A/c No',
                    'bank_ac_hodername' => ' A/c Holder Name',
                    'bank_name' => 'Bank',
                    'bank_branch' => 'Branch',
                    'bank_ifsc' => 'IFSC',
                    'staff_experience' => 'Staff Experience',
                    'document_required' => 'Document Required',
                    'document_received' => 'Document Received',
                    'form_filled' => 'Form Filled / Not',
                    'interest_level' => 'Interest Level',
                    'expected_date_of_joining' => 'Expected Date Of Joining',
                    'interview_notes' => 'Interview Notes',
                    'interviewed_by' => 'Interviewed By',
                    'interviewed_date' => 'Interviewed Date',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getStaff() {
                return $this->hasOne(StaffInfo::className(), ['id' => 'staff_id']);
        }

}
