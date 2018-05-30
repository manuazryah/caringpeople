<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_info_uploads".
 *
 * @property integer $id
 * @property integer $staff_id
 * @property string $profile_image_type
 * @property string $biodata
 * @property string $sslc
 * @property string $hse
 * @property string $KNC
 * @property string $INC
 * @property string $marklist
 * @property string $experience
 * @property string $id_proof
 * @property string $PCC
 * @property string $authorised_letter
 */
class StaffInfoUploads extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_info_uploads';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['staff_id'], 'integer'],
                        [['profile_image_type', 'biodata', 'sslc', 'hse', 'KNC', 'INC', 'marklist', 'experience', 'id_proof', 'PCC', 'authorised_letter'], 'string', 'max' => 200],
                        [['profile_image_type',], 'file', 'skipOnEmpty' => TRUE, 'extensions' => 'jpg, gif, png,jpeg'],
                    // [['biodata', 'sslc', 'hse', 'KNC', 'INC', 'marklist', 'experience', 'id_proof', 'PCC', 'authorised_letter'], 'file', 'skipOnEmpty' => TRUE, 'extensions' => 'pdf, doc, docs,txt,jpg, gif, png,jpeg', 'maxSize' => 1024 * 1024 * 4],
                    ['biodata', 'file', 'extensions' => 'pdf, jpg', 'maxSize' => 5120000, 'tooBig' => 'Limit is 500KB'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'staff_id' => 'Staff ID',
                    'profile_image_type' => 'Profile Image',
                    'biodata' => 'Biodata',
                    'branch_id' => 'Branch',
                    'sslc' => 'SSLC',
                    'hse' => '+2',
                    'KNC' => 'KNC',
                    'INC' => 'INC',
                    'marklist' => 'Marklist',
                    'experience' => 'Experience',
                    'id_proof' => 'Pan Card/Passport/Voter ID',
                    'PCC' => 'Police Clearnce Certificate',
                    'authorised_letter' => 'Attachment',
                ];
        }

}
