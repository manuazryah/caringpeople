<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_view".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $item_code
 * @property string $item_name
 * @property string $mrp
 * @property string $retail_price
 * @property string $ws_price
 * @property string $location_code
 * @property string $available_qty
 * @property string $available_weight
 * @property string $average_cost
 * @property string $error_msg
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class StockView extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'stock_view';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['item_id', 'status', 'CB', 'UB'], 'integer'],
                        [['mrp', 'retail_price', 'ws_price', 'available_qty', 'available_weight', 'average_cost'], 'number'],
                        [['DOC'], 'required'],
                        [['item_name', 'DOC', 'DOU'], 'safe'],
                        [['item_code'], 'string', 'max' => 250],
                        [['location_code'], 'string', 'max' => 15],
                        [['error_msg'], 'string', 'max' => 50],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'item_id' => 'Item ID',
                    'item_code' => 'Item Code',
                    'item_name' => 'Item Name',
                    'mrp' => 'Mrp',
                    'retail_price' => 'Retail Price',
                    'ws_price' => 'Ws Price',
                    'location_code' => 'Location Code',
                    'available_qty' => 'Available Qty',
                    'available_weight' => 'Available Weight',
                    'average_cost' => 'Average Cost',
                    'error_msg' => 'Error Msg',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
