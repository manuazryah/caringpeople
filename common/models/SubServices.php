<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sub_services".
 *
 * @property integer $id
 * @property integer $service
 * @property string $sub_service
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property MasterServiceTypes $service0
 */
class SubServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service', 'CB', 'UB','status','branch_id'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['sub_service'], 'string', 'max' => 200],
            [['service'], 'exist', 'skipOnError' => true, 'targetClass' => MasterServiceTypes::className(), 'targetAttribute' => ['service' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service' => 'Service',
            'sub_service' => 'Sub Service',
            'status'=>'Status',
            'branch_id'=>'Branch',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService0()
    {
        return $this->hasOne(MasterServiceTypes::className(), ['id' => 'service']);
    }
}
