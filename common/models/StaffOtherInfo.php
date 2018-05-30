<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_other_info".
 *
 * @property integer $id
 * @property integer $staff_id
 * @property string $hospital_address
 * @property string $designation
 * @property string $length_of_service
 * @property string $current_from
 * @property string $current_to
 * @property string $emergency_contact_name
 * @property string $relationship
 * @property string $phone
 * @property string $mobile
 * @property string $alt_emergency_contact_name
 * @property string $alt_relationship
 * @property string $alt_phone
 * @property string $alt_mobile
 *
 * @property StaffInfo $staff
 */
class StaffOtherInfo extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_other_info';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['staff_id'], 'integer'],
                        [['current_from', 'current_to'], 'safe'],
                        [['hospital_address', 'designation', 'length_of_service', 'emergency_contact_name', 'relationship', 'phone', 'mobile', 'alt_emergency_contact_name', 'alt_relationship', 'alt_phone', 'alt_mobile', 'salary', 'guardian_name', 'guardian_phone', 'guardian_email', 'alt_guardian_name', 'alt_guardian_phone', 'alt_guardian_email'], 'string', 'max' => 200],
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
                    'hospital_address' => 'Hospital Address',
                    'designation' => 'Designation',
                    'length_of_service' => 'Length Of Service',
                    'current_from' => 'From',
                    'current_to' => 'To',
                    'emergency_contact_name' => 'Emergency Contact Name',
                    'relationship' => 'Relationship',
                    'phone' => 'Phone',
                    'mobile' => 'Mobile',
                    'alt_emergency_contact_name' => 'Alternate Emergency Contact Name',
                    'alt_relationship' => 'Relationship',
                    'alt_phone' => 'Phone',
                    'alt_mobile' => 'Mobile',
                    'salary' => 'Salary',
                    'guardian_name' => 'Guardian Name',
                    'guardian_phone' => 'Guardian Phone',
                    'guardian_email' => 'Guardian Email',
                    'alt_guardian_name' => 'Guardian Name 1',
                    'alt_guardian_phone' => 'Guardian Phone 1',
                    'alt_guardian_email' => 'Guardian Email 1',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getStaff() {
                return $this->hasOne(StaffInfo::className(), ['id' => 'staff_id']);
        }

}
