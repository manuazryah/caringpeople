<?php

namespace backend\modules\masters\controllers;

use Yii;
use common\models\BusinessPartner;
use common\models\BusinessPartnerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BusinessPartnerController implements the CRUD actions for BusinessPartner model.
 */
class BusinessPartnerController extends Controller {


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
         * Displays a single BusinessPartner model.
         * @param integer $id
         * @return mixed
         */
        public function actionIndex($id = NULL) {
                $type = 0;
                if (!empty($id)) {
                        $model = $this->findModel($id);
                } else {
                        $model = new BusinessPartner();
                }
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate()) {
                        if ($model->save()) {
                                if (!empty($id)) {
                                        Yii::$app->getSession()->setFlash('success', 'Business Partner updated Successfully');
                                } else {
                                        $this->UpdateSrialNumber($model);
                                        Yii::$app->getSession()->setFlash('success', 'Business Partner created Successfully');
                                }
                                return $this->redirect(['index', 'type' => $model->type]);
                        }
                }
                $searchModel = new BusinessPartnerSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['type' => $type]);
                $dataProvider->pagination->pageSize = 4;

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'model' => $model,
                            'type' => $type,
                ]);
        }

        /**
         * Creates a new BusinessPartner model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new BusinessPartner();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing BusinessPartner model.
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
         * Deletes an existing BusinessPartner model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the BusinessPartner model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return BusinessPartner the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = BusinessPartner::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function generatePartner($prefix, $sequence_no) {
                $business_partner_code = $prefix . '-' . $sequence_no;
                $file_exist = \common\models\BusinessPartner::find()->where(['business_partner_code' => $business_partner_code])->one();
                if (!empty($file_exist)) {
                        return $this->generatePartner($prefix, $sequence_no + 1);
                } else {
                        return $business_partner_code;
                }
        }

}
