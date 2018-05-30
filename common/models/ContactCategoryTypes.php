<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_category_types".
 *
 * @property integer $id
 * @property string $category_name
 * @property string $description
 * @property integer $status
 * @property integer $field_1
 * @property integer $CB
 * @property integer $UB
 * @property integer $DOC
 * @property string $DOU
 *
 * @property ContactDirectory[] $contactDirectories
 */
class ContactCategoryTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_category_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'field_1', 'CB', 'UB', 'DOC'], 'integer'],
            [['DOU'], 'safe'],
            [['category_name', 'description'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
            'description' => 'Description',
            'status' => 'Status',
            'field_1' => 'Field 1',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactDirectories()
    {
        return $this->hasMany(ContactDirectory::className(), ['category_type' => 'id']);
    }
}
