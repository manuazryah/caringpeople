<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "base_unit".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class BaseUnit extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'base_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'value'], 'required'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU', 'value'], 'safe'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Date of Creation',
            'DOU' => 'Date of Updation',
        ];
    }

}
