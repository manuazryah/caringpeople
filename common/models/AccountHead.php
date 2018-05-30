<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "account_head".
 *
 * @property integer $id
 * @property string $ac_holder
 * @property string $bank_name
 * @property string $account_no
 * @property string $ifsc_code
 * @property string $branch
 * @property integer $branch_id
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class AccountHead extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'account_head';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['branch_id', 'status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['ac_holder', 'bank_name', 'account_no', 'ifsc_code', 'branch'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'ac_holder' => 'Account Holder',
                    'bank_name' => 'Bank Name',
                    'account_no' => 'A/c No',
                    'ifsc_code' => 'Ifsc Code',
                    'branch' => 'Branch',
                    'branch_id' => 'Branch ID',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
