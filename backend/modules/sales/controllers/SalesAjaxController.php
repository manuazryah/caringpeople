<?php

namespace backend\modules\sales\controllers;

use Yii;

class SalesAjaxController extends \yii\web\Controller {

        public function init() {

        }

        public function actionIndex() {
                return $this->render('index');
        }

        /*
         * This function select base_unit and tax based on the item_id
         * @return base_unit(UOM) and tax as json
         */

        public function actionItemDetails() {
                if (Yii::$app->request->isAjax) {
                        $item_id = $_POST['item_id'];
                        $next_row_id = $_POST['next_row_id'];
                        $type = $_POST['bill_type'];
                        $next = $next_row_id + 1;
                        $items = \common\models\ItemMaster::find()->where(['status' => 1])->all();
                        $taxes = \common\models\Tax::findAll(['status' => 1]);
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
                                        if ($type == 1 || $type == 4) {
                                                if ($existing_stock > 0) {
                                                        $flag = 0;
                                                } else {
                                                        $flag = 1;
                                                }
                                        } else {
                                                $flag = 0;
                                        }
                                        if ($flag == 0 || $item_datas->item_type == 1) {
                                                $next_row = $this->renderPartial('next_row', [
                                                    'next' => $next,
                                                    'items' => $items,
                                                    'taxes' => $taxes,
                                                ]);
                                                if ($type == 1 || $type == 2) {
                                                        if ($type == 1 && $flag == 0) {
                                                                $price = $item_datas->retail_price;
                                                        } else {
                                                                $price = $item_datas->retail_price;
                                                        }
                                                } else {
                                                        $price = $item_datas->purchase_price;
                                                }

                                                $uom = \common\models\BaseUnit::findOne(['id' => $item_datas->base_unit_id])->value;
                                                $tax = \common\models\Tax::findOne(['id' => $item_datas->tax_id]);
                                                $arr_variable = array('item-type' => $item_datas->item_type, 'UOM' => $uom, 'tax-amount' => $tax->value, 'base_unit' => $item_datas->base_unit_id, 'tax_type' => $tax->type, 'next_row_html' => $next_row, 'next' => $next, 'item_rate' => $price, 'tax_id' => $tax->id, 'existing_stock' => $existing_stock);
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

        public function actionCheckStock() {
                if (Yii::$app->request->isAjax) {
                        $item_id = $_POST['item_code'];
                        $item_datas = \common\models\ItemMaster::find()->where(['id' => $item_id])->one();
                        $in_stock = \common\models\StockRegister::find()->where(['item_code' => $item_datas->SKU])->sum('qty_in');
                        $out_stock = \common\models\StockRegister::find()->where(['item_code' => $item_datas->SKU])->sum('qty_out');
                        $existing_stock = $in_stock - $out_stock;
                        echo $existing_stock;
                }
        }

        public function actionTaxDetails() {
                if (Yii::$app->request->isAjax) {
                        $tax_id = $_POST['tax_id'];
                        $tax = \common\models\Tax::findOne(['id' => $tax_id]);
                        $arr_variable = array('tax-value' => $tax->value, 'tax_type' => $tax->type, 'tax_id' => $tax->id);
                        $data['result'] = $arr_variable;
                        echo json_encode($data);
                }
        }

        /*
         * This function select base_unit and tax based on the item_id
         * @return base_unit(UOM) and tax as json
         */

        public function actionCreateNewRow() {
                if (Yii::$app->request->isAjax) {
                        $next_row_id = $_POST['next_row_id'];
                }
        }

        /*
         * This function select base_unit and tax based on the item_id
         * @return base_unit(UOM) and tax as json
         */

        public function actionRate() {
                if (Yii::$app->request->isAjax) {
                        $base_unit = $_POST['base_unit'];
                        $rate = \common\models\BaseUnit::find()->where(['id' => $base_unit])->one();
                        if (empty($rate)) {
                                echo '0';
                                exit;
                        } else {
                                return $rate->value;
                        }
                }
        }

        public function actionGetAutocomplteItems() {
                if (Yii::$app->request->isAjax) {
                        $keyword = $_POST['keyword'];
                        $item_datas = \common\models\ItemMaster::find()->where(['status' => 1])->all();
                        if (!empty($item_datas)) {
                                ?>
                                <?php
                                foreach ($item_datas as $item_data) {
                                        ?>
                                        <li class="" data-id="<?php echo $item_data->id; ?>" data-value="<?php echo $item_data->SKU . '  -' . $item_data->item_name; ?>"><?php echo $item_data->SKU . '  -' . $item_data->item_name; ?></li>
                                <?php } ?>
                        <?php }
                        ?>
                        <?php
                }
        }

        public function actionGetAutocomplteItemss() {
                if (Yii::$app->request->isAjax) {
                        $keyword = $_POST['keyword'];
                        $item_datas = \common\models\ItemMaster::find()->where(['status' => 1])->all();
                        if (!empty($item_datas)) {
                                ?>
                                <?php
                                foreach ($item_datas as $item_data) {
                                        $in_stock = \common\models\StockRegister::find()->where(['item_code' => $item_data->SKU])->sum('qty_in');
                                        $out_stock = \common\models\StockRegister::find()->where(['item_code' => $item_data->SKU])->sum('qty_out');
                                        $existing_stock = $in_stock - $out_stock;
                                        if ($existing_stock > 0) {
                                                $stocks = '';
                                        } else {
                                                if ($item_data->item_type == 0) {
                                                        $stocks = ' (<span style="color: #c94a4a;"> No Stock Available<span>)';
                                                } else {
                                                        $stocks = '';
                                                }
                                        }
                                        ?>
                                        <li class="" data-id="<?php echo $item_data->id; ?>" data-value="<?php echo $item_data->SKU . '  -' . $item_data->item_name; ?>"><?php echo $item_data->SKU . '  -' . $item_data->item_name . $stocks; ?></li>
                                <?php } ?>
                        <?php }
                        ?>
                        <?php
                }
        }

        public function actionAddPartner() {
                if (Yii::$app->request->isAjax) {
                        $partner_type = $_POST['partner-type'];
                        $data = $this->renderPartial('_form_add_partner', [
                            'partner_type' => $partner_type,
                        ]);
                        echo $data;
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

        public function actionUpdatePartner() {
                if (Yii::$app->request->isAjax) {
                        $model = new \common\models\BusinessPartner();
                        $model->type = $_POST['partner_type'];
                        $model->business_partner_code = $_POST['bussiness_partner_code'];
                        $model->name = $_POST['bussiness_partner_name'];
                        $model->phone = $_POST['bussiness_partner_phone'];
                        $model->email = $_POST['bussiness_partner_email'];
                        Yii::$app->SetValues->Attributes($model);
                        if ($model->save()) {
                                $partner_code = explode("-", $model->business_partner_code);
                                $serial_no = \common\models\SerialNumber::find()->orderBy(['id' => SORT_DESC])->where(['transaction' => 5])->one();
                                $serial_no->sequence_no = $partner_code[1];
                                $serial_no->save();
                                $arrr_variable = array('partner-id' => $model->id, 'partner-name' => $model->name);
                                $data['result'] = $arrr_variable;
                                echo json_encode($data);
                        }
                }
        }

        public function actionGetSupplier() {
                if (Yii::$app->request->isAjax) {
                        $keyword = $_POST['keyword'];
                        $partner_datas = \common\models\BusinessPartner::find()->where(['type' => 1])->all();
                        if (!empty($partner_datas)) {
                                ?>
                                <?php
                                foreach ($partner_datas as $partner) {
                                        ?>
                                        <li class="" data-id="<?php echo $partner->id; ?>" data-value="<?php echo $partner->name; ?>"><?php echo $partner->name . ' - ' . $partner->business_partner_code . ' - ' . $partner->phone; ?></li>
                                <?php } ?>
                        <?php }
                        ?>
                        <?php
                }
        }

        public function actionItemPartner() {
                if (Yii::$app->request->isAjax) {
                        $keyword = $_POST['keyword'];
                        if (Yii::$app->user->identity->branch_id != '0') {
                                $partner_datas = \common\models\Service::find()->where(['branch_id' => Yii::$app->user->identity->branch_id])->all();
                        } else {
                                $partner_datas = \common\models\Service::find()->all();
                        }
                        if (!empty($partner_datas)) {
                                ?>
                                <li class="" data-id="" data-value="- Select Partner -">- Select Service -</li>
                                <?php
                                foreach ($partner_datas as $partner) {
                                        ?>
                                        <li class="" data-id="<?php echo $partner->id; ?>" data-value="<?php echo $partner->service_id; ?>"><?php echo $partner->service_id; ?></li>
                                <?php } ?>
                        <?php }
                        ?>
                        <?php
                }
        }

        public function actionChangeInvoiceNumber() {
                if (Yii::$app->request->isAjax) {
                        $invoive_type = $_POST['invoice-type'];
                        $serial_number = \common\models\SerialNumber::find()->orderBy(['id' => SORT_DESC])->where(['transaction' => $invoive_type])->one();
                        $invoice_no = $serial_number->prefix . '-' . $serial_number->sequence_no;
                        if ($invoive_type == 2) {
                                $file_exist = \common\models\PurchaseInvoiceMaster::find()->where(['sales_invoice_number' => $invoice_no])->one();
                        } else if ($invoive_type == 1) {
                                $file_exist = \common\models\SalesReturnInvoiceMaster::find()->where(['sales_invoice_number' => $invoice_no])->one();
                        } else if ($invoive_type == 0) {
                                $file_exist = \common\models\SalesInvoiceMaster::find()->where(['sales_invoice_number' => $invoice_no])->one();
                        }
                        if (!empty($file_exist)) {
                                $prefixx = $serial_number->prefix;
                                $sequence_num = $serial_number->sequence_no + 1;
                        } else {
                                $prefixx = $serial_number->prefix;
                                $sequence_num = $serial_number->sequence_no;
                        }
                        $data = $this->renderPartial('_form_change_invoice', [
                            'prefixx' => $prefixx,
                            'sequence_num' => $sequence_num,
                            'invoive_type' => $invoive_type,
                        ]);
                        echo $data;
                }
        }

        public function actionAddInvoiceNumber() {
                if (Yii::$app->request->isAjax) {
                        $invoice_type = $_POST['sales_invoice_type'];
                        $model = \common\models\SerialNumber::find()->orderBy(['id' => SORT_DESC])->where(['transaction' => $invoice_type])->one();
                        $prefix = $_POST['invoice_prefix'];
                        $sequence_no = $_POST['invoice_next_no'];
                        $invoice_no = $prefix . '-' . $sequence_no;
                        if ($invoice_type == 0) {
                                $file_exist = \common\models\SalesInvoiceMaster::find()->where(['sales_invoice_number' => $invoice_no])->one();
                        } elseif ($invoice_type == 1) {
                                $file_exist = \common\models\SalesReturnInvoiceMaster::find()->where(['sales_invoice_number' => $invoice_no])->one();
                        } elseif ($invoice_type == 2) {
                                $file_exist = \common\models\PurchaseInvoiceMaster::find()->where(['sales_invoice_number' => $invoice_no])->one();
                        }

                        if (!empty($file_exist)) {
                                echo '1';
                                exit;
                        } else {
                                $model->prefix = $prefix;
                                $model->sequence_no = $sequence_no;
                                if ($model->save()) {
                                        $arrr_variable = array('prefix' => $model->prefix, 'serial-no' => $model->sequence_no);
                                        $data['result'] = $arrr_variable;
                                        echo json_encode($data);
                                }
                        }
                }
        }

        public function actionAddNewItem() {
                if (Yii::$app->request->isAjax) {
                        $row_id = $_POST['row_id'];
                        $bill_type = $_POST['bill_type'];
                        $tax = \common\models\Tax::find()->where(['status' => 1])->all();
                        $base_unit = \common\models\BaseUnit::find()->where(['status' => 1])->all();
                        $data = $this->renderPartial('_form_add_new_item', [
                            'tax' => $tax,
                            'base_unit' => $base_unit,
                            'row_id' => $row_id,
                            'bill_type' => $bill_type,
                        ]);
                        echo $data;
                }
        }

        public function actionSaveNewItem() {
                if (Yii::$app->request->isAjax) {
                        $bill_type = $_POST['bill_types'];
                        $model = new \common\models\ItemMaster();
                        $model->SKU = $_POST['sales_item_code'];
                        $model->item_name = $_POST['sales_item_name'];
                        $model->item_type = $_POST['sales_item_type'];
                        $model->tax_id = $_POST['sales_item_tax'];
                        $model->hsn = $_POST['sales_item_hsn'];
                        $model->base_unit_id = $_POST['sales_item_base_unit'];
                        $model->retail_price = $_POST['sales_item_retail_price'];
                        $model->purchase_price = $_POST['sales_item_purchase_price'];
                        $model->status = 1;
                        Yii::$app->SetValues->Attributes($model);
                        if ($model->save()) {
                                if ($bill_type == 1 || $bill_type == 2) {
                                        $price = $model->retail_price;
                                } else {
                                        $price = $model->purchase_price;
                                }
                                $uom = \common\models\BaseUnit::findOne(['id' => $model->base_unit_id])->name;
                                $tax = \common\models\Tax::findOne(['id' => $model->tax_id]);
                                $data_variable = array('item_type' => $model->item_type, 'item_id' => $model->id, 'item_name' => $model->item_name, 'UOM' => $uom, 'rate' => $price, 'base_unit' => $model->base_unit_id, 'tax_type' => $tax->type, 'tax_value' => $tax->value, 'tax_id' => $tax->id);
                                $data['result'] = $data_variable;
                                echo json_encode($data);
                        }
                }
        }

        public function actionAddAnotherRow() {
                if (Yii::$app->request->isAjax) {
                        $next_row_id = $_POST['next_row_id'];
                        $next = $next_row_id + 1;
                        $taxes = \common\models\Tax::findAll(['status' => 1]);
                        $items = \common\models\ItemMaster::findAll(['status' => 1]);
                        $next_row = $this->renderPartial('next_row', [
                            'next' => $next,
                            'items' => $items,
                            'taxes' => $taxes,
                        ]);
                        $new_row = array('next_row_html' => $next_row);
                        $data['result'] = $new_row;
                        echo json_encode($data);
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

        public function actionSku() {

                if (Yii::$app->request->isAjax) {

                        $SKU = $_POST['item_code'];
                        $item_datas = \common\models\ItemMaster::find()->where(['SKU' => $SKU])->one();
                        if (empty($item_datas)) {
                                echo '1';
                                exit;
                        } else {
                                echo '0';
                                exit;
                        }
                }
        }

        public function actionGetStock() {

                if (Yii::$app->request->isAjax) {
                        $items = \common\models\ItemMaster::find()->where(['status' => 1])->all();
                        $result = array();
                        foreach ($items as $item) {
                                $item_stocks = \common\models\StockRegister::find()->where(['item_id' => $item->id])->all();
                                if (!empty($item_stocks)) {
                                        foreach ($item_stocks as $stocks) {
                                                if ($stocks->balance_qty > 0)
                                                        $result[$item->id][$stocks->balance_qty] = array('rate' => $stocks->item_cost);
                                        }
                                }
                        }
                        $data['result'] = $result;
                        echo json_encode($data);
                }
        }

//    public function actionGetStock() {
//
//        if (Yii::$app->request->isAjax) {
//            $items = \common\models\ItemMaster::find()->where(['status' => 1])->all();
//            $result = array();
//            foreach ($items as $item) {
//                $item_stocks = \common\models\StockRegister::find()->where(['item_id' => $item->id])->all();
//                if (!empty($item_stocks)) {
//                    foreach ($item_stocks as $stocks) {
//                        if ($stocks->balance_qty > 0)
//                            $result[$item->id][] = array('qty' => $stocks->balance_qty, 'rate' => $stocks->item_cost);
//                    }
//                }
//            }
//            var_dump($result);
//            exit;
//        }
//    }
}
