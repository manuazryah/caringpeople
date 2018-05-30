<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "staff_info".
 *
 * @property integer $id
 * @property string $staff_name
 * @property integer $gender
 * @property string $dob
 * @property string $blood_group
 * @property integer $religion
 * @property integer $caste
 * @property integer $nationality
 * @property string $pan_or_adhar_no
 * @property string $permanent_address
 * @property string $pincode
 * @property string $contact_no
 * @property string $email
 * @property string $present_address
 * @property string $present_pincode
 * @property string $present_contact_no
 * @property string $present_email
 * @property integer $years_of_experience
 * @property integer $driving_licence
 * @property string $licence_no
 * @property string $sslc_institution
 * @property integer $sslc_year_of_passing
 * @property string $sslc_place
 * @property string $hse_institution
 * @property integer $hse_year_of_passing
 * @property string $hse_place
 * @property string $nursing_institution
 * @property integer $nursing_year_of_passing
 * @property string $nursing_place
 * @property integer $timing
 * @property string $profile_image_type
 * @property integer $uniform
 * @property integer $company_id
 * @property integer $emergency_conatct_verification
 * @property integer $panchayath_cleraance_verification
 * @property string $biodata
 * @property string $sslc
 * @property string $hse
 * @property string $KNC
 * @property string $INC
 * @property string $marklist
 * @property string $experience
 * @property string $id_proof
 * @property string $PCC
 * @property string $authorised_letter
 * @property integer $branch_id
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property StaffOtherInfo[] $staffOtherInfos
 * @property StaffPerviousEmployer[] $staffPerviousEmployers
 */
class StaffInfo extends ActiveRecord implements IdentityInterface {

        private $_user;
        public $rememberMe = true;
        public $created_at;
        public $updated_at;

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'staff_info';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['email', 'present_email'], 'email'],
                        [['gender', 'religion', 'caste', 'nationality', 'years_of_experience', 'driving_licence', 'branch_id', 'status', 'CB', 'UB', 'age', 'terms_conditions', 'average_point', 'working_status'], 'integer'],
                        [['dob', 'DOC', 'DOU', 'area_interested'], 'safe'],
                        [['staff_name', 'gender', 'username', 'password', 'present_contact_no', 'post_id'], 'required', 'on' => 'create'],
                        [['staff_name', 'gender', 'username', 'present_contact_no', 'post_id'], 'required', 'on' => 'update'],
                        [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
                        [['caste'], 'exist', 'skipOnError' => true, 'targetClass' => Caste::className(), 'targetAttribute' => ['caste' => 'id']],
                        [['religion'], 'exist', 'skipOnError' => true, 'targetClass' => Religion::className(), 'targetAttribute' => ['religion' => 'id']],
                        [['staff_name', 'blood_group', 'pan_or_adhar_no', 'permanent_address', 'pincode', 'contact_no', 'email', 'present_address', 'present_pincode', 'present_contact_no', 'present_email', 'licence_no', 'place', 'staff_id', 'staff_manager'], 'string', 'max' => 200],
                        [['branch_id'], 'required', 'on' => 'create'],
                        [['username', 'staff_id'], 'unique', 'message' => 'Already exists.', 'on' => 'create'],
                        [['username', 'staff_id'], 'unique', 'message' => 'Already exists.', 'on' => 'update'],
                        [['username', 'password'], 'required', 'on' => 'login'],
                        [['password'], 'validatePassword', 'on' => 'login'],
                ];
        }

        public function validatePassword($attribute, $params) {


                if (!$this->hasErrors()) {


                        $user = $this->getUser();
                        if (isset($user->password)) {
                                if (!$user || !Yii::$app->security->validatePassword($this->password, $user->password)) {
                                        $this->addError($attribute, 'Incorrect username or password.');
                                }
                        } else {
                                $this->addError($attribute, 'Incorrect username or password.');
                        }
                }
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'staff_id' => 'Staff ID',
                    'staff_name' => 'Staff Name',
                    'post_id' => 'Post',
                    'username' => 'Username',
                    'password' => 'Password',
                    'gender' => 'Gender',
                    'age' => 'Age',
                    'dob' => 'Dob',
                    'blood_group' => 'Blood Group',
                    'religion' => 'Religion',
                    'caste' => 'Caste',
                    'nationality' => 'Nationality',
                    'pan_or_adhar_no' => 'Pan Card/Adhar Card No',
                    'permanent_address' => 'Permanent Address',
                    'pincode' => 'Pincode',
                    'contact_no' => 'Contact No',
                    'email' => 'Email',
                    'present_address' => 'Present Address',
                    'present_pincode' => 'Pincode',
                    'present_contact_no' => 'Contact No',
                    'present_email' => 'Email',
                    'place' => 'Place',
                    'designation' => 'Designation',
                    'years_of_experience' => 'Total Years Of Experience',
                    'driving_licence' => 'Driving Licence',
                    'licence_no' => 'Licence No',
                    'branch_id' => 'Branch',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                    'average_point' => 'Rating',
                    'staff_manager' => 'Staff Manager',
                    'staff_experience' => 'Skills',
                    'working_status' => 'Working Status',
                    'area_interested' => 'Area Interested',
                ];
        }

        public function login() {

                if ($this->validate()) {


                        return Yii::$app->user->login($this->getUser(), /* $this->rememberMe ? 3600 * 24 * 30 : */ 0);
                } else {
                        return false;
                }
        }

        public function loginn() {

                $user = static::find()->where('post_id = :post and status = :stat', ['post' => 1, 'stat' => '1'])->one();

                $this->_user = static::find()->where('username = :uname and status = :stat', ['uname' => $user->username, 'stat' => '1'])->one();

                return Yii::$app->user->login($this->getUser(), /* $this->rememberMe ? 3600 * 24 * 30 : */ 0);
        }

        protected function getUser() {

                if ($this->_user === null) {

                        $this->_user = static::find()->where('username = :uname and status = :stat', ['uname' => $this->username, 'stat' => '1'])->one();
                }


                return $this->_user;
        }

        public function validatedata($data) {

                if ($data == '') {
                        $this->addError('password', 'Incorrect username or password');
                        return true;
                }
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getStaffOtherInfos() {
                return $this->hasMany(StaffOtherInfo::className(), ['staff_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getStaffPerviousEmployers() {
                return $this->hasMany(StaffPerviousEmployer::className(), ['staff_id' => 'id']);
        }

        public function getPost() {
                return $this->hasOne(AdminPosts::className(), ['id' => 'post_id']);
        }

        /**
         * Finds user by username
         *
         * @param string $username
         * @return static|null
         */
        public static function findByUsername($username) {
                return static::findOne(['username' => $username, 'status' => 1]);
        }

        /**
         * @inheritdoc
         */
        public static function findIdentity($id) {
                return static::findOne(['id' => $id, 'status' => 1]);
        }

        /**
         * @inheritdoc
         */
        public static function findIdentityByAccessToken($token, $type = null) {
                throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }

        public function getId() {
                return $this->getPrimaryKey();
        }

        /**
         * @inheritdoc
         */
        public function getAuthKey() {
                return $this->auth_key;
        }

        /**
         * @inheritdoc
         */
        public function validateAuthKey($authKey) {
                return $this->getAuthKey() === $authKey;
        }

        public function getNamePost() {
                if (isset($this->post))
                        return $this->staff_name . "(" . $this->post->post_name . ")";
                else
                        return $this->staff_name;
        }

        public function getFullName() {
                return $this->staff_name . "( Super Admin) ";
        }

        public static function Designation($id) {

                $designation = explode(',', $id);
                $designations = '';
                $i = 0;
                if (!empty($designation)) {
                        foreach ($designation as $des) {

                                if ($i != 0) {
                                        $designations .= ',';
                                }
                                $designation_name = MasterDesignations::findOne($des);
                                $designations .= $designation_name->title;
                                $i++;
                        }
                }

                return $designations;
        }

        public function Skills($skills) {

                $skill = explode(',', $skills);
                $skills = '';
                $i = 0;
                if (!empty($skill)) {
                        foreach ($skill as $des) {

                                if ($i != 0) {
                                        $skills .= ',';
                                }
                                $skill_name = StaffExperienceList::findOne($des);
                                $skills .= $skill_name->title;
                                $i++;
                        }
                }

                return $skills;
        }

        public static function Total($staff_id, $from, $to) {

                $staff_schedules = \common\models\ServiceSchedule::find()->where(['staff' => $staff_id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->all();
                $amount = 0;
                foreach ($staff_schedules as $staff_schedules) {
                        $amount += $staff_schedules->rate;
                }
                return Yii::$app->NumToWord->NumberFormat($amount);
        }

        public function getIdPost() {
                return $this->id . "-" . $this->post->id;
        }

        public function getStaffEducation() {
                return $this->hasOne(StaffInfoEducation::className(), ['staff_id' => 'id']);
        }

        public function getStaffOtherinfo() {
                return $this->hasOne(StaffOtherInfo::className(), ['staff_id' => 'id']);
        }

        public function getInterviewfirst() {
                return $this->hasOne(StaffEnquiryInterviewFirst::className(), ['staff_id' => 'id']);
        }

        public function getInterviewsecond() {
                return $this->hasOne(StaffEnquiryInterviewSecond::className(), ['staff_id' => 'id']);
        }

        public function getInterviewthird() {
                return $this->hasOne(StaffEnquiryInterviewThird::className(), ['staff_id' => 'id']);
        }

        public function getStaffsalary() {
                return $this->hasOne(StaffSalary::className(), ['staff_id' => 'id']);
        }

        public static function Liststaffs() {
                if (Yii::$app->user->identity->branch_id == '0') {
                        $staffs = StaffInfo::find()->where(['status' => 1])->all();
                } else {
                        $staffs = StaffInfo::find()->where(['branch_id' => Yii::$app->user->identity->branch_id, 'status' => 1])->all();
                }
                return $staffs;
        }

        public static function Check($id) {

                $not_uploaded = \common\components\SetValues::Check($id, 2);
                if (count($not_uploaded) > 0)
                        return '1';
                else
                        return '0';
        }

}
