<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assessment_category".
 *
 * @property integer $id
 * @property integer $assessment_id
 * @property string $sub_category
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class AssessmentCategory extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'assessment_category';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['assessment_id', 'status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['sub_category'], 'string', 'max' => 200],
                        [['sub_category'], 'required']
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'assessment_id' => 'Assessment ID',
                    'sub_category' => 'Category',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
