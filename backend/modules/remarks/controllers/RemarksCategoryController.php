<?php

namespace backend\modules\remarks\controllers;

use Yii;
use common\models\RemarksCategory;
use common\models\RemarksCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RemarksCategoryController implements the CRUD actions for RemarksCategory model.
 */
class RemarksCategoryController extends Controller {


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
         * Lists all RemarksCategory models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new RemarksCategorySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $model = new RemarksCategory();

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        return $this->redirect(['index']);
                }

                return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
                            'model' => $model,
		]);
        }

        /**
         * Displays a single RemarksCategory model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new RemarksCategory model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new RemarksCategory();

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        return $this->redirect(['index']);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing RemarksCategory model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);
                $searchModel = new RemarksCategorySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        return $this->redirect(['index']);
                } else {
                        return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
                            'model' => $model,
		]);
                }
        }

        /**
         * Deletes an existing RemarksCategory model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the RemarksCategory model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return RemarksCategory the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = RemarksCategory::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
