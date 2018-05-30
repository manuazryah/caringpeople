<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_adj_mst".
 *
 * @property integer $id
 * @property integer $transaction
 * @property string $document_no
 * @property string $document_date
 * @property string $location_code
 * @property string $reference
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property integer $DOC
 * @property string $DOU
 */
class StockAdjMst extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'stock_adj_mst';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['transaction', 'document_no'], 'required'],
            [['transaction', 'status', 'CB', 'UB'], 'integer'],
            [['document_date', 'DOU'], 'safe'],
            [['reference'], 'string'],
            [['document_no'], 'string', 'max' => 30],
            [['location_code'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'transaction' => 'Transaction',
            'document_no' => 'Document No',
            'document_date' => 'Document Date',
            'location_code' => 'Location Code',
            'reference' => 'Reference',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
