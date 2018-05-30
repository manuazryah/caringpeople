<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "followup_sub_type".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $sub_type
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property FollowupType $type
 */
class FollowupSubType extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'followup_sub_type';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['type_id', 'sub_type', 'status'], 'required'],
                        [['type_id', 'status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['sub_type'], 'string', 'max' => 200],
                        [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => FollowupType::className(), 'targetAttribute' => ['type_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'type_id' => 'Type',
                    'sub_type' => 'Sub Type',
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
        public function getType() {
                return $this->hasOne(FollowupType::className(), ['id' => 'type_id']);
        }

}
