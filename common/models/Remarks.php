<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "remarks".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $type_id
 * @property integer $category
 * @property string $sub_category
 * @property string $notes
 * @property integer $remark_type
 * @property integer $point
 * @property string $date
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property RemarksCategory $category0
 */
class Remarks extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'remarks';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['category'], 'required'],
                        [['type', 'type_id', 'category', 'remark_type', 'point', 'status', 'CB', 'UB'], 'integer'],
                        [['notes'], 'string'],
                        [['date', 'DOC', 'DOU'], 'safe'],
                        [['sub_category'], 'string', 'max' => 200],
                        [['category'], 'exist', 'skipOnError' => true, 'targetClass' => RemarksCategory::className(), 'targetAttribute' => ['category' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'type' => 'Type',
                    'type_id' => 'Type ID',
                    'category' => 'Category',
                    'sub_category' => 'Sub Category',
                    'notes' => 'Notes',
                    'remark_type' => 'Remark Type',
                    'point' => 'Point',
                    'date' => 'Date',
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
        public function getCategory0() {
                return $this->hasOne(RemarksCategory::className(), ['id' => 'category']);
        }

}
