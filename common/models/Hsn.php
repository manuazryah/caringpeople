<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hsn".
 *
 * @property integer $id
 * @property integer $tax
 * @property string $hsn
 * @property string $hsn_name
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Hsn extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'hsn';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['tax', 'hsn', 'hsn_name'], 'required'],
            [['tax', 'status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['hsn', 'hsn_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'tax' => 'Tax',
            'hsn' => 'HSN',
            'hsn_name' => 'HSN Name',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
