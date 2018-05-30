<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\db\Expression;

/**
 * ExpensesController implements the CRUD actions for Expenses model.
 */
class PatientenquiryupdateController extends Controller {

        public function actionIndex() {
                $today = date('Y-m-d');
                $patient_equiry = \common\models\PatientEnquiryGeneralFirst::find()->where(['status' => 1])->all();
                foreach ($patient_equiry as $enquiry) {
                        $start_ts = strtotime($enquiry->DOC);
                        $end_ts = strtotime($today);
                        $diff = $end_ts - $start_ts;
                        $difference = round($diff / 86400);
                        if ($difference > 30) {
                                $enquiry->status = 3;
                                $enquiry->update();
                        }
                }
        }

}
