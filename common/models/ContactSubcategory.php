<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_subcategory".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $sub_category
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property ContactCategoryTypes $category
 */
class ContactSubcategory extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'contact_subcategory';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['category_id', 'status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['sub_category'], 'string', 'max' => 255],
                        [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContactCategoryTypes::className(), 'targetAttribute' => ['category_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'category_id' => 'Category',
                    'sub_category' => 'Sub Category',
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
        public function getCategory() {
                return $this->hasOne(ContactCategoryTypes::className(), ['id' => 'category_id']);
        }

}
