<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_enquiry".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property string $name
 * @property string $phone_number
 * @property string $email
 * @property string $address
 * @property string $follow_up_date
 * @property string $notes
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property string $proceed
 *
 * @property Branch $branch
 */
class StaffEnquiry extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_enquiry';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['name', 'gender'], 'required'],
                        [['email'], 'email'],
                        [['branch_id', 'status', 'CB', 'UB', 'proceed', 'gender', 'designation', 'agreement_copy', 'age'], 'integer'],
                        [['follow_up_date', 'DOC', 'DOU', 'area_interested'], 'safe'],
                        [['notes'], 'string'],
                        [['name', 'phone_number', 'email', 'address', 'place', 'enquiry_id', 'agreement_copy_other'], 'string', 'max' => 200],
                        [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
                        [['branch_id'], 'required', 'when' => function ($model) {
                                return Yii::$app->user->identity->branch_id == 0;
                        },],
                        [['attachments'], 'file', 'skipOnEmpty' => TRUE, 'maxFiles' => 0],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'branch_id' => 'Branch',
                    'enquiry_id' => 'Enquiry Number',
                    'name' => 'Name',
                    'gender' => 'Gender',
                    'age' => 'Age',
                    'dob' => 'DOB',
                    'designation' => 'Designation',
                    'agreement_copy' => 'Agreement Copy',
                    'agreement_copy_other' => 'Agreement Copy Other',
                    'place' => 'Place',
                    'phone_number' => 'Phone Number',
                    'email' => 'Email',
                    'address' => 'Address',
                    'follow_up_date' => 'Followup Date',
                    'notes' => 'Notes',
                    'status' => 'Status',
                    'proceed' => 'proceed',
                    'attachments' => 'Attachments',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getBranch() {
                return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
        }

        public function getEducation() {
                return $this->hasOne(StaffInfoEducation::className(), ['enquiry_id' => 'id']);
        }

        public function getStaffOtherinfo() {
                return $this->hasOne(StaffOtherInfo::className(), ['enquiry_id' => 'id']);
        }

        public function getInterviewfirst() {
                return $this->hasOne(StaffEnquiryInterviewFirst::className(), ['enquiry_id' => 'id']);
        }

        public function getInterviewsecond() {
                return $this->hasOne(StaffEnquiryInterviewSecond::className(), ['enquiry_id' => 'id']);
        }

        public function getInterviewthird() {
                return $this->hasOne(StaffEnquiryInterviewThird::className(), ['enquiry_id' => 'id']);
        }

        public function Staffexperience($exp) {
                $expp = explode(',', $exp);

                $name = '';
                $i = 0;
                foreach ($expp as $value) {

                        $i++;
                        if ($i != 1) {
                                $name .= ",";
                        }
                        $staff_Exp = StaffExperienceList::findOne($value);
                        $name .= $staff_Exp->title;
                }
                return $name;
        }

        public function Language($lang1) {
                if (isset($lang1) && $lang1 != '') {
                        $lang = explode(',', $lang1);
                        if ($lang[1] == '1') {
                                $read = 'Read';
                        } else {
                                $read = '';
                        }

                        if ($lang[2] == '1') {
                                $write = 'Write';
                        } else {
                                $write = '';
                        }

                        if ($lang[3] == '1') {
                                $speak = 'Speak';
                        } else {
                                $speak = '';
                        }
                        $language = $lang[0] . "(" . $read . "," . $write . "," . $speak . ")";
                } else {
                        $language = '';
                }
                return $language;
        }

}
