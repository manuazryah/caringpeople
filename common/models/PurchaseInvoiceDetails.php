<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "purchase_invoice_details".
 *
 * @property integer $id
 * @property integer $sales_invoice_master_id
 * @property string $sales_invoice_number
 * @property string $sales_invoice_date
 * @property integer $busines_partner_code
 * @property integer $item_id
 * @property string $item_code
 * @property string $item_name
 * @property integer $base_unit
 * @property integer $qty
 * @property string $rate
 * @property string $amount
 * @property integer $discount_type
 * @property string $discount_value
 * @property string $discount_amount
 * @property string $net_amount
 * @property integer $tax_id
 * @property string $tax_percentage
 * @property string $tax_amount
 * @property string $line_total
 * @property string $reference
 * @property string $error_message
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class PurchaseInvoiceDetails extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'purchase_invoice_details';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['sales_invoice_master_id'], 'required'],
            [['sales_invoice_master_id', 'busines_partner_code', 'item_id', 'base_unit', 'qty', 'discount_type', 'tax_id', 'status', 'CB', 'UB', 'tax_type'], 'integer'],
            [['sales_invoice_date', 'DOC', 'DOU', 'hsn', 'CB', 'UB', 'comments'], 'safe'],
            [['rate', 'amount', 'discount_value', 'discount_amount', 'net_amount', 'tax_amount', 'line_total'], 'number'],
            [['sales_invoice_number', 'reference', 'error_message'], 'string', 'max' => 50],
            [['item_code', 'item_name', 'tax_percentage'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'sales_invoice_master_id' => 'Sales Invoice Master ID',
            'sales_invoice_number' => 'Sales Invoice Number',
            'sales_invoice_date' => 'Sales Invoice Date',
            'busines_partner_code' => 'Customer',
            'item_id' => 'Item ID',
            'item_code' => 'Item Code',
            'item_name' => 'Item Name',
            'base_unit' => 'Base Unit',
            'qty' => 'Qty',
            'rate' => 'Rate',
            'amount' => 'Amount',
            'discount_type' => 'Discount Type',
            'discount_value' => 'Discount Value',
            'discount_amount' => 'Discount Amount',
            'net_amount' => 'Net Amount',
            'tax_id' => 'Tax ID',
            'tax_percentage' => 'Tax Percentage',
            'tax_type' => 'Tax Type',
            'tax_amount' => 'Tax Amount',
            'line_total' => 'Line Total',
            'reference' => 'Reference',
            'comments' => 'Comments',
            'error_message' => 'Error Message',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
