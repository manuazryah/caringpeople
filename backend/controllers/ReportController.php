<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\StaffInfo;
use common\models\PatientGeneral;

class ReportController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        /*
         * show staffs on branch change :-staff report
         */

        public function actionStaffs() {
                if (Yii::$app->request->isAjax) {
                        $branch = $_POST['branch'];
                        $staffs = StaffInfo::find()->where(['branch_id' => $branch, 'status' => 1, 'post_id' => 5])->orderBy(['staff_name' => SORT_ASC])->all();
                        $options = '<option value="">-Select-</option>';
                        foreach ($staffs as $staffs) {
                                $options .= "<option value='" . $staffs->id . "'>" . $staffs->staff_name . "</option>";
                        }
                        echo $options;
                }
        }

        /*
         * show patients on patient change :-patient report
         */

        public function actionPatients() {
                if (Yii::$app->request->isAjax) {
                        $branch = $_POST['branch'];
                        $patients = PatientGeneral::find()->where(['branch_id' => $branch, 'status' => 1,])->orderBy(['first_name' => SORT_ASC])->all();
                        $options = '<option value="">-Select-</option>';
                        foreach ($patients as $patients) {
                                $options .= "<option value='" . $patients->id . "'>" . $patients->first_name . "</option>";
                        }
                        echo $options;
                }
        }

        /*
         * show services on patient change :-patient report
         */

        public function actionServices() {
                if (Yii::$app->request->isAjax) {
                        $patient = $_POST['patient'];
                        $services = \common\models\Service::find()->where(['patient_id' => $patient])->all();
                        if (count($services) > 1) {
                                $options .= "<option value='0'>All</option>";
                                foreach ($services as $services) {
                                        $options .= "<option value='" . $services->id . "'>" . $services->service_id . "</option>";
                                }
                                echo $options;
                        } else {
                                echo '0';
                        }
                }
        }

       /*
         * show services on patient change :-service report
         */

        public function actionServicesall() {
                if (Yii::$app->request->isAjax) {
                        $patient = $_POST['patient'];
                        $services = \common\models\Service::find()->where(['patient_id' => $patient])->all();
                        $options .= "<option value='0'>All</option>";
                        foreach ($services as $services) {
                                $options .= "<option value='" . $services->id . "'>" . $services->service_id . "</option>";
                        }
                        echo $options;
                }
        }

      public function actionReferenceno() {
                if (Yii::$app->request->isAjax) {
                        $reference_no = $_POST['reference_no'];
                        $exists = \common\models\Invoice::find()->where(['reference_no' => $reference_no])->exists();
                        if ($exists == 1) {
                                echo '1';
                        } else {
                                echo '0';
                        }
                }
        }

      public function actionListStaffs() {
                if (Yii::$app->request->isAjax) {
                        $branch = $_POST['branch'];
                        $staffs = StaffInfo::find()->where(['branch_id' => $branch, 'status' => 1])->andWhere(['<>', 'post_id', '1'])->orderBy(['staff_name' => SORT_ASC])->all();
                        $options = '<option value="">-Select-</option>';
                        foreach ($staffs as $staffs) {
                                $options .= "<option value='" . $staffs->id . "'>" . $staffs->staff_name . "</option>";
                        }
                        echo $options;
                }
        }



}
