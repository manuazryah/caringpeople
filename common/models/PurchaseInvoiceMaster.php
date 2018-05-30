<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "purchase_invoice_master".
 *
 * @property integer $id
 * @property string $sales_invoice_number
 * @property string $sales_invoice_date
 * @property integer $order_type
 * @property integer $busines_partner_code
 * @property integer $salesman
 * @property string $payment_terms
 * @property string $delivery_terms
 * @property string $amount
 * @property string $tax_amount
 * @property string $order_amount
 * @property string $ship_to_adress
 * @property string $card_amount
 * @property string $cash_amount
 * @property string $round_of_amount
 * @property string $amount_payed
 * @property string $due_amount
 * @property integer $payment_status
 * @property string $reference
 * @property string $error_message
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class PurchaseInvoiceMaster extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'purchase_invoice_master';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['sales_invoice_date', 'DOC', 'DOU', 'due_date', 'CB', 'UB', 'general_terms', 'receipt_no', 'goods_total', 'service_total'], 'safe'],
                        [['order_type', 'busines_partner_code', 'salesman', 'payment_status', 'status', 'CB', 'UB', 'receipt_id', 'payment', 'branch_id'], 'integer'],
                        [['amount', 'tax_amount', 'order_amount', 'card_amount', 'cash_amount', 'round_of_amount', 'amount_payed', 'due_amount', 'discount_amount'], 'number'],
                        [['sales_invoice_number', 'ship_to_adress', 'reference', 'error_message'], 'string', 'max' => 50],
                        [['payment_terms', 'delivery_terms'], 'string', 'max' => 30],
                        [['branch_id'], 'required']
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'sales_invoice_number' => 'Sales Invoice Number',
                    'sales_invoice_date' => 'Sales Invoice Date',
                    'order_type' => 'Order Type',
                    'busines_partner_code' => 'Customer',
                    'salesman' => 'Buyer ',
                    'payment_terms' => 'Payment Terms',
                    'delivery_terms' => 'Delivery Terms',
                    'general_terms' => 'General Terms',
                    'amount' => 'Amount',
                    'tax_amount' => 'Tax Amount',
                    'order_amount' => 'Order Amount',
                    'ship_to_adress' => 'Ship To Adress',
                    'card_amount' => 'Card Amount',
                    'cash_amount' => 'Cash Amount',
                    'round_of_amount' => 'Round Of Amount',
                    'amount_payed' => 'Amount Paid',
                    'due_amount' => 'Due Amount',
                    'due_date' => 'Due Date',
                    'payment_status' => 'Payment Status',
                    'reference' => 'Reference',
                    'error_message' => 'Error Message',
                    'status' => 'Status',
                    'payment' => 'Payment',
                    'branch_id' => 'Branch',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        public static function getPurchaseTotal($from_date, $to, $field_name) {
                if ($from_date != '' && $to != '') {
                        $from_date = $from_date . ' 00:00:00';
                        $to = $to . ' 60:60:60';
                        return PurchaseInvoiceMaster::find()->where(['>=', 'sales_invoice_date', $from_date])->andWhere(['<=', 'sales_invoice_date', $to])->sum($field_name);
                } elseif ($from_date != '' || $to != '') {
                        return 0;
                } else {
                        return PurchaseInvoiceMaster::find()->sum($field_name);
                }
        }

}
