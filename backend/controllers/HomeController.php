<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\db\Expression;
use common\models\StaffLeave;
use common\models\Followups;

class HomeController extends \yii\web\Controller {

        public $layout = 'staff';

        public function actionIndex() {
                $notification = \common\models\NotificationViewStatus::find()->where(['staff_id_' => Yii::$app->user->identity->id, 'view_status' => 0])->orderBy(['id' => SORT_DESC])->all();
                foreach ($notification as $value) {
                        $value->view_status = 1;
                        $value->save();
                }
                $searchModel = new \common\models\NotificationViewStatusSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['staff_id_' => Yii::$app->user->identity->id, 'view_status' => 0]);
                $dataProvider->pagination->pageSize = 10;
                return $this->render('notification', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionSchedules() {
                $searchModel = new \common\models\ServiceScheduleSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['staff' => Yii::$app->user->identity->id, 'status' => 1]);
            //    $dataProvider->query->orderBy(['date' => SORT_DESC]);
                $dataProvider->pagination->pageSize = 10;
                return $this->render('schedules', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionLeave() {
                $model = new StaffLeave();
                if ($model->load(Yii::$app->request->post())) {
                        $model->branch_id = \Yii::$app->user->identity->branch_id;
                        $model->employee_id = \Yii::$app->user->identity->id;
                        $model->commencing_date = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffLeave']['commencing_date']));
                        $model->ending_date = date('Y-m-d', strtotime(Yii::$app->request->post()['StaffLeave']['ending_date']));
                        $model->no_of_days = (date("j", strtotime($model->ending_date)) - date("j", strtotime($model->commencing_date))) + 1;
                        $model->status = 1;
                        $model->DOC = date('Y-m-d');
                        $model->save();
                        return $this->redirect(Yii::$app->request->referrer);
                }
                return $this->render('leave', [
                            'model' => $model,
                ]);
        }

        public function actionViewLeave() {
                $user_id = \Yii::$app->user->identity->id;
                $model = StaffLeave::find()->orderBy(['id' => SORT_DESC])->where(['employee_id' => $user_id])->all();
                return $this->render('view-leave', [
                            'model' => $model,
                ]);
        }

        public function actionProfile() {
                $model = \common\models\StaffInfo::findOne(Yii::$app->user->identity->id);
                return $this->render('profile', [
                            'model' => $model,
                ]);
        }

        public function actionTasks() {
                $searchModel = new \common\models\FollowupsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['assigned_to' => Yii::$app->user->identity->id, 'status' => 0]);
                $dataProvider->pagination->pageSize = 10;
                return $this->render('tasks', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionLogout() {
                Yii::$app->SetValues->LogOut(1, Yii::$app->user->identity->id);
                Yii::$app->user->logout();

                return $this->goHome();
        }

}
