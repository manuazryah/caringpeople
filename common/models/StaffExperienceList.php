<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_experience_list".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class StaffExperienceList extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_experience_list';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['title', 'category'], 'required'],
                        [['status', 'CB', 'UB', 'category', 'sub_category'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['title'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'category' => 'Category',
                    'sub_category' => 'Sub Category',
                    'title' => 'Title',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        public function getSubCat() {
                return $this->hasOne(AssessmentCategory::className(), ['id' => 'sub_category']);
        }

}
