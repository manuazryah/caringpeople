<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doctors".
 *
 * @property integer $id
 * @property string $name
 * @property integer $hospital
 * @property string $department
 * @property string $mobille
 * @property string $email
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Doctors extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'doctors';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['hospital', 'status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['name', 'department', 'mobille', 'email'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'name' => 'Name',
                    'hospital' => 'Hospital',
                    'department' => 'Department',
                    'mobille' => 'Mobille',
                    'email' => 'Email',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        public function getH() {
                return $this->hasOne(Hospital::className(), ['id' => 'hospital']);
        }

}
