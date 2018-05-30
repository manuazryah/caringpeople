<?php

namespace backend\modules\sales\controllers;

use Yii;
use common\models\PurchaseInvoiceDetails;
use common\models\PurchaseInvoiceDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PurchaseInvoiceMaster;
use common\models\PurchaseInvoiceMasterSearch;
use common\models\BusinessPartner;
use common\models\SalesInvoiceTemp;
use common\models\PaymentDtl;
use common\models\PaymentMst;
use common\models\Notifications;
use common\models\StockRegister;
use common\models\StockView;

/**
 * PurchaseInvoiceDetailsController implements the CRUD actions for PurchaseInvoiceDetails model.
 */
class PurchaseInvoiceDetailsController extends Controller {

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
         * Lists all PurchaseInvoiceDetails models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new PurchaseInvoiceMasterSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single PurchaseInvoiceDetails model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                $model = PurchaseInvoiceMaster::findOne(['id' => $id]);
                $sales_details = PurchaseInvoiceDetails::findAll(['sales_invoice_master_id' => $id]);
                return $this->render('view', [
                            'model' => $model,
                            'sales_details' => $sales_details,
                ]);
        }

        /**
         * Creates a new PurchaseInvoiceDetails model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new PurchaseInvoiceDetails();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing PurchaseInvoiceDetails model.
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
         * Deletes an existing PurchaseInvoiceDetails model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the PurchaseInvoiceDetails model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return PurchaseInvoiceDetails the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = PurchaseInvoiceDetails::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionAdd() {
                $model = new PurchaseInvoiceDetails();
                $model_purchase_master = new PurchaseInvoiceMaster();
                $report_id = '';
                if ($model_purchase_master->load(Yii::$app->request->post())) {
                        $payment_type = 1;
                        $data = Yii::$app->request->post();
                        if ($data['order_sub_total'] > 0) {
                                $arr = $this->SavePurchaseDetails($model_purchase_master, $data);
                                $model_purchase_master = $this->SavePurchaseMaster($model_purchase_master, $data, $arr);
                                $transaction = Yii::$app->db->beginTransaction();

                                try {
                                        if ($model_purchase_master->save() && $this->AddPurchaseDetails($arr, $model_purchase_master)) {
                                                $transaction->commit();
                                                Yii::$app->SetValues->Accounts($model_purchase_master->branch_id, 2, $model_purchase_master->id, 1, 'Purchase', $model_purchase_master->payment, $model_purchase_master->amount_payed, $model_purchase_master->sales_invoice_date);
                                                Yii::$app->getSession()->setFlash('success', 'Purchased Successfully');
                                        } else {
                                                $transaction->rollBack();
                                        }
                                } catch (Exception $e) {
                                        $transaction->rollBack();
                                }
                        }
                }
                return $this->render('add', [
                            'model' => $model,
                            'model_purchase_master' => $model_purchase_master,
                            'report_id' => $report_id,
                ]);
        }

        public function SavePurchaseMaster($model_purchase_master, $data, $arr) {
                $model_purchase_master->sales_invoice_number = $data['PurchaseInvoiceMaster']['purchase_invoice_number'];
                $model_purchase_master->sales_invoice_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $data['purchase_invoice_date'])));
                $model_purchase_master->busines_partner_code = $data['PurchaseInvoiceMaster']['busines_partner_code'];
                $model_purchase_master->salesman = $data['PurchaseInvoiceMaster']['salesman'];
                $model_purchase_master->reference = $data['PurchaseInvoiceMaster']['reference'];
                $model_purchase_master->general_terms = $data['PurchaseInvoiceMaster']['general_terms'];
                $model_purchase_master->payment = $data['PurchaseInvoiceMaster']['payment'];
                $model_purchase_master->branch_id = $data['PurchaseInvoiceMaster']['branch_id'];
                $model_purchase_master->amount = $data['amount_without_tax'];
                $model_purchase_master->tax_amount = $data['tax_sub_total'];
                $model_purchase_master->order_amount = $data['order_sub_total'];
                $model_purchase_master->cash_amount = 0;
                $model_purchase_master->card_amount = 0;
                $model_purchase_master->round_of_amount = 0;
                $model_purchase_master->discount_amount = $data['discount_sub_total'];
                $model_purchase_master->amount_payed = $data['order_sub_total'];
                $model_purchase_master->due_amount = 0;
                $goods_service = $this->GetGoodsServiceTotal($arr);
                $model_purchase_master->goods_total = $goods_service['goods-total'];
                $model_purchase_master->due_date = date("Y-m-d", strtotime($data['due_date']));
                $model_purchase_master->status = 1;
                Yii::$app->SetValues->Attributes($model_purchase_master);
                return $model_purchase_master;
        }

        /*
          public function SaveGld($model_sales_master) {
          $flag = 0;
          $gld_master = new \common\models\GldMst();
          $gld_master->journal_type = 1;
          $gld_master->voucher_type = 10;
          $gld_master->document_no = $model_sales_master->sales_invoice_number;
          $gld_master->document_date = $model_sales_master->sales_invoice_date;
          $financial_year_data = $this->GetFinancialYear($model_sales_master->sales_invoice_date);
          $gld_master->financial_year = $financial_year_data->financial_year;
          $gld_master->financial_year_id = $financial_year_data->id;
          $gld_master->debit_amount = $model_sales_master->tax_amount + $model_sales_master->goods_total + $model_sales_master->service_total;
          $gld_master->credit_amount = $model_sales_master->order_amount + $model_sales_master->discount_amount;
          $gld_master->balance_amount = $model_sales_master->due_amount;
          $gld_master->status = 0;
          Yii::$app->SetValues->Attributes($gld_master);
          if ($gld_master->save()) {
          if ($this->SaveSaleGldDetails($model_sales_master, $gld_master)) {
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

          public function SaveSaleGldDetails($model_sales_master, $gld_master) {
          $flag = 0;
          $j = 0;
          $arr = array(Yii::$app->params['accounts_payables'], Yii::$app->params['tax_payables'], Yii::$app->params['inventory_assets'], Yii::$app->params['cash_discount'], Yii::$app->params['cost_of_goods_sold']);
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
          if ($x == Yii::$app->params['accounts_payables']) {
          $gld_details->bp_code = $model_sales_master->busines_partner_code;
          $bp_name = \common\models\BusinessPartner::findOne(['id' => $model_sales_master->busines_partner_code])->name;
          $gld_details->bp_name = $bp_name;
          $gld_details->credit_amount = $model_sales_master->amount + $model_sales_master->tax_amount;
          } elseif ($x == Yii::$app->params['tax_payables']) {
          $gld_details->debit_amount = $model_sales_master->tax_amount;
          } elseif ($x == Yii::$app->params['inventory_assets']) {
          $gld_details->debit_amount = $model_sales_master->goods_total;
          } elseif ($x == Yii::$app->params['cash_discount']) {
          $gld_details->credit_amount = $model_sales_master->discount_amount;
          } elseif ($x == Yii::$app->params['cost_of_goods_sold']) {
          $gld_details->debit_amount = $model_sales_master->goods_total;
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
          } */

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

        public function GetGoodsServiceTotal($arr) {
                $goods_total = 0;
                foreach ($arr as $val) {
                        $item_datas = \common\models\ItemMaster::find()->where(['id' => $val['SalesInvoiceDetailsItem']])->one();
                        if (!empty($item_datas)) {
                                $qty = $val['SalesInvoiceDetailsQty'];
                                if ($item_datas->item_type == 0) {
                                        $goods_total += $qty * $val['SalesInvoiceDetailsRate'];
                                }
                        }
                }
                $datas = array('goods-total' => $goods_total);
                return $datas;
        }

        public function UpdateSerialNo($payment_details, $voucher_series) {
                $document_no = explode('/', $payment_details->document_no);
                $num = $document_no[2] + 1;
                $voucher_series->sequence_no = $num;
                return $voucher_series;
        }

        public function SavePurchaseDetails($model_purchase_master, $data) {
                $arr = [];
                $i = 0;
                foreach ($data['SalesInvoiceDetailsItem'] as $val) {
                        $arr[$i]['SalesInvoiceDetailsItem'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($data['SalesInvoiceDetailsQty'] as $val) {
                        $arr[$i]['SalesInvoiceDetailsQty'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($data['sales-uom'] as $val) {
                        $arr[$i]['sales-uom'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($data['SalesInvoiceDetailsRate'] as $val) {
                        $arr[$i]['SalesInvoiceDetailsRate'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($data['SalesInvoiceDetailsDiscountType'] as $val) {
                        $arr[$i]['SalesInvoiceDetailsDiscountType'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($data['SalesInvoiceDetailsDiscountValue'] as $val) {
                        $arr[$i]['SalesInvoiceDetailsDiscountValue'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($data['SalesInvoiceDetailsTax'] as $val) {
                        $arr[$i]['SalesInvoiceDetailsTax'] = $val;
                        $i++;
                }
                $i = 0;
                foreach ($data['SalesInvoiceDetailsLineTotal'] as $val) {
                        $arr[$i]['SalesInvoiceDetailsLineTotal'] = $val;
                        $i++;
                }
//                $i = 0;
//                foreach ($data['SalesInvoiceDetailsItemComment'] as $val) {
//                        $arr[$i]['SalesInvoiceDetailsItemComment'] = $val;
//                        $i++;
//                }
                return $arr;
        }

        public function AddPurchaseDetails($arr, $model_purchase_master) {
                $j = 0;
                $flag = 0;
                foreach ($arr as $val) {
                        $j++;
                        $aditional = new PurchaseInvoiceDetails();
                        $item_datas = \common\models\ItemMaster::find()->where(['id' => $val['SalesInvoiceDetailsItem']])->one();
                        if (!empty($item_datas)) {
                                $aditional->sales_invoice_master_id = $model_purchase_master->id;
                                $aditional->sales_invoice_number = $model_purchase_master->sales_invoice_number;
                                $aditional->sales_invoice_date = $model_purchase_master->sales_invoice_date;
                                $aditional->busines_partner_code = $model_purchase_master->busines_partner_code;
                                $aditional->item_id = $val['SalesInvoiceDetailsItem'];
                                $aditional->item_code = $item_datas->SKU;
                                $aditional->item_name = $item_datas->item_name;
                                $aditional->base_unit = $item_datas->base_unit_id;
                                $aditional->qty = $val['SalesInvoiceDetailsQty'];
                                if (isset($item_datas->hsn)) {
                                        $aditional->hsn = $item_datas->hsn;
                                }
                                $aditional->rate = $val['SalesInvoiceDetailsRate'];
                                $aditional->amount = $aditional->qty * $aditional->rate;
                                $aditional->discount_type = $val['SalesInvoiceDetailsDiscountType'];
                                $aditional->discount_value = $val['SalesInvoiceDetailsDiscountValue'];
                                if ($aditional->discount_type == 0) {
                                        $aditional->discount_amount = $val['SalesInvoiceDetailsDiscountValue'];
                                } else {
                                        $aditional->discount_amount = ($aditional->amount * $val['SalesInvoiceDetailsDiscountValue']) / 100;
                                }
                                $aditional->net_amount = $aditional->amount - $aditional->discount_amount;
                                $aditional->line_total = $val['SalesInvoiceDetailsLineTotal'];
                                $aditional->tax_id = $val['SalesInvoiceDetailsTax'];
                                $tax = \common\models\Tax::findOne(['id' => $aditional->tax_id]);
                                if ($tax->type == 1) {
                                        $tax_amount = $tax->value;
                                } else {
                                        $tax_amount = ($aditional->net_amount * $tax->value) / 100;
                                }
                                $aditional->tax_amount = $tax_amount;
                                $aditional->tax_type = $tax->type;
                                $aditional->tax_percentage = $tax->value;
                                $aditional->line_total = $val['SalesInvoiceDetailsLineTotal'];
                                //  $aditional->comments = $val['SalesInvoiceDetailsItemComment'];
//            $aditional->line_total = $aditional->amount + $aditional->tax_amount - $aditional->discount_value;
                                $aditional->status = 1;
                                $aditional->CB = Yii::$app->user->identity->id;
                                $aditional->UB = Yii::$app->user->identity->id;
                                $aditional->DOC = date('Y-m-d');
                                if ($aditional->save()) {
                                        if ($item_datas->item_type == 0) {
                                                $stock = new StockRegister();
                                                $stock = $this->AddStockRegister($aditional, $j, $stock);
                                                if ($stock->save()) {
                                                        if ($this->AddStockView($stock)) {
                                                                $flag = 1;
                                                        } else {
                                                                $flag = 0;
                                                        }
                                                } else {
                                                        $flag = 0;
                                                }
                                        } else {
                                                $flag = 1;
                                        }
                                } else {
                                        $flag = 0;
                                }
                        }
                }
                if ($flag == 1) {
                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        public function AddStockRegister($aditional, $j, $stock) {
                $stock->transaction = 2;
                $stock->document_line_id = $j;
                $stock->document_no = $aditional->sales_invoice_number;
                $stock->document_date = $aditional->sales_invoice_date;
                $stock->item_id = $aditional->item_id;
                $stock->item_code = $aditional->item_code;
                $stock->item_name = $aditional->item_name;
                $stock->location_code = 'HOFF';
                $stock->item_cost = $aditional->rate;
                $stock->qty_in = $aditional->qty;
                $stock->balance_qty = $aditional->qty;
                $stock->total_cost = $aditional->line_total;
                $stock->status = 1;
                $stock->CB = Yii::$app->user->identity->id;
                $stock->UB = Yii::$app->user->identity->id;
                $stock->DOC = date('Y-m-d');
                return $stock;
        }

        public function AddStockView($stock) {
                $stock_view_exist = StockView::find()->where(['item_id' => $stock->item_id])->one();
                if (empty($stock_view_exist)) {
                        $stock_view = new StockView();
                        $stock_view->item_id = $stock->item_id;
                        $stock_view->item_code = $stock->item_code;
                        $stock_view->item_name = $stock->item_name;
                        $item_master = \common\models\ItemMaster::findOne(['id' => $stock->item_id]);
                        $stock_view->retail_price = $item_master->retail_price;
                        $stock_view->available_qty = $stock->qty_in;
                        $stock_view->status = 1;
                        $stock_view->CB = Yii::$app->user->identity->id;
                        $stock_view->UB = Yii::$app->user->identity->id;
                        $stock_view->DOC = date('Y-m-d');
                } else {
                        $stock_view = StockView::find()->where(['item_id' => $stock->item_id])->one();
                        $stock_view->available_qty += $stock->qty_in;
                }
                //  $stock_view->average_cost = Yii::$app->SetValues->CalculateAvg($stock->item_id);
                if ($stock_view->save()) {
                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        public function UpdateSerialNumber($model_purchase_master, $data) {
                $sequence_no = explode("-", $model_purchase_master->sales_invoice_number);
                $serial_no = \common\models\SerialNumber::find()->orderBy(['id' => SORT_DESC])->where(['transaction' => 2])->one();
                $serial_no->sequence_no = $sequence_no[1];
                $serial_no->save();
                return;
        }

        public function actionReport($id) {
                $sales_master = PurchaseInvoiceMaster::findOne(['id' => $id]);
                $sales_details = PurchaseInvoiceDetails::findAll(['sales_invoice_master_id' => $sales_master->id]);
                // $invoice_parameter = \common\models\InvoiceParameter::findOne(['id' => 1]);
//                if ($invoice_parameter->report_template == 0) {
//                        $view = 'purchase_report';
//                } elseif ($invoice_parameter->report_template == 1) {
//                        $view = 'thermal_print';
//                }
                echo $this->renderPartial('purchase_report', [
                    'sales_master' => $sales_master,
                    'sales_details' => $sales_details,
                    'invoice_parameter' => $invoice_parameter,
                    'print' => true,
                    'save' => false,
                ]);
                exit;
        }

        public function actionAddSale($id) {
                $purchase_master = PurchaseInvoiceMaster::findOne(['id' => $id]);
                $purchase_details = PurchaseInvoiceDetails::findAll(['sales_invoice_master_id' => $id]);
                $model_sales_master = new \common\models\SalesInvoiceMaster();
                $this->SaveSalesMaster($model_sales_master, $purchase_master);
                $payment_type = 0;
                $transaction = Yii::$app->db->beginTransaction();

                try {
                        if ($model_sales_master->save() && $this->SavePurchasePayment($model_sales_master, $payment_type) && $this->SaveSalesDetails($model_sales_master, $purchase_details, $purchase_master) && $this->UpdateSalesSerialNumber($model_sales_master)) {
                                $transaction->commit();
                        } else {
                                $transaction->rollBack();
                        }
                } catch (Exception $e) {
                        $transaction->rollBack();
                }
                return $this->redirect(Yii::$app->request->referrer);
        }

        public function SaveSalesMaster($model_sales_master, $purchase_master) {
                $serial_no = \common\models\SerialNumber::find()->orderBy(['id' => SORT_DESC])->where(['transaction' => 0])->one();
                $new_invoice_number = $this->generateSalesInvoice($serial_no->prefix, $serial_no->sequence_no);
                $model_sales_master->sales_invoice_number = $new_invoice_number;
                $model_sales_master->sales_invoice_date = date("Y-m-d H:i:s");
                $model_sales_master->busines_partner_code = $purchase_master->busines_partner_code;
                $model_sales_master->salesman = $purchase_master->salesman;
                $model_sales_master->reference = $purchase_master->reference;
                $model_sales_master->delivery_terms = $purchase_master->delivery_terms;
                $model_sales_master->payment_terms = $purchase_master->payment_terms;
                $model_sales_master->payment_status = $purchase_master->payment_status;
                $model_sales_master->amount = $purchase_master->amount;
                $model_sales_master->tax_amount = $purchase_master->tax_amount;
                $model_sales_master->order_amount = $purchase_master->order_amount;
                $model_sales_master->cash_amount = $purchase_master->cash_amount;
                $model_sales_master->card_amount = $purchase_master->card_amount;
                $model_sales_master->round_of_amount = $purchase_master->round_of_amount;
                $model_sales_master->discount_amount = $purchase_master->discount_amount;
                $model_sales_master->amount_payed = $purchase_master->amount_payed;
                $model_sales_master->due_amount = $purchase_master->due_amount;
                $model_sales_master->status = 1;
                Yii::$app->SetValues->Attributes($model_sales_master);
                return $model_sales_master;
        }

        public function SaveSalesDetails($model_sales_master, $purchase_details, $purchase_master) {
                $flag = 0;
                foreach ($purchase_details as $value) {
                        $model_sales_details = new \common\models\SalesInvoiceDetails();
                        $model_sales_details->sales_invoice_master_id = $model_sales_master->id;
                        $model_sales_details->sales_invoice_number = $model_sales_master->sales_invoice_number;
                        $model_sales_details->sales_invoice_date = $model_sales_master->sales_invoice_date;
                        $model_sales_details->busines_partner_code = $model_sales_master->busines_partner_code;
                        $model_sales_details->item_id = $value->item_id;
                        $model_sales_details->item_code = $value->item_code;
                        $model_sales_details->item_name = $value->item_name;
                        $model_sales_details->base_unit = $value->base_unit;
                        $model_sales_details->qty = $value->qty;
                        $model_sales_details->rate = $value->rate;
                        $model_sales_details->amount = $value->amount;
                        $model_sales_details->discount_type = $value->discount_type;
                        $model_sales_details->discount_value = $value->discount_value;
                        $model_sales_details->net_amount = $value->net_amount;
                        $model_sales_details->line_total = $value->line_total;
                        $model_sales_details->tax_id = $value->tax_id;
                        $model_sales_details->tax_amount = $value->tax_amount;
                        $model_sales_details->line_total = $value->line_total;
                        $model_sales_details->status = 1;
                        $model_sales_details->CB = Yii::$app->user->identity->id;
                        $model_sales_details->UB = Yii::$app->user->identity->id;
                        $model_sales_details->DOC = date('Y-m-d');
                        if (!empty($model_sales_details->item_code)) {
                                if ($model_sales_details->save()) {
                                        $purchase_master->flag = 1;
                                        if ($purchase_master->update()) {
                                                $flag = 1;
                                        }
                                }
                        }
                }
                if ($flag == 1) {
                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        public function UpdateSalesSerialNumber($model_sales_master) {
                $sequence_no = explode("-", $model_sales_master->sales_invoice_number);
                $serial_no = \common\models\SerialNumber::find()->orderBy(['id' => SORT_DESC])->where(['transaction' => 0])->one();
                $serial_no->sequence_no = $sequence_no[1];
                if ($serial_no->save()) {
                        return TRUE;
                } else {
                        return FALSE;
                }
        }

        public function actionItemNames() {
                if (Yii::$app->request->isAjax) {

                        $data_char = $_POST['item'];
                        if (!empty($data_char)) {
                                $results = \common\models\ItemMaster::find()->where(['LIKE', 'SKU', $data_char])->orWhere(['LIKE', 'item_name', $data_char])->all();
                                foreach ($results as $result) {
                                        $arr[] = ['label' => $result->item_name, 'value' => $result->id];
                                }
                        } else {
                                $arr[] = '';
                        }
                        return json_encode($arr);
                }
        }

        public function generateSalesInvoice($prefix, $sequence_no) {
                $invoice_no = $prefix . '-' . $sequence_no;
                $file_exist = \common\models\SalesInvoiceMaster::find()->where(['sales_invoice_number' => $invoice_no])->one();
                if (!empty($file_exist)) {
                        return $this->generateSalesInvoice($prefix, $sequence_no + 1);
                } else {
                        return $invoice_no;
                }
        }

        public function generateInvoice($prefix, $sequence_no) {
                $invoice_no = $prefix . '-' . $sequence_no;
                $file_exist = PurchaseInvoiceMaster::find()->where(['sales_invoice_number' => $invoice_no])->one();
                if (!empty($file_exist)) {
                        return $this->generateInvoice($prefix, $sequence_no + 1);
                } else {
                        return $invoice_no;
                }
        }

        public function actionItemPartner() {
                if (Yii::$app->request->isAjax) {
                        $keyword = $_POST['keyword'];
                        $partner_datas = BusinessPartner::find()->where(['LIKE', 'name', $keyword])->all();
                        if (!empty($partner_datas)) {
                                ?>
                                <?php
                                foreach ($partner_datas as $partner) {
                                        ?>
                                        <li onClick="selectPartner('<?php echo $partner->name; ?>');"><?php echo $partner->name; ?></li>
                                <?php } ?>
                        <?php }
                        ?>
                        <?php
                }
        }

}
