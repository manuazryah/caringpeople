<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sales_invoice_master".
 *
 * @property integer $id
 * @property string $sales_invoice_number
 * @property string $sales_invoice_date
 * @property integer $order_type
 * @property string $busines_partner_code
 * @property string $salesman
 * @property string $payment_terms
 * @property string $delivery_terms
 * @property string $amount
 * @property string $tax_amount
 * @property string $order_amount
 * @property string $ship_to_adress
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
 *
 * @property SalesInvoiceDetails[] $salesInvoiceDetails
 */
class SalesInvoiceMaster extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'sales_invoice_master';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['sales_invoice_date', 'DOC', 'DOU', 'due_date', 'general_terms', 'CB', 'UB', 'receipt_no'], 'safe'],
                        [['order_type', 'payment_status', 'status', 'CB', 'UB', 'busines_partner_code', 'salesman', 'receipt_id'], 'integer'],
                        [['amount', 'tax_amount', 'order_amount', 'amount_payed', 'due_amount', 'card_amount', 'cash_amount', 'round_of_amount', 'discount_amount', 'goods_total', 'service_total'], 'number'],
                        [['sales_invoice_number', 'ship_to_adress', 'reference', 'error_message'], 'string', 'max' => 50],
                        [['sales_invoice_number'], 'unique'],
                        [['payment_terms', 'delivery_terms'], 'string', 'max' => 30],
                        [['busines_partner_code'], 'required']
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'sales_invoice_number' => 'Sales Invoice Number',
                    'sales_invoice_date' => 'Date',
                    'order_type' => 'Order Type',
                    'busines_partner_code' => 'Service',
                    'salesman' => 'Patient',
                    'payment_terms' => 'Payment Terms',
                    'delivery_terms' => 'Delivery Terms',
                    'general_terms' => 'General Terms',
                    'amount' => 'Amount',
                    'tax_amount' => 'Tax Amount',
                    'order_amount' => 'Order Amount',
                    'ship_to_adress' => 'Ship To Adress',
                    'amount_payed' => 'Amount Paid',
                    'due_amount' => 'Due Amount',
                    'due_date' => 'Due Date',
                    'payment_status' => 'Payment Status',
                    'reference' => 'Reference',
                    'error_message' => 'Error Message',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getSalesInvoiceDetails() {
                return $this->hasMany(SalesInvoiceDetails::className(), ['sales_invoice_master_id' => 'id']);
        }

        public static function getSaleTotal($from_date, $to, $field_name) {
                if ($from_date != '' && $to != '') {
                        $from_date = $from_date . ' 00:00:00';
                        $to = $to . ' 60:60:60';
                        return SalesInvoiceMaster::find()->where(['>=', 'sales_invoice_date', $from_date])->andWhere(['<=', 'sales_invoice_date', $to])->sum($field_name);
                } elseif ($from_date != '' || $to != '') {
                        return 0;
                } else {
                        return SalesInvoiceMaster::find()->sum($field_name);
                }
        }

}
