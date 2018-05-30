<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_directory".
 *
 * @property integer $id
 * @property integer $category_type
 * @property string $name
 * @property string $email_1
 * @property string $email_2
 * @property string $phone_1
 * @property string $phone_2
 * @property string $designation
 * @property string $company_name
 * @property string $references
 * @property string $remarks
 * @property integer $field_1
 * @property integer $field_2
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property ContactCategoryTypes $categoryType
 */
class ContactDirectory extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'contact_directory';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['category_type', 'subcategory_type', 'field_1', 'field_2', 'CB', 'UB', 'notes_1_added', 'notes_2_added', 'notes_3_added'], 'integer'],
                        [['remarks', 'notes_1', 'notes_2', 'notes_3'], 'string'],
                        [['DOC', 'DOU', 'notes_1_time', 'notes_2_time', 'notes_3_time'], 'safe'],
                        [['name', 'email_1', 'email_2', 'phone_1', 'phone_2'], 'string', 'max' => 100],
                        [['email_1', 'email_2'], 'email'],
                        [['designation', 'company_name', 'references'], 'string', 'max' => 200],
                        [['category_type'], 'exist', 'skipOnError' => true, 'targetClass' => ContactCategoryTypes::className(), 'targetAttribute' => ['category_type' => 'id']],
                        [['category_type', 'name'], 'required', 'on' => 'create']
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'category_type' => 'Category Type',
                    'subcategory_type' => 'Sub Category',
                    'name' => 'Name',
                    'email_1' => 'Email 1',
                    'email_2' => 'Email 2',
                    'phone_1' => 'Phone 1',
                    'phone_2' => 'Phone 2',
                    'designation' => 'Designation',
                    'company_name' => 'Company Name',
                    'references' => 'References',
                    'remarks' => 'Remarks',
                    'field_1' => 'Field 1',
                    'field_2' => 'Field 2',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getCategoryType() {
                return $this->hasOne(ContactCategoryTypes::className(), ['id' => 'category_type']);
        }

        public function getDesignationType() {
                return $this->hasOne(ContactDirectoryDesignation::className(), ['id' => 'designation']);
        }

        public static function subcategory($category) {
                if ($category) {
                        $subcategory = \yii\helpers\ArrayHelper::map(ContactSubcategory::find()->where(['status' => '1', 'category_id' => $category])->asArray()->all(), 'id', 'sub_category');
                } else {
                        $subcategory = \yii\helpers\ArrayHelper::map(ContactSubcategory::find()->where(['status' => '1'])->asArray()->all(), 'id', 'sub_category');
                }
                return $subcategory;
        }

}
