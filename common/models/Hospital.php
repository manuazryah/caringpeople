<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hospital".
 *
 * @property integer $id
 * @property string $hospital_name
 * @property string $contact_person
 * @property string $contact_email
 * @property string $contact_number
 * @property string $contact_number_2
 * @property string $address
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Hospital extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'hospital';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['hospital_name', 'status'], 'required'],
                        [['contact_email'], 'email'],
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['hospital_name', 'contact_person', 'contact_email', 'contact_number', 'contact_number_2', 'address'], 'string', 'max' => 280],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'hospital_name' => 'Hospital Name',
                    'contact_person' => 'Contact Person',
                    'contact_email' => 'Contact Email',
                    'contact_number' => 'Contact Number',
                    'contact_number_2' => 'Contact Number 2',
                    'address' => 'Address',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
