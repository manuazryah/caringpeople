<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "master_designations".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class MasterDesignations extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'master_designations';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['title'], 'required'],
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['title'], 'string', 'max' => 255],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'title' => 'Title',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        public function Designationlist() {
                $data = MasterDesignations::find()->where(['status' => 1])->orderBy(['title' => SORT_ASC])->all();
                return $data;
        }

}
