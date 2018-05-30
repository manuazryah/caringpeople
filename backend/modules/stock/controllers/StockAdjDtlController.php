<?php

namespace backend\modules\stock\controllers;

use Yii;
use common\models\StockAdjDtl;
use common\models\StockAdjDtlSearch;
use common\models\StockAdjMst;
use common\models\StockAdjMstSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\StockRegister;
use common\models\StockView;

/**
 * StockAdjDtlController implements the CRUD actions for StockAdjDtl model.
 */
class StockAdjDtlController extends Controller {

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
         * Lists all StockAdjDtl models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new StockAdjMstSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionAdd() {
                $model = new StockAdjDtl();
                $model_stock_master = new StockAdjMst();
                if ($model_stock_master->load(Yii::$app->request->post())) {
                        $data = Yii::$app->request->post();
                        if (isset($_POST['save-approve'])) {
                                $flag = 1;
                        } else {
                                $flag = 0;
                        }
                        $model_stock_master = $this->SaveStockMaster($model_stock_master, $data, $flag);
                        $arr = $this->SaveStockDetails($model_stock_master, $data, $flag);
                        $transaction = Yii::$app->db->beginTransaction();

                        try {
                                if ($model_stock_master->save() && $this->AddStockDetails($arr, $model_stock_master, $flag)) {
                                        $transaction->commit();
                                } else {
                                        $transaction->rollBack();
                                }
                        } catch (Exception $e) {
                                $transaction->rollBack();
                        }
                        Yii::$app->getSession()->setFlash('success', 'Stock adjustment done successfully');
                        return $this->redirect(Yii::$app->request->referrer);
                }
                return $this->render('add', [
                            'model' => $model,
                            'model_stock_master' => $model_stock_master,
                ]);
        }

        public function SaveStockMaster($model_stock_master, $data, $flag) {
                $model_stock_master->document_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $model_stock_master->document_date)));
                if ($flag == 1) {
                        $model_stock_master->status = 1;
                } else {
                        $model_stock_master->status = 0;
                }
                Yii::$app->SetValues->Attributes($model_stock_master);
                return $model_stock_master;
        }

        public function SaveStockDetails($model_stock_master, $data, $flag) {
                $arr = [];
                $i = 0;
                foreach ($data['StockAdjDtlItemId'] as $val) {
                        $arr[$i]['StockAdjDtlItemId'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($data['StockAdjDtlQty'] as $val) {
                        $arr[$i]['StockAdjDtlQty'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($data['StockAdjDtlItenCost'] as $val) {
                        $arr[$i]['StockAdjDtlItenCost'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($data['StockAdjDtlTotal'] as $val) {
                        $arr[$i]['StockAdjDtlTotal'] = $val;
                        $i++;
                }
                return $arr;
        }

        public function AddStockDetails($arr, $model_stock_master, $flag) {
                $flagg = 0;
                $j = 0;
                foreach ($arr as $val) {
                        $j++;
                        $aditional = new StockAdjDtl();
                        $item_datas = \common\models\ItemMaster::find()->where(['id' => $val['StockAdjDtlItemId']])->one();
                        if (!empty($item_datas)) {
                                $aditional->StockAdjMstId = $model_stock_master->id;
                                $aditional->transaction = $model_stock_master->transaction;
                                $aditional->document_no = $model_stock_master->document_no;
                                $aditional->document_date = $model_stock_master->document_date;
                                $aditional->item_id = $item_datas->id;
                                $aditional->item_code = $item_datas->SKU;
                                $aditional->item_name = $item_datas->item_name;
                                $aditional->item_cost = $val['StockAdjDtlItenCost'];
                                $aditional->qty = $val['StockAdjDtlQty'];
                                $aditional->total_cost = $val['StockAdjDtlTotal'];
                                if ($flag == 1) {
                                        $aditional->status = 1;
                                } else {
                                        $aditional->status = 0;
                                }
                                $aditional->CB = Yii::$app->user->identity->id;
                                $aditional->UB = Yii::$app->user->identity->id;
                                $aditional->DOC = date('Y-m-d');
                                if ($aditional->save()) {
                                        if ($flag == 1) {
                                                if ($this->AddStockRegister($aditional, $j)) {
                                                        $flagg = 1;
//                            if ($this->SaveGld($model_stock_master)) {
//                                $flagg = 1;
//                            } else {
//                                $flagg = 0;
//                            }
                                                } else {
                                                        $flagg = 0;
                                                }
                                        } else {
                                                $flagg = 1;
                                        }
                                }
                        }
                }
                if ($flagg == 1) {
                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        public function AddStockRegister($aditional, $j) {
                $flag = 0;
                $stock = new StockRegister();
                if ($aditional->transaction == 0) {
                        $transaction = 6;
                } elseif ($aditional->transaction == 1) {
                        $transaction = 4;
                } elseif ($aditional->transaction == 2) {
                        $transaction = 5;
                }
                $stock->transaction = $transaction;
                $stock->document_line_id = $j;
                $stock->document_no = $aditional->document_no;
                $stock->document_date = $aditional->document_date;
                $stock->item_id = $aditional->item_id;
                $stock->item_code = $aditional->item_code;
                $stock->item_name = $aditional->item_name;
                $stock->location_code = 'HOFF';
                $stock->item_cost = $aditional->item_cost;
                if ($aditional->transaction == 2) {
                        $stock->qty_out = $aditional->qty;
                        $stock->balance_qty = 0;
                } else {
                        $stock->qty_in = $aditional->qty;
                        $stock->balance_qty = $aditional->qty;
                }
                $stock->total_cost = $aditional->total_cost;
                $stock->status = 1;
                $stock->CB = Yii::$app->user->identity->id;
                $stock->UB = Yii::$app->user->identity->id;
                $stock->DOC = date('Y-m-d');
                if ($stock->save()) {
                        if ($stock->transaction == 5) {
                                Yii::$app->SetValues->StockDeduction($stock->item_id, $stock->qty_out);
                        }
                        if ($this->AddStockView($aditional, $stock)) {
                                $flag = 1;
                        } else {
                                $flag = 0;
                        }
                } else {
                        $flag = 0;
                }
                if ($flag == 1) {
                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        public function AddStockView($aditional, $stock) {
                $stock_view_exist = StockView::find()->where(['item_id' => $stock->item_id])->one();
                if (empty($stock_view_exist)) {
                        $stock_view = new StockView();
                        $stock_view->item_id = $stock->item_id;
                        $stock_view->item_code = $stock->item_code;
                        $stock_view->item_name = $stock->item_name;
                        if ($aditional->transaction == 2) {
                                $stock_view->available_qty = $stock->qty_out;
                        } else {
                                $stock_view->available_qty = $stock->qty_in;
                        }
                        $stock_view->status = 1;
                        $stock_view->CB = Yii::$app->user->identity->id;
                        $stock_view->UB = Yii::$app->user->identity->id;
                        $stock_view->DOC = date('Y-m-d');
                } else {
                        $stock_view = StockView::find()->where(['item_id' => $stock->item_id])->one();
                        if ($aditional->transaction == 2) {
                                $stock_view->available_qty -= $stock->qty_out;
                        } else {
                                $stock_view->available_qty += $stock->qty_in;
                        }
                }
                $item_master = \common\models\ItemMaster::findOne(['id' => $stock->item_id]);
                $stock_view->retail_price = $item_master->retail_price;
                $stock_view->average_cost = Yii::$app->SetValues->CalculateAvg($stock->item_id);
                if ($stock_view->save()) {
                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        public function actionApprove($id) {
                $model = StockAdjMst::findOne(['id' => $id]);
                $model_details = StockAdjDtl::findAll(['StockAdjMstId' => $id]);
                $k = 0;
                foreach ($model_details as $value) {
                        $k++;
                        $this->AddStockRegister($value, $k);
                        $value->status = 1;
                        $value->save();
                }
                $model->status = 1;
                $model->save();
                //    $this->SaveGld($model);
                return $this->redirect(Yii::$app->request->referrer);
        }

        public function generateDocumentNo($purchase_date, $voucher_type) {
                $year = date("Y", strtotime(str_replace('/', '-', $purchase_date)));
                $series = \common\models\VoucherSeries::find()->where(['voucher_type' => $voucher_type, 'financial_year' => $year])->one();
                if (empty($series)) {
                        $document_no = '';
                } else {
                        $digit = '%0' . $series->digits . 'd';
                        $document_no = $series->prefix . (sprintf($digit, $series->sequence_no));
                }
                $document_data = array('document-no' => $document_no, 'financial-year-id' => $series->financial_year_id, 'financial-year' => $series->financial_year);
                return $document_data;
        }

        public function GetFinancialYear($invoice_date) {
                $sale_date = date('Y-m-d', strtotime($invoice_date));
                $financial_datas = \common\models\FinancialYears::find()->all();
                foreach ($financial_datas as $value) {
                        $contractDateBegin = date('Y-m-d', strtotime($value->start_period));
                        $contractDateEnd = date('Y-m-d', strtotime($value->end_period));
                        if (($sale_date > $contractDateBegin) && ($sale_date < $contractDateEnd)) {
                                return $value;
                        }
                }
        }

        public function SaveGld($model) {
                $flag = 0;
                $gld_master = new \common\models\GldMst();
                $gld_master->journal_type = 1;
                $gld_master->voucher_type = 12;
                $data = $this->generateDocumentNo($model->document_date, 12);
                $gld_master->document_no = $data['document-no'];
                $gld_master->document_date = $model->document_date;
                $financial_year_data = $this->GetFinancialYear($model->document_date);
                $gld_master->financial_year = $financial_year_data->financial_year;
                $gld_master->financial_year_id = $financial_year_data->id;
                $tot_cost = 0;
                $model_details = StockAdjDtl::find()->where(['StockAdjMstId' => $model->id])->all();
                foreach ($model_details as $value) {
                        $item_data = \common\models\ItemMaster::findOne(['id' => $value->item_id]);
                        $tot_cost = $item_data->item_cost * $value->qty;
                }
                $gld_master->debit_amount = $tot_cost;
                $gld_master->credit_amount = $tot_cost;
                $gld_master->balance_amount = 0;
                $gld_master->status = 0;
                Yii::$app->SetValues->Attributes($gld_master);
                if ($gld_master->save()) {
                        if ($this->SaveGldDetails($model, $gld_master, $tot_cost)) {
                                $flag = 1;
                        } else {
                                $flag = 0;
                        }
                }
                if ($flag == 1) {
                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        public function SaveGldDetails($model_master, $gld_master, $tot_cost) {
                $flag = 0;
                $j = 0;
                $arr = array(Yii::$app->params['inventory_assets'], Yii::$app->params['cost_of_goods_sold']);
                foreach ($arr as $x) {
                        $j++;
                        $gld_details = new \common\models\GldDtl();
                        $gld_details->GLDMstID = $gld_master->id;
                        $gld_details->voucher_type = $gld_master->voucher_type;
                        $gld_details->document_no = $gld_master->document_no;
                        $gld_details->document_date = $gld_master->document_date;
                        $gld_details->pos = $j;
                        $gld_details->account_id = $x;
                        $chart_of_account = \common\models\ChartofAccounts::findOne(['id' => $x]);
                        $gld_details->account_number = $chart_of_account->account_number;
                        $gld_details->account_name = $chart_of_account->account_name;
                        $gld_details->description = '';
                        if ($x == Yii::$app->params['inventory_assets']) {
                                if ($model_master->transaction == 2) {
                                        $gld_details->credit_amount = $tot_cost;
                                } else {
                                        $gld_details->debit_amount = $tot_cost;
                                }
                        } elseif ($x == Yii::$app->params['cost_of_goods_sold']) {
                                if ($model_master->transaction == 2) {
                                        $gld_details->debit_amount = $tot_cost;
                                } else {
                                        $gld_details->credit_amount = $tot_cost;
                                }
                                $gld_details->credit_amount = $tot_cost;
                        }
                        $gld_details->status = 0;
                        $gld_details->CB = Yii::$app->user->identity->id;
                        $gld_details->UB = Yii::$app->user->identity->id;
                        $gld_details->DOC = date('Y-m-d');
                        if ($gld_details->save()) {
                                $flag = 1;
                        } else {
                                $flag = 0;
                        }
                }
                if ($flag == 1) {
                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        /**
         * Displays a single StockAdjDtl model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                $model = StockAdjMst::findOne(['id' => $id]);
                $stock_details = StockAdjDtl::find()->where(['StockAdjMstId' => $id])->all();
                return $this->render('view', [
                            'model' => $model,
                            'stock_details' => $stock_details,
                ]);
        }

        /**
         * Creates a new StockAdjDtl model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new StockAdjDtl();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing StockAdjDtl model.
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
         * Deletes an existing StockAdjDtl model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the StockAdjDtl model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return StockAdjDtl the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = StockAdjDtl::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionGetItems() {
                if (Yii::$app->request->isAjax) {
                        $item_id = $_POST['item_id'];
                        $next_row_id = $_POST['next_row_id'];
                        $transaction = $_POST['transaction'];
                        $next = $next_row_id + 1;
                        $items = \common\models\ItemMaster::find()->where(['status' => 1])->all();
                        if ($item_id == '') {
                                echo '0';
                                exit;
                        } else {
                                $item_datas = \common\models\ItemMaster::find()->where(['id' => $item_id])->one();
                                if (empty($item_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $in_stock = \common\models\StockView::find()->where(['item_id' => $item_datas->id])->one();
                                        if (empty($in_stock)) {
                                                $existing_stock = 0;
                                        } else {
                                                $existing_stock = $in_stock->available_qty;
                                        }
                                        if ($transaction == 2) {
                                                if ($existing_stock > 0) {
                                                        $flag = 0;
                                                } else {
                                                        $flag = 1;
                                                }
                                        } else {
                                                $flag = 0;
                                        }
                                        if ($flag == 0) {
                                                $next_row = $this->renderPartial('next_row', [
                                                    'next' => $next,
                                                    'items' => $items,
                                                ]);
                                                $arr_variable = array('next_row_html' => $next_row, 'next' => $next, 'item_rate' => $item_datas->retail_price, 'existing_stock' => $existing_stock);
                                                $data['result'] = $arr_variable;
                                                echo json_encode($data);
                                        } else {
                                                echo '1';
                                                exit;
                                        }
                                }
                        }
                }
        }

        public function actionAddAnotherRow() {
                if (Yii::$app->request->isAjax) {
                        $next_row_id = $_POST['next_row_id'];
                        $next = $next_row_id + 1;
                        $items = \common\models\ItemMaster::findAll(['status' => 1]);
                        $next_row = $this->renderPartial('next_row', [
                            'next' => $next,
                            'items' => $items,
                        ]);
                        $new_row = array('next_row_html' => $next_row);
                        $data['result'] = $new_row;
                        echo json_encode($data);
                }
        }

}
