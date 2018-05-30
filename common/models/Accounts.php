<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "accounts".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property integer $invoice_id
 * @property integer $debited_to_credited_by
 * @property integer $type
 * @property string $purpose
 * @property integer $payment_type
 * @property string $amount
 * @property string $payment_date
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Accounts extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'accounts';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['branch_id', 'invoice_id', 'debited_to_credited_by', 'type', 'payment_type', 'CB', 'UB'], 'integer'],
                        [['payment_date', 'DOC', 'DOU'], 'safe'],
                        [['purpose', 'amount'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'branch_id' => 'Branch',
                    'invoice_id' => 'Invoice ID',
                    'debited_to_credited_by' => 'Debited To Credited By',
                    'type' => 'Type',
                    'purpose' => 'Purpose',
                    'payment_type' => 'Payment Type',
                    'amount' => 'Amount',
                    'payment_date' => 'Payment Date',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                   'reference_type' => 'Type',
                ];
        }

        public static function creditTotal($provider, $fieldName) {
                $total = 0;
                foreach ($provider as $item) {
                        if ($item['type'] == 2)
                                $total += $item[$fieldName];
                }
                $total = number_format((float) $total, 2, '.', '');
                return $total;
        }

        public static function debitTotal($provider, $fieldName) {
                $total = 0;
                foreach ($provider as $item) {
                        if ($item['type'] == 1)
                                $total += $item[$fieldName];
                }
                $total = number_format((float) $total, 2, '.', '');
                return $total;
        }

}
