<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
Use common\models\BaseUnit;

/* @var $this yii\web\View */
/* @var $model common\models\SalesInvoiceDetails */

$this->title = $model->document_no;
$this->params['breadcrumbs'][] = ['label' => 'Sales Invoice Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .appoint{
        width: 100%;
        background-color: #eeeeee;
    }
    .appoint .value{
        font-weight: bold;
        text-align: left;
    }
    .appoint .labell{
        text-align: left;
    }
    .appoint .colen{

    }
    .appoint td{
        padding: 10px;
    }
    table th{
        color:black;
    }
    table td{
        color:black;
    }
    .sales-master{
        margin-bottom: 40px;
    }
    .sales-details{
        margin-bottom: 40px;
    }
    h4{
        color: #2196F3;
    }
</style>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Invoice</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?php
                if ($model->status == 0) {
                    echo Html::a('<i class="fa-check"></i><span> Approve Invoice</span>', ['approve', 'id' => $model->id], ['class' => 'btn btn-secondary btn-icon btn-icon-standalone']);
                }
                ?>
                <div class="panel-body">
                    <div class="sales-master table-responsive">
                        <h4>Stock Adjustment Master</h4>
                        <table class="appoint">
                            <tr>
                                <td class="labell">Document Number </td><td class="colen">:</td><td class="value"> <?= $model->document_no; ?></td>
                                <td class="labell">Document Date</td><td class="colen">:</td><td class="value"><?= $model->document_date; ?></td>
                            </tr>
                            <tr>
                                <td class="labell">Salesman </td><td class="colen">:</td><td class="value">
                                    <?php
                                    if ($model->transaction == 0) {
                                        echo 'Opening';
                                    } elseif ($model->transaction == 1) {
                                        echo 'Addition';
                                    } elseif ($model->transaction == 2) {
                                        echo 'Deduction';
                                    }
                                    ?>
                                </td>
                                <td class="labell">Total Amount </td><td class="colen">:</td><td class="value"> <?= $model->reference ?></td>
                            </tr>

                        </table>
                    </div>
                    <div class="sales-details">
                        <h4>Stock Adjustment Details</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Item Cost</th>
                                <th>Line Total</th>
                            </tr>
                            <?php
                            $line_total = 0;
                            $qty_total = 0;
                            foreach ($stock_details as $stock_detail) {
                                ?>
                                <tr>
                                    <td><?= $stock_detail->item_code; ?></td>
                                    <td><?= $stock_detail->item_name; ?></td>
                                    <td><?= $stock_detail->qty ?></td>
                                    <td><?= $stock_detail->item_cost; ?></td>
                                    <td><?= $stock_detail->total_cost; ?></td>
                                </tr>
                                <?php
                                $qty_total += $stock_detail->qty;
                                $line_total += $stock_detail->total_cost;
                            }
                            ?>
                            <tr>
                                <td colspan="2">TOTAL</td>
                                <td><?= sprintf('%0.2f', $qty_total); ?></td>
                                <td></td>
                                <td><?= sprintf('%0.2f', $line_total); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


