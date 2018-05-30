<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_pervious_employer".
 *
 * @property integer $id
 * @property integer $staff_id
 * @property string $hospital_address
 * @property string $designation
 * @property string $length_of_service
 * @property string $service_from
 * @property string $service_to
 *
 * @property StaffInfo $staff
 */
class StaffPerviousEmployer extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_pervious_employer';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['staff_id'], 'integer'],
                        [['service_from', 'service_to'], 'safe'],
                        [['hospital_address', 'designation', 'length_of_service'], 'string', 'max' => 200],
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
                    'service_from' => 'From',
                    'service_to' => 'To',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getStaff() {
                return $this->hasOne(StaffInfo::className(), ['id' => 'staff_id']);
        }

}
