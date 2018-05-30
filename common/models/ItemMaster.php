<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_master".
 *
 * @property integer $id
 * @property string $SKU
 * @property string $item_name
 * @property integer $item_type
 * @property integer $tax_id
 * @property integer $base_unit_id
 * @property string $MRP
 * @property string $retail_price
 * @property string $purchase_prce
 * @property string $item_cost
 * @property string $whole_sale_price
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property BaseUnit $baseUnit
 * @property Tax $tax
 */
class ItemMaster extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'item_master';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['SKU', 'item_name', 'tax_id', 'base_unit_id', 'retail_price', 'purchase_price'], 'required'],
                        [['SKU'], 'unique', 'targetAttribute' => ['SKU'], 'on' => 'create'],
                        [['item_type', 'tax_id', 'base_unit_id', 'status', 'CB', 'UB', 'hsn'], 'integer'],
                        [['MRP', 'retail_price', 'purchase_price', 'item_cost', 'whole_sale_price'], 'number'],
                        [['DOC', 'DOU'], 'safe'],
                        [['item_name'], 'string', 'max' => 30],
                        [['base_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => BaseUnit::className(), 'targetAttribute' => ['base_unit_id' => 'id']],
                        [['tax_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tax::className(), 'targetAttribute' => ['tax_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'SKU' => 'SKU (Item Code)',
                    'item_name' => 'Item Name',
                    'item_type' => 'Item Type',
                    'tax_id' => 'Tax',
                    'base_unit_id' => 'Base Unit',
                    'MRP' => 'Mrp',
                    'retail_price' => 'Retail Price',
                    'purchase_price' => 'Purchase Price',
                    'item_cost' => 'Item Cost',
                    'whole_sale_price' => 'Whole Sale Price',
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
        public function getBaseUnit() {
                return $this->hasOne(BaseUnit::className(), ['id' => 'base_unit_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getTax() {
                return $this->hasOne(Tax::className(), ['id' => 'tax_id']);
        }

}
