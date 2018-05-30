<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_adj_dtl".
 *
 * @property integer $id
 * @property integer $StockAdjMstId
 * @property integer $transaction
 * @property string $document_no
 * @property string $document_date
 * @property string $item_code
 * @property string $item_name
 * @property string $location_code
 * @property string $item_cost
 * @property integer $qty
 * @property string $weight
 * @property string $total_cost
 * @property string $reference
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property integer $DOC
 * @property string $DOU
 */
class StockAdjDtl extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'stock_adj_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'StockAdjMstId', 'transaction', 'qty', 'status', 'CB', 'UB', 'item_id'], 'integer'],
            [['document_date', 'DOU', 'DOC'], 'safe'],
            [['item_cost', 'weight', 'total_cost'], 'number'],
            [['document_no'], 'string', 'max' => 30],
            [['item_code', 'item_name', 'reference'], 'string', 'max' => 50],
            [['location_code'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'StockAdjMstId' => 'Stock Adj Mst ID',
            'transaction' => 'Transaction',
            'document_no' => 'Document No',
            'document_date' => 'Document Date',
            'item_code' => 'Item Code',
            'item_name' => 'Item Name',
            'location_code' => 'Location Code',
            'item_cost' => 'Item Cost',
            'qty' => 'Qty',
            'weight' => 'Weight',
            'total_cost' => 'Total Cost',
            'reference' => 'Reference',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
