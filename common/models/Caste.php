<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "caste".
 *
 * @property integer $id
 * @property integer $r_id
 * @property string $caste
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Religion $r
 */
class Caste extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'caste';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['r_id', 'status', 'caste'], 'required'],
                        [['r_id', 'status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['caste'], 'string', 'max' => 200],
                        [['r_id'], 'exist', 'skipOnError' => true, 'targetClass' => Religion::className(), 'targetAttribute' => ['r_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'r_id' => 'Religion',
                    'caste' => 'Caste',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getR() {
                return $this->hasOne(Religion::className(), ['id' => 'r_id']);
        }

}
