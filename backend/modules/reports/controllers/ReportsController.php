<?php

namespace backend\modules\reports\controllers;

use Yii;
use common\models\Attendance;
use common\models\AttendanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\StaffInfo;
use common\models\AttendanceEntry;
use yii\helpers\ArrayHelper;
use common\models\ServiceSchedule;
use yii\db\Expression;
use yii\data\ActiveDataProvider;
use kartik\mpdf\Pdf;

/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class ReportsController extends Controller {

                public function beforeAction($action) {
                if (!parent::beforeAction($action)) {
                        return false;
                }
                if (Yii::$app->user->isGuest) {
                        $this->redirect(['/site/index']);
                        return false;
                }
                return true;
        }

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ];
        }

        /**
         * Lists all Attendance models.
         * @return mixed
         */
        public function actionIndex() {

                // die('dd');

                $model = new Attendance();
                $model->date = date('d-M-Y');
                $employees = '';


                if (isset($_POST['Attendance'])) {
                        $model->load(Yii::$app->request->post());

                        /*
                         * To check attenadsnce is entere or not
                         */
                        $attendance = $this->selectUsers($model);
                        if (empty($attendance)) {
                                $employees = StaffInfo::find()->where(['branch_id' => $model->branch_id])->orWhere(['branch_id' => '0'])->andWhere(['<>', 'post_id', 5])->andWhere(['<>', 'post_id', 1])->all();
                                return $this->render('create', ['model' => $model, 'employees' => $employees]);
                        } else {
                                Yii::$app->session['attendance'] = $attendance;
                                $employees = AttendanceEntry::find()->where(['attendance_id' => $attendance->id])->all();
                                return $this->render('update', ['model' => $model, 'employees' => $employees]);
                        }
                }

                /*
                 * add attendance
                 */
                if (isset($_POST['submit_attendance'])) {
                        $this->addAttendance($_POST);
                }

                /*
                 * update attendance
                 */

                if (isset($_POST['update_attendance'])) {
                        $this->updateAttendance($_POST);
                }


                if (!isset($_POST['Attendance'])) {
                        return $this->render('create', [
                                    'model' => $model, 'employees' => $employees
                        ]);
                }
        }

        /*
         * To check attenadsnce is entered or not
         */

        public function selectUsers($model) {
                $date = date('Y-m-d', strtotime($model->date));
                $barnch = $model->branch_id;
                Yii::$app->session['attendance'] = $model;
                $attendance = Attendance::find()->where(['date' => $date, 'branch_id' => $barnch])->one();
                return $attendance;
        }

        /*
         * Insert each staff entry into database
         */

        public function addAttendance($model) {
                if (isset(Yii::$app->session['attendance'])) {

                        $date = date('Y-m-d', strtotime(Yii::$app->session['attendance']->date));
                        $employees = StaffInfo::find()->where(['branch_id' => Yii::$app->session['attendance']->branch_id])->orWhere(['branch_id' => '0'])->andWhere(['<>', 'post_id', 5])->andWhere(['<>', 'post_id', 1])->all();
                        $attendance = new Attendance;
                        $attendance->date = $date;
                        $attendance->branch_id = Yii::$app->session['attendance']->branch_id;
                        Yii::$app->SetValues->Attributes($attendance);
                        $transaction = Yii::$app->db->beginTransaction();
                        try {
                                $attendance->save(FALSE);
                                foreach ($employees as $employee) {
                                        $attendance_entry = new AttendanceEntry;
                                        $attendance_entry->attendance_id = $attendance->id;
                                        $attendance_entry->staff_id = $employee->id;
                                        $attendance_entry->total_hours = $model['total_' . $employee->id];
                                        $attendance_entry->over_time = $model['over_time_' . $employee->id];
                                        $attendance_entry->attendance = $model['attendance_' . $employee->id];
                                        $attendance_entry->save(FALSE);
                                }

                                $transaction->commit();

                                Yii::$app->getSession()->setFlash('success', 'Attendence for ' . $date . ' has been successfully added');
                        } catch (Exception $e) {
                                $transaction->rollBack();
                                Yii::$app->getSession()->setFlash('error', "<strong>Technical error! </strong>{$e->getMessage()}");
                        }
                } else {
                        Yii::$app->getSession()->setFlash('error', "<strong>Technical error! </strong> Please try again...!!!");
                }
        }

        /*
         * Update each staff entry into database
         */

        public function updateAttendance($model) {

                if (isset(Yii::$app->session['attendance'])) {
                        $attendence = AttendanceEntry::find()->where(['attendance_id' => Yii::$app->session['attendance']->id])->all();

                        $transaction = Yii::$app->db->beginTransaction();
                        try {
                                foreach ($attendence as $attendences) {
                                        $attendance_entry = AttendanceEntry::findOne($attendences->id);
                                        $attendance_entry->total_hours = $model['total_' . $attendences->id];
                                        $attendance_entry->over_time = $model['over_time_' . $attendences->id];
                                        $attendance_entry->attendance = $model['attendance_' . $attendences->id];
                                        $attendance_entry->save(FALSE);
                                        Yii::$app->getSession()->setFlash('success', 'Updated successfully');
                                }

                                $transaction->commit();
                        } catch (Exception $e) {
                                $transaction->rollBack();
                                Yii::$app->getSession()->setFlash('error', "<strong>Technical error! </strong>{$e->getMessage()}");
                        }
                } else {
                        Yii::app()->user->setFlash('danger', "<strong>Technical error! </strong> Please try again...!!!");
                }
        }

        /*
         * Attendance Report
         */

        public function actionReport() {

                $model = new Attendance();
                $model->scenario = 'report';
                $report = '';
                $branch = '';

                if ($model->load(Yii::$app->request->post())) {
                        $from = date('Y-m-d', strtotime($model->date));
                        $to = date('Y-m-d', strtotime($model->DOC));
                        $branch = $model->branch_id;
                        $report = Attendance::find()->where(['branch_id' => $branch])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->all();
                }
                return $this->render('report', [
                            'model' => $model, 'report' => $report, 'selected_branch' => $branch
                ]);
        }

        /*
         * Staff Attendance Report
         */

        public function actionStaffattendance() {
        $model = new ServiceSchedule();
        $model->scenario = 'staffreport';
        $searchModel= '';
        $dataProvider= '';
        $total_attendance = '';
        $total_amount = '';

        if ($model->load(Yii::$app->request->get())) {
            $from = date('Y-m-d', strtotime($model->date));
            $to = date('Y-m-d', strtotime($model->DOC));
            $staff = $model->staff;

            $searchModel = new \common\models\ServiceScheduleSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>', 'status', 4])->andWhere(['staff' => $staff])->orderBy(['date' => SORT_ASC]);


            //   $report = ServiceSchedule::find()->where(['staff' => $staff])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>', 'status', 4])->orderBy(['date' => SORT_ASC])->all();
            $total_attendance = ServiceSchedule::find()->where(['staff' => $staff, 'status' => 2])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->count();
            $total_amount = ServiceSchedule::find()->where(['staff' => $staff])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->sum('rate');
        }


        return $this->render('staff_report', [
                    'model' => $model,
                    'report' => $report,
                    'total_attendance' => $total_attendance,
                    'total_amount' => $total_amount,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
        /*
         * Patient wise Report
         */

        public function actionPatientreport() {
                $model = new ServiceSchedule();
                $model->scenario = 'patientreport';
                $report = '';

                if ($model->load(Yii::$app->request->post())) {
                        $from = date('Y-m-d', strtotime($model->date));
                        $to = date('Y-m-d', strtotime($model->DOC));
                        if (isset($model->service_id)) {
                                if ($model->service_id != 0) {
                                        $report = ServiceSchedule::find()->where(['patient_id' => $model->patient_id, 'service_id' => $model->service_id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>', 'status', 4])->orderBy(['date' => SORT_ASC])->all();
                                        $patient_services = ServiceSchedule::find()->select('service_id')->distinct()->where(['patient_id' => $model->patient_id, 'service_id' => $model->service_id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>', 'status', 4])->all();
                                } else {
                                        $report = ServiceSchedule::find()->where(['patient_id' => $model->patient_id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>', 'status', 4])->orderBy(['date' => SORT_ASC])->all();
                                        $patient_services = ServiceSchedule::find()->select('service_id')->distinct()->where(['patient_id' => $model->patient_id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>', 'status', 4])->all();
                                }
                        }
                }


                return $this->render('patient_report', [
                            'model' => $model,
                            'report' => $report,
                            'patient_services' => $patient_services,
                ]);
        }

        /*
         * Service-wise report
         */

        public function actionServicereport() {
                $model = new ServiceSchedule();
                $model->scenario = 'servicereport';
                $report = '';

                if ($model->load(Yii::$app->request->post())) {
                        if (isset($model->service_id)) {
                                if ($model->service_id != 0) {
                                        $report = ServiceSchedule::find()->where(['patient_id' => $model->patient_id, 'service_id' => $model->service_id])->orderBy(['date' => SORT_ASC])->all();
                                        $patient_services = ServiceSchedule::find()->select('service_id')->distinct()->where(['patient_id' => $model->patient_id, 'service_id' => $model->service_id])->all();
                                } else {
                                        $report = ServiceSchedule::find()->where(['patient_id' => $model->patient_id])->all();
                                        $patient_services = ServiceSchedule::find()->select('service_id')->distinct()->where(['patient_id' => $model->patient_id])->all();
                                }
                        }
                }


                return $this->render('service_report', [
                            'model' => $model,
                            'report' => $report,
                            'patient_services' => $patient_services,
                ]);
        }

        /*
         * on call staff report by destination wise
         */

        public function actionOncallstaff() {
                $model = new ServiceSchedule();
                $model->scenario = 'oncallstaffreport';
                $designations = '';

                if ($model->load(Yii::$app->request->post())) {
                        $from = date('Y-m-d', strtotime($model->date));
                        $to = date('Y-m-d', strtotime($model->DOC));
                        $branch = $model->rating;

                        $designations = \common\models\MasterDesignations::find()->all();
                }
                return $this->render('oncallstaff_report', [
                            'model' => $model,
                            'designations' => $designations,
                            'from' => $from,
                            'to' => $to,
                            'branch' => $branch
                ]);
        }

        public function actionStaffprint($from, $to, $branch) {
                $model = new ServiceSchedule();
                $designations = \common\models\MasterDesignations::find()->all();
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                    'content' => $this->renderPartial('oncallstaff_report_print', [
                        'model' => $model,
                        'designations' => $designations,
                        'from' => $from,
                        'to' => $to,
                        'branch' => $branch
                    ]),
                    'cssInline' => 'td {padding-bottom: 1em;} ',
                ]);
                return $pdf->render();
        }

        

        public function actionViewdetails($from = null, $to = null, $type = null, $branch_id = null) {

                $from = date('Y-m-d', strtotime($from));
                $to = date('Y-m-d', strtotime($to));
                if ($type == 0) {
                        $staffs = StaffInfo::find()->where(['status' => 1])->andWhere(new Expression('FIND_IN_SET(:designation, designation)'))->addParams([':designation' => 1])->orWhere(new Expression('FIND_IN_SET(:designations, designation)'))->addParams([':designations' => 2])->andWhere(['branch_id' => $branch_id])->all();
                } else {
                        $staffs = StaffInfo::find()->where(['status' => 1])->andWhere(new Expression('FIND_IN_SET(:designation, designation)'))->addParams([':designation' => $type])->andWhere(['branch_id' => $branch_id])->all();
                }
                $staff_lists = array();
                foreach ($staffs as $value) {
                        $staff_schedules = \common\models\ServiceSchedule::find()->where(['staff' => $value->id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->all();
                        $amount = 0;
                        foreach ($staff_schedules as $staff_schedules) {
                                $amount += $staff_schedules->rate;
                        }
                        if ($amount > 0) {
                                $staff_lists[] = $value->id;
                        }
                }
                $searchModel = new \common\models\StaffInfoSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['IN', 'staff_info.id', $staff_lists]);


                $dataProvider->query->orderBy(['staff_name' => SORT_ASC]);
                $dataProvider->pagination = FALSE;

                return $this->render('view_details', [
                            'from' => $from,
                            'to' => $to,
                            'type' => $type,
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

         /*
         * Staff Detailed Report in the particular range
         */

        public function actionStaffdetails($from = null, $to = null, $staff = null) {
                $schedules = ServiceSchedule::find()->where(['staff' => $staff])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->all();
                $staff_amount = ServiceSchedule::find()->where(['staff' => $staff])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['>', 'rate', 0])->sum('rate');

                return $this->render('staff_details', [
                            'staff' => $staff,
                            'staff_amount' => $staff_amount,
                            'from' => $from,
                            'to' => $to,
                ]);
        }

        public function actionStaffdetailsprint($from, $to, $staff) {
                $staff_amount = ServiceSchedule::find()->where(['staff' => $staff])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['>', 'rate', 0])->sum('rate');

                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                    'content' => $this->renderPartial('staff_details_print', [
                        'staff' => $staff,
                        'staff_amount' => $staff_amount,
                        'from' => $from,
                        'to' => $to,
                        'type' => '1',
                    ]),
                    'cssInline' => 'td {padding-bottom: 1em;}} ',
                ]);
                return $pdf->render();
        }

        

       public function actionReportPatient() {
                $model = new ServiceSchedule();
                $model->scenario = 'oncallstaffreport';
                $searchModel = '';
                $dataProvider = '';

                if ($model->load(Yii::$app->request->get())) {
                        $searchModel = new \common\models\PatientGeneralSearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                        $dataProvider->query->andWhere(['status' => 1, 'branch_id' => $model->rating]);

                        $patients = \common\models\PatientGeneral::find()->where(['status' => 1, 'branch_id' => $model->rating])->all();
                        $patient_lists = array();
                        foreach ($patients as $patients) {
                                $services = ServiceSchedule::find()->where(['patient_id' => $patients->id])->andWhere(['>=', 'date', date('Y-m-d', strtotime($model->date))])->andWhere(['<=', 'date', date('Y-m-d', strtotime($model->DOC))])->groupBy(['service_id'])->all();
                                $due_amount = 0;
                                foreach ($services as $value) {
                                        $service_detail = \common\models\Service::findOne($value->service_id);
                                        $due_amount += $service_detail->due_amount;
                                }
                                if ($due_amount > 0) {
                                        $patient_lists[] = $patients->id;
                                }
                        }
                        $dataProvider->query->andWhere(['IN', 'patient_general.id', $patient_lists]);
                        $dataProvider->query->orderBy(['first_name' => SORT_ASC]);
                        $dataProvider->pagination = FALSE;
                }


                return $this->render('reportpatient', [
                            'model' => $model,
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }
         public function actionServicedetails($from = null, $to = null, $patient = null) {
                $services = ServiceSchedule::find()->where(['patient_id' => $patient])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->groupBy(['service_id'])->all();
                $searchModel = new \common\models\ServiceScheduleSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['>', 'rate', 0])->andWhere(['patient_id' => $patient])->orderBy(['date' => SORT_ASC]);
                $dataProvider->pagination = FALSE;

                return $this->render('service-details', [
                            'from' => $from,
                            'to' => $to,
                            'patient_id' => $patient,
                            'services' => $services,
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }
}
