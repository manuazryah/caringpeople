<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_register".
 *
 * @property integer $id
 * @property integer $transaction
 * @property integer $document_line_id
 * @property string $document_no
 * @property string $document_date
 * @property string $item_code
 * @property string $item_name
 * @property string $location_code
 * @property string $item_cost
 * @property integer $qty_in
 * @property integer $qty_out
 * @property string $weight_in
 * @property string $weight_out
 * @property string $total_cost
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class StockRegister extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'stock_register';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['transaction', 'document_line_id', 'qty_in', 'qty_out', 'status', 'CB', 'UB', 'item_id'], 'integer'],
            [['document_date', 'DOC', 'DOU', 'balance_qty'], 'safe'],
            [['item_cost', 'weight_in', 'weight_out', 'total_cost'], 'number'],
            [['document_no', 'item_code', 'item_name', 'location_code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'transaction' => 'Transaction',
            'document_line_id' => 'Document Line ID',
            'document_no' => 'Document No',
            'document_date' => 'Document Date',
            'item_code' => 'Item Code',
            'item_name' => 'Item Name',
            'location_code' => 'Location Code',
            'item_cost' => 'Item Cost',
            'qty_in' => 'Qty In',
            'qty_out' => 'Qty Out',
            'weight_in' => 'Weight In',
            'weight_out' => 'Weight Out',
            'total_cost' => 'Total Cost',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
