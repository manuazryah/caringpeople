<?php

namespace backend\modules\services\controllers;

use Yii;
use common\models\ServiceBin;
use common\models\ServiceBinSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceBinController implements the CRUD actions for ServiceBin model.
 */
class ServiceBinController extends Controller {

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
         * Lists all ServiceBin models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new ServiceBinSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single ServiceBin model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new ServiceBin model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new ServiceBin();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing ServiceBin model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);
                $service_schedule = \common\models\ServiceScheduleBin::find()->where(['service_id' => $id])->orderBy([new \yii\db\Expression('FIELD (status, 1,3,4,2)'), 'date' => SORT_ASC])->all();
                $service_expenses = \common\models\ServiceExpensesBin::find()->where(['service_id' => $id])->all();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                }
                return $this->render('create', [
                            'model' => $model,
                            'service_schedule' => $service_schedule,
                            'discounts' => $discounts,
                            'service_expenses' => $service_expenses,
                ]);
        }

        public function actionRestore($id) {
                $service_bin = $this->findModel($id);
                $service = new \common\models\Service;
                $service_bin_schedules = \common\models\ServiceScheduleBin::find()->where(['service_id' => $id])->all();
                $service_discounts_bin = \common\models\ServiceDiscountsBin::find()->where(['service_id' => $id])->all();
                $service_expenses_bin = \common\models\ServiceExpensesBin::find()->where(['service_id' => $id])->all();


                $transaction = \common\models\Service::getDb()->beginTransaction();
                try {
                        $service->attributes = $service_bin->attributes;
                        $service->id = $service_bin->service_table_id;
                        $service->service_id = $service_bin->service_id;
                        $service->save();
                        $service_bin->delete(FALSE);

                        if (!empty($service_bin_schedules)) {
                                foreach ($service_bin_schedules as $value) {
                                        $service_schedule = new \common\models\ServiceSchedule;
                                        $service_schedule->attributes = $value->attributes;
                                        $service_schedule->service_id = $service->id;
                                        $this->StaffStatus($value->staff, $service->id);
                                        if ($service_schedule->save())
                                                $value->delete(FALSE);
                                }
                        }

                        if (!empty($service_discounts_bin)) {
                                foreach ($service_discounts_bin as $discounts) {
                                        $service_discounts = new \common\models\ServiceDiscounts;
                                        $service_discounts->attributes = $discounts->attributes;
                                        $service_discounts->service_id = $service->id;
                                        if ($service_discounts->save())
                                                $discounts->delete(FALSE);
                                }
                        }


                        if (!empty($service_expenses_bin)) {
                                foreach ($service_expenses_bin as $expenses) {
                                        $service_expenses = new \common\models\ServiceExpenses;
                                        $service_expenses->attributes = $expenses->attributes;
                                        $service_expenses->service_id = $service->id;
                                        if ($service_expenses->save())
                                                $expenses->delete(FALSE);
                                }
                        }
                        $transaction->commit();
                        Yii::$app->getSession()->setFlash('success', 'Restored succuessfully');
                } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                }

                return $this->redirect(['index']);
        }

        public function StaffStatus($id, $service_id) {

                $staff_status_update = \common\models\StaffInfo::findOne($id);

                if (!empty($staff_status_update)) {
                        $staff_status_update->working_status = 1;
                        $staff_status_update->update();
                }
        }

        /**
         * Deletes an existing ServiceBin model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {

                $service = $this->findModel($id);
                $service_schedules = \common\models\ServiceScheduleBin::findAll(['service_id' => $id]);
                $service_discounts = \common\models\ServiceDiscountsBin::findAll(['service_id' => $id]);
                $transaction = ServiceBin::getDb()->beginTransaction();
                try {
                        if (!empty($service_schedules)) {
                                foreach ($service_schedules as $value) {
                                        $value->delete();
                                }
                        }
                        if (!empty($service_discounts)) {
                                foreach ($service_discounts as $value1) {
                                        $value1->delete();
                                }
                        }

                        if (!empty($service_schedule_history)) {
                                foreach ($service_schedule_history as $value2) {
                                        $value2->delete();
                                }
                        }
                        $service->delete();

                        // ...other DB operations...
                        $transaction->commit();
                } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                }
                Yii::$app->getSession()->setFlash('success', 'Deleted succuessfully');
                return $this->redirect(['index']);
        }

        /**
         * Finds the ServiceBin model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return ServiceBin the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = ServiceBin::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
