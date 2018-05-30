<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "business_partner".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property integer $phone
 * @property string $email
 * @property string $city
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class BusinessPartner extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'business_partner';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'name', 'business_partner_code'], 'required'],
            [['type', 'status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['name'], 'string', 'max' => 30],
            [['email', 'city', 'business_partner_code', 'phone'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'city' => 'City',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
