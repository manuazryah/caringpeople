<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "enquiry".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property integer $contacted_source
 * @property string $contacted_date
 * @property string $incoming_missed
 * @property string $contacted_source_others
 * @property string $outgoing_number_from
 * @property string $outgoing_call_date
 * @property string $caller_name
 * @property string $referral_source
 * @property string $mobile_number
 * @property string $mobile_number_2
 * @property string $mobile_number_3
 * @property string $address
 * @property string $city
 * @property string $zip_pc
 * @property string $email
 * @property string $service_required_for
 * @property string $service_required_for_others
 * @property integer $age
 * @property double $weight
 * @property integer $relationship
 * @property integer $veteran_or_spouse
 * @property string $person_address
 * @property string $person_city
 * @property string $person_postal_code
 * @property integer $branch_id
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property EnquiryHospitalDoctorInfo[] $enquiryHospitalDoctorInfos
 * @property EnquiryOtherInfo[] $enquiryOtherInfos
 */
class Enquiry extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'enquiry';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['contacted_source', 'caller_gender', 'whatsapp_number', 'person_gender', 'age', 'relationship', 'veteran_or_spouse', 'branch_id', 'status', 'whatsapp_reply', 'CB', 'UB'], 'integer'],
                        [['contacted_source_others', 'contacted_date', 'outgoing_call_date', 'DOC', 'DOU', 'branch_id'], 'safe'],
                        [['contacted_source','email','status','whatsapp_reply'], 'required', 'on' => 'create'],
//		    [['weight'], 'number'],
                    [['email'], 'email'],
                        [['incoming_missed', 'contacted_source_others', 'outgoing_number_from', 'outgoing_number_from_other', 'caller_name', 'referral_source', 'mobile_number', 'mobile_number_2', 'mobile_number_3', 'city', 'zip_pc', 'email', 'service_required_for', 'service_required_for_others', 'person_city', 'person_postal_code','notes','whatsapp_note'], 'string', 'max' => 100],
                        [['address', 'person_address'], 'string', 'max' => 200],
                        [['incoming_missed'], 'required', 'message' => "Contact Source Data cannot be blank"],
[['branch_id'], 'required', 'when' => function ($model) {
                                return Yii::$app->user->identity->branch_id == 0;
                        },],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'enquiry_id' => 'Enquiry Number',
                    'contacted_source' => 'Contacted Source',
                    'contacted_date' => 'Contacted Date',
                    'incoming_missed' => 'Incoming/missed',
                    'contacted_source_others' => 'Contacted Source Others',
                    'outgoing_number_from' => 'Outgoing Number From',
                    'outgoing_number_from_other' => 'Outgoing Number From Other',
                    'outgoing_call_date' => 'Outgoing Call Date',
                    'caller_name' => 'Caller Name',
                    'caller_gender' => 'Gender',
                    'referral_source' => 'Referral Source',
                    'mobile_number' => 'Mobile Number',
                    'mobile_number_2' => 'Mobile Number 2',
                    'mobile_number_3' => 'Mobile Number 3',
                    'address' => 'Address',
                    'city' => 'City',
                    'zip_pc' => 'Zip/PC',
                    'email' => 'Email',
                    'service_required_for' => 'Required Person Name',
                    'service_required_for_others' => 'Relationship Others',
                    'person_gender' => 'Gender',
                    'age' => 'Age',
                    'weight' => 'Weight',
                    'relationship' => 'Relationship',
                    'veteran_or_spouse' => 'Veteran Or Spouse',
                    'person_address' => 'Person Address',
                    'person_city' => 'Person City',
                    'person_postal_code' => 'Person Postal Code',
                    'whatsapp_reply' => 'Whatsapp Reply',
                    'whatsapp_number' => 'Whatsapp Number',
                    'whatsapp_note' => 'Whatsapp Note',
                    'notes' => 'Notes',
                    'branch_id' => 'Branch',
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
        public function getEnquiryHospitalDoctorInfos() {
                return $this->hasMany(EnquiryHospitalDoctorInfo::className(), ['enquiry_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getEnquiryOtherInfos() {
                return $this->hasMany(EnquiryOtherInfo::className(), ['enquiry_id' => 'id']);
        }

}
