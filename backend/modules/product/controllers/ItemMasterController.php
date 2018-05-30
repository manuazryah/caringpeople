<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\ItemMaster;
use common\models\ItemMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemMasterController implements the CRUD actions for ItemMaster model.
 */
class ItemMasterController extends Controller {

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
         * Lists all ItemMaster models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new ItemMasterSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single ItemMaster model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new ItemMaster model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new ItemMaster();
                $model->setScenario('create');
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        Yii::$app->getSession()->setFlash('success', ' Item Added succuessfully');
                        $model = new ItemMaster();
                        return $this->redirect(['index']);
                }
                return $this->render('create', [
                            'model' => $model,
                ]);
        }

        /**
         * Updates an existing ItemMaster model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate()) {
                        if ($model->save()) {
                                $this->UpdateStockView($model);
                                $model = new ItemMaster();
                        }
                        return $this->redirect(['create']);
                }
                return $this->render('update', [
                            'model' => $model,
                ]);
        }

        public function UpdateStockView($model) {
                $stock_view = \common\models\StockView::findOne(['item_id' => $model->id]);
                if (!empty($stock_view)) {
                        $stock_view->retail_price = $model->retail_price;
                        $stock_view->save();
                }
                return;
        }

        /**
         * Deletes an existing ItemMaster model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $sales_details = \common\models\SalesInvoiceDetails::findAll(['item_id' => $id]);

                if (empty($sales_details)) {
                        $this->findModel($id)->delete();
                        Yii::$app->getSession()->setFlash('success', 'succuessfully deleted');
                } else {
                        Yii::$app->getSession()->setFlash('error', "Can't delete the Item");
                }

                return $this->redirect(['index']);
        }

        /**
         * Finds the ItemMaster model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return ItemMaster the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = ItemMaster::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionHsn() {

                if (Yii::$app->request->isAjax) {

                        $tax = $_POST['tax_id'];
                        $hsn_datas = \common\models\Hsn::find()->where(['tax' => $tax])->all();
                        $options = '<option value="">-Choose HSN-</option>';
                        foreach ($hsn_datas as $hsn_data) {
                                $options .= "<option value='" . $hsn_data->id . "'>" . $hsn_data->hsn_name . "</option>";
                        }

                        echo $options;
                }
        }

}
