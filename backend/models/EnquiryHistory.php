<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enquiry_history".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property integer $user_id
 * @property string $date
 * @property string $DOU
 */
class EnquiryHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enquiry_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enquiry_id', 'user_id'], 'required'],
            [['enquiry_id', 'user_id'], 'integer'],
            [['date', 'DOU'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enquiry_id' => 'Enquiry ID',
            'user_id' => 'User ID',
            'date' => 'Date',
            'DOU' => 'Dou',
        ];
    }
}
