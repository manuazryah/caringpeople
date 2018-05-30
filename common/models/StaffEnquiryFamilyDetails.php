<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_enquiry_family_details".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property string $name
 * @property string $relationship
 * @property string $job
 * @property string $mobile_no
 *
 * @property StaffEnquiry $enquiry
 */
class StaffEnquiryFamilyDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff_enquiry_family_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enquiry_id'], 'integer'],
            [['name', 'relationship', 'job', 'mobile_no'], 'string', 'max' => 250],
            [['enquiry_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaffEnquiry::className(), 'targetAttribute' => ['enquiry_id' => 'id']],
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
            'name' => 'Name',
            'relationship' => 'Relationship',
            'job' => 'Job',
            'mobile_no' => 'Mobile No',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiry()
    {
        return $this->hasOne(StaffEnquiry::className(), ['id' => 'enquiry_id']);
    }
}
