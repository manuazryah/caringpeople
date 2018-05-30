<?php

namespace backend\modules\attendance\controllers;

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

/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class AttendanceController extends Controller {

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
                $report = '';
                $total_attendance = '';
                $total_amount = '';

                if ($model->load(Yii::$app->request->post())) {
                        $from = date('Y-m-d', strtotime($model->date));
                        $to = date('Y-m-d', strtotime($model->DOC));
                        $staff = $model->staff;
                         $report = ServiceSchedule::find()->where(['staff' => $staff])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>','status',4])->orderBy(['date' => SORT_ASC])->all();
                        $total_attendance = ServiceSchedule::find()->where(['staff' => $staff, 'status' => 2])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->count();
                        $total_amount = ServiceSchedule::find()->where(['staff' => $staff])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->sum('rate');
                }


                return $this->render('staff_report', [
                            'model' => $model,
                            'report' => $report,
                            'total_attendance' => $total_attendance,
                            'total_amount' => $total_amount
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
                                        $report = ServiceSchedule::find()->where(['patient_id' => $model->patient_id, 'service_id' => $model->service_id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>','status',4])->orderBy(['date' => SORT_ASC])->all();
                                        $patient_services = ServiceSchedule::find()->select('service_id')->distinct()->where(['patient_id' => $model->patient_id, 'service_id' => $model->service_id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>','status',4])->all();
                                } else {
                                        $report = ServiceSchedule::find()->where(['patient_id' => $model->patient_id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>','status',4])->orderBy(['date' => SORT_ASC])->all();
                                        $patient_services = ServiceSchedule::find()->select('service_id')->distinct()->where(['patient_id' => $model->patient_id])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['<>','status',4])->all();
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
                        $designations = \common\models\MasterDesignations::find()->all();
                }
                return $this->render('oncallstaff_report', [
                            'model' => $model,
                            'designations' => $designations,
                ]);
        }

        public function actionViewdetails($from = null, $to = null, $type = null, $branch_id = null) {
                $from = date('Y-m-d', strtotime($from));
                $to = date('Y-m-d', strtotime($to));
                 $staffs = StaffInfo::find()->where(['branch_id' => $branch_id])->andWhere(new Expression('FIND_IN_SET(:designation, designation)'))->addParams([':designation' => $type])->all();

                return $this->render('view_details', [
                            'from' => $from,
                            'to' => $to,
                            'type' => $type,
                            'staffs' => $staffs
                ]);
        }

        public function actionStaffdetails($from = null, $to = null, $staff = null) {
                 $schedules = ServiceSchedule::find()->where(['staff' => $staff])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['>', 'rate', 0])->orderBy(['date' => SORT_ASC])->all();
                $staff_amount = ServiceSchedule::find()->where(['staff' => $staff])->andWhere(['>=', 'date', $from])->andWhere(['<=', 'date', $to])->andWhere(['>', 'rate', 0])->sum('rate');
                return $this->render('staff_details', [
                            'schedules' => $schedules,
                            'staff' => $staff,
                            'staff_amount' => $staff_amount,
                            'from' => $from,
                            'to' => $to,
                ]);
        }


        /**
         * Displays a single Attendance model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Attendance model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {


                $model = new Attendance();


                if ($model->load(Yii::$app->request->post())) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing Attendance model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing Attendance model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the Attendance model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Attendance the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Attendance::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.









                ');
                }
        }

}
