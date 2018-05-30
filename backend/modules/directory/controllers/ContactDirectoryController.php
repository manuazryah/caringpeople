<?php

namespace backend\modules\directory\controllers;

use Yii;
use common\models\ContactDirectory;
use common\models\ContactDirectorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactDirectoryController implements the CRUD actions for ContactDirectory model.
 */
class ContactDirectoryController extends Controller {

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
         * Lists all ContactDirectory models.
         * @return mixed
         */
        public function actionIndex() {

                $check_exists = explode('?', Yii::$app->request->url);
                if (empty($check_exists[1]))
                        Yii::$app->session->remove('new_size');

                if (isset($_POST['size'])) {
                        $pagesize = $_POST['size'];
                        \Yii::$app->session->set('new_size', $pagesize);
                } else {
                        $pagesize = Yii::$app->session->get('new_size');
                }

                $searchModel = new ContactDirectorySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->pagination->pageSize = $pagesize;

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'pagesize' => $pagesize,
                ]);
        }

        /**
         * Displays a single ContactDirectory model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new ContactDirectory model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new ContactDirectory();

                if ($model->load(Yii::$app->request->post())) {
                        $model->notes_1_added = Yii::$app->user->identity->id;
                        $model->notes_2_added = Yii::$app->user->identity->id;
                        $model->notes_3_added = Yii::$app->user->identity->id;
                        $model->notes_1_time = date('Y-m-d H:i:s');
                        $model->notes_2_time = date('Y-m-d H:i:s');
                        $model->notes_3_time = date('Y-m-d H:i:s');
                        $model->save();
                        return $this->redirect(['index']);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing ContactDirectory model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);
                $notes1 = $model->notes_1;
                $notes2 = $model->notes_2;
                $notes3 = $model->notes_3;
                if ($model->load(Yii::$app->request->post())) {
                        if ($notes1 != $model->notes_1) {
                                $model->notes_1_added = Yii::$app->user->identity->id;
                                $model->notes_1_time = date('Y-m-d H:i:s');
                        }
                        if ($notes2 != $model->notes_2) {
                                $model->notes_2_added = Yii::$app->user->identity->id;
                                $model->notes_2_time = date('Y-m-d H:i:s');
                        }
                        if ($notes3 != $model->notes_3) {
                                $model->notes_3_added = Yii::$app->user->identity->id;
                                $model->notes_3_time = date('Y-m-d H:i:s');
                        }

                        $model->save();
                        return $this->redirect(['index']);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing ContactDirectory model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the ContactDirectory model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return ContactDirectory the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = ContactDirectory::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
