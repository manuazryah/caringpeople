<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "upload_category".
 *
 * @property integer $id
 * @property integer $category_type
 * @property string $sub_category
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class UploadCategory extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'upload_category';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'category_type', 'status', 'CB', 'UB', 'type'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['sub_category'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'category_type' => 'Category Type',
                    'sub_category' => 'Sub Category',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                    'type' => 'Type',
                ];
        }

}
