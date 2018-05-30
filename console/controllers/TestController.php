<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\db\Expression;

/**
 * ExpensesController implements the CRUD actions for Expenses model.
 */
class TestController extends Controller {

        public function actionIndex() {

                //////////////////////////followup added///////////////////////
                $today_date_time = date('Y-m-d H:i:s');
                $today = date("Y-m-d");
                $today_day = date("l");
                $today_date = date("j");

                /*
                 * Ever Day
                 */

                $today_followup = \common\models\RepeatedFollowups::find()->where(['repeated_type' => 4])->all();
                foreach ($today_followup as $value) {
                        $followup = new \common\models\Followups();
                        Yii::$app->Followups->Addcronfollowup($followup, $value);
                }

                /*
                 * Specific days in a week
                 */
                $followup_days = \common\models\RepeatedFollowups::find()->where(new Expression('FIND_IN_SET(:repeated_days, repeated_days)'))->addParams([':repeated_days' => $today_day])->all();
                foreach ($followup_days as $value) {
                        $followup = new \common\models\Followups();
                        Yii::$app->Followups->Addcronfollowup($followup, $value);
                }

                /*
                 * specific dates in a month
                 */

                $followup_dates = \common\models\RepeatedFollowups::find()->where(new Expression('FIND_IN_SET(:repeated_days, repeated_days)'))->addParams([':repeated_days' => $today_date])->all();

                foreach ($followup_dates as $value) {
                        $followup = new \common\models\Followups();
                        $dd = Yii::$app->Followups->Addcronfollowup($followup, $value);
                }

                /////////////////////status update of service advanced/////////////////////////////////////

                $services = \common\models\Service::find()->where(['status' => 3])->all();
                foreach ($services as $value) {
                        if ($value->from_date == date('Y-m-d')) {
                                $value->status = 1;
                                $value->save();
                        }
                }


                ///////////////////////////pending folllowups///////////////////////////////////////////
                $pending_followups = \common\models\Followups::find()->where(['<=', 'followup_date', date('Y-m-d')])->andWhere(['status' => 0])->all();

                foreach ($pending_followups as $pending_followup) {
                        if ($pending_followup->type == 1) {
                                $data_model = \common\models\PatientEnquiryGeneralFirst::find()->where(['id' => $pending_followup->type_id])->one();
                                $superadmins = StaffInfo::find()->where(['branch_id' => $data_model->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();
                                foreach ($superadmins as $superadmin) {
                                        $x .= $superadmin->id . ',';
                                }
                                $content = "A followup is pending for patient enquiry " . $data_model->enquiry_number;
                        } elseif ($pending_followup->type == 2) {


                                $data_model2 = PatientGeneral::find()->where(['id' => $pending_followup->type_id])->one();

                                $superadmins = StaffInfo::find()->where(['branch_id' => $data_model2->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();

                                foreach ($superadmins as $superadmin) {
                                        $x .= $superadmin->id . ',';
                                }
                                $content = "A followup is pending for patient " . $data_model2->patient_id;
                        } elseif ($pending_followup->type == 3) {
                                $data_model3 = \common\models\StaffEnquiry::find()->where(['id' => $pending_followup->type_id])->one();
                                $superadmins = StaffInfo::find()->where(['branch_id' => $data_model3->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();
                                foreach ($superadmins as $superadmin) {
                                        $x .= $superadmin->id . ',';
                                }
                                $content = "A followup is pending for staff enquiry " . $data_model3->enquiry_id;
                        } elseif ($pending_followup->type == 4) {
                                $data_model4 = StaffInfo::find()->where(['id' => $pending_followup->type_id])->one();
                                $superadmins = StaffInfo::find()->where(['branch_id' => $data_model4->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();
                                foreach ($superadmins as $superadmin) {
                                        $x .= $superadmin->id . ',';
                                }
                                $content = "A followup is pending for staff " . $data_model4->staff_id;
                        } elseif ($pending_followup->type == 5) {
                                $data_model5 = Service::find()->where(['id' => $pending_followup->type_id])->one();
                                $superadmins = StaffInfo::find()->where(['branch_id' => $data_model5->branch_id, 'status' => 1, 'post_id' => 1])->orWhere(['branch_id' => 0])->all();
                                foreach ($superadmins as $superadmin) {
                                        $x .= $superadmin->id . ',';
                                }
                                $x .= $data_model5->staff_manager . ',';
                                $content = "A followup is pending for service " . $data_model5->service_id;
                        }
                        $x .= $pending_followup->assigned_to;
                        $this->AddDataToPendingFollowups($pending_followup->id, $x, $content);
                        $x = '';
                }
        }

        public function AddDataToPendingFollowups($followup_id, $assigne_to, $content) {
                $exist = \common\models\PendingFollowups::find()->where(['followup_id' => $followup_id])->one();
                if (empty($exist)) {
                        $model = new \common\models\PendingFollowups();
                        $model->followup_id = $followup_id;
                        $model->assigned_to = $assigne_to;
                        $model->content = $content;
                        $model->status = 0;
                        $model->save();
                        return TRUE;
                } else {
                        return true;
                }
        }

}
