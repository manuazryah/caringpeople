<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "login_history".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $staff_id
 * @property integer $patient_id
 * @property string $logged_in
 * @property string $logged_out
 * @property string $DOC
 * @property string $DOU
 */
class LoginHistory extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'login_history';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['type', 'staff_id', 'patient_id'], 'integer'],
                        [['logged_in', 'logged_out', 'DOC', 'DOU'], 'safe'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'type' => 'Type',
                    'staff_id' => 'Staff',
                    'patient_id' => 'Patient',
                    'logged_in' => 'Logged In',
                    'logged_out' => 'Logged Out',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
