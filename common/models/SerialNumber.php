<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "serial_number".
 *
 * @property integer $id
 * @property integer $transaction
 * @property integer $prefix
 * @property integer $sequence_no
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class SerialNumber extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'serial_number';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['transaction', 'sequence_no', 'status', 'CB', 'UB'], 'integer'],
            [['transaction'], 'required'],
            [['DOC', 'DOU', 'prefix'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'transaction' => 'Transaction',
            'prefix' => 'Prefix',
            'sequence_no' => 'Sequence No',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Date of Creation',
            'DOU' => 'Date of Updation',
        ];
    }

}
