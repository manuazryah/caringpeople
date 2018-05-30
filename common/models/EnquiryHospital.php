<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "enquiry_hospital".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property string $hospital_name
 * @property string $consultant_doctor
 * @property string $hospital_room_no
 * @property string $required_service
 * @property string $other_services
 * @property string $diabetic
 * @property string $hypertension
 * @property string $tubes
 * @property string $feeding
 * @property string $urine
 * @property string $oxygen
 * @property string $tracheostomy
 * @property string $iv_line
 * @property string $dressing
 * @property string $visit_type
 * @property string $visit_date
 * @property string $bedridden
 *
 * @property Enquiry $enquiry
 */
class EnquiryHospital extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'enquiry_hospital';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['diabetic', 'feeding', 'urine', 'oxygen'], 'required'],
                        [['visit_date'], 'safe'],
                        [['bedridden'], 'string'],
                        [['hospital_name', 'consultant_doctor', 'department', 'hospital_room_no', 'other_services', 'diabetic', 'diabetic_note', 'hypertension', 'tubes', 'feeding', 'urine', 'oxygen', 'tracheostomy', 'iv_line', 'dressing', 'visit_type', 'visit_note'], 'string', 'max' => 200],
                        [['enquiry_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enquiry::className(), 'targetAttribute' => ['enquiry_id' => 'id']],
                        [['visit_note', 'visit_date',], 'required', 'when' => function ($model) {

                        }, 'whenClient' => "function (attribute, value) {
                             return $('#enquiryhospital-visit_type').val() != '2';
                        }"],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'enquiry_id' => 'Enquiry ID',
                    'hospital_name' => 'Hospital Name',
                    'consultant_doctor' => 'Consultant Doctor',
                    'department' => 'Department',
                    'hospital_room_no' => 'Hospital Room No',
                    'required_service' => 'Required Service',
                    'other_services' => 'Other Services Notes',
                    'diabetic' => 'Diabetic',
                    'diabetic_note' => 'Diabetic Note',
                    'hypertension' => 'Hypertension',
                    'tubes' => "Tube's",
                    'feeding' => 'Feeding Tube',
                    'urine' => 'Urine Tube',
                    'oxygen' => 'Oxygen',
                    'tracheostomy' => 'Tracheostomy',
                    'iv_line' => 'IV LINE',
                    'dressing' => 'Dressing',
                    'visit_type' => 'Visit Type',
                    'visit_note' => 'Visit Note',
                    'visit_date' => 'Visit Date',
                    'bedridden' => 'Notes',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getEnquiry() {
                return $this->hasOne(Enquiry::className(), ['id' => 'enquiry_id']);
        }

}
