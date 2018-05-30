<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "religion".
 *
 * @property integer $id
 * @property string $religion
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Caste[] $castes
 */
class Religion extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'religion';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['religion', 'status'], 'required'],
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['religion'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'religion' => 'Religion',
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
        public function getCastes() {
                return $this->hasMany(Caste::className(), ['r_id' => 'id']);
        }

}
