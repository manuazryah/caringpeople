<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_enquiry_interview_first".
 *
 * @property integer $id
 * @property integer $staff_id
 * @property integer $age
 * @property integer $height
 * @property integer $weight
 * @property integer $smoke_or_drink
 * @property string $police_station_name
 * @property string $panchayat
 * @property string $muncipality_corporation
 * @property integer $mentioned_per_day_salary
 * @property string $family_name
 * @property integer $relation
 * @property string $job
 * @property string $mobile_no
 * @property integer $terms_conditions
 * @property string $language_1
 * @property string $language_2
 * @property string $language_3
 * @property string $language_4
 *
 * @property StaffInfo $staff
 */
class StaffEnquiryInterviewFirst extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_enquiry_interview_first';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['staff_id', 'age', 'height', 'weight', 'smoke_or_drink', 'mentioned_per_day_salary', 'terms_conditions','drink','other'], 'integer'],
                        [['police_station_name','language_1', 'language_2', 'language_3', 'language_4'], 'string', 'max' => 200],
                        [['muncipality_corporation', 'alternate_number_1', 'alternate_number_2', 'ward', 'member_name', 'member_phone'], 'string', 'max' => 255],
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
                    'age' => 'Age',
                    'height' => 'Height',
                    'weight' => 'Weight',
                    'smoke_or_drink' => 'Smoke',
                    'drink'=>'Drink',
                    'other'=>'Other',
                    'police_station_name' => 'Police Station Name',
                    'muncipality_corporation' => 'Panchayat / Muncipality / Corporation',
                    'mentioned_per_day_salary' => 'Mentioned Per Day Salary',
                    'terms_conditions' => 'I agree to the terms and conditions',
                    'language_1' => 'Language 1',
                    'language_2' => 'Language 2',
                    'language_3' => 'Language 3',
                    'language_4' => 'Language 4',
                    'alternate_number_1' => 'Alternate Number 1',
                    'alternate_number_2' => 'Alternate Number 2',
                    'ward' => 'Ward',
                    'member_name' => 'Ward Member Name',
                    'member_phone' => 'Ward Member Phone Number',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getStaff() {
                return $this->hasOne(StaffInfo::className(), ['id' => 'staff_id']);
        }

}
