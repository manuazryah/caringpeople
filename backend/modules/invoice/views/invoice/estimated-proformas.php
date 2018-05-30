<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\StaffInfo;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estimated Pro Forma Details';
$this->params['breadcrumbs'][] = $this->title;
$designations = \common\models\MasterDesignations::designationlist();
?>
<div class="service-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">

                                        <div style="float: right">
                                                <?php
                                                $_SESSION['page_size'] = $pagesize;
                                                ?>
                                                <?= Html::beginForm() ?>

                                                <label style="float: left">Show
                                                        <?= Html::dropDownList('size', $pagesize, ['20' => '20', '50' => '50', '100' => '100'], ['class' => 'page-size-dropdwn', 'id' => 'size']); ?>
                                                        Entries
                                                </label>
                                                <input type="hidden" name="page-hidden" value="<?= $pagesize ?>">

                                                <?= Html::endForm() ?>

                                        </div>

                                        <div style="clear: both"></div>

                                        <div>
                                                <?php
                                                $gridColumns = [
                                                        ['class' => 'yii\grid\SerialColumn'],
                                                        [
                                                        'attribute' => 'service_id',
                                                        'format' => 'raw',
                                                        'value' => function ($data) {
                                                                return \yii\helpers\Html::a($data->service_id, ['/services/service/update', 'id' => $data->id], ['target' => '_blank']);
                                                        },
                                                    ],
                                                        [
                                                        'attribute' => 'patient_id',
                                                        'value' => 'patient.first_name',
                                                        'filter' => ArrayHelper::map(common\models\PatientGeneral::find()->where(['status' => '1'])->orderBy(['first_name' => SORT_ASC])->asArray()->all(), 'id', 'first_name'),
                                                        'filterOptions' => array('id' => "patient_name_search"),
                                                    ],
                                                        [
                                                        'attribute' => 'service',
                                                        'value' => 'service0.service_name',
                                                        'filter' => ArrayHelper::map(common\models\MasterServiceTypes::find()->where(['status' => '1'])->orderBy(['service_name' => SORT_ASC])->asArray()->all(), 'id', 'service_name'),
                                                    ],
                                                        [
                                                        'attribute' => 'branch_id',
                                                        'value' => 'branch.branch_name',
                                                        'filter' => ArrayHelper::map(common\models\Branch::find()->where(['status' => '1'])->asArray()->all(), 'id', 'branch_name'),
                                                    ],
                                                        [
                                                        'attribute' => 'proforma_sent',
                                                        'header' => 'Send Proforma',
                                                        'format' => 'raw',
                                                        'value' => function($model) {
                                                                if ($model->proforma_sent == 1) {
                                                                        return '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                                                } else if ($model->proforma_sent == 2) {
                                                                        return '<i class="fa fa-check" aria-hidden="true" style="color:green"></i>';
                                                                } else {
                                                                        return '';
                                                                }
                                                        },
                                                        'filter' => [2 => 'Send', 1 => 'Not Send']
                                                    ],
                                                ];


                                                echo \kartik\grid\GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => $gridColumns,
                                                ]);
                                                ?>

                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

<script>
        $(document).ready(function () {
                $('#staff_name_search select').attr('id', 'staff_name');
                $('#patient_name_search select').attr('id', 'patient_name');
                $("#staff_name").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                $("#patient_name").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });


                $('#grid-id').change(function (e) {
                        e.preventDefault();
                        return false;
                });

                $('#size').change(function () {
                        //var d = $('#size :selected').val();
                        this.form.submit();

                });

        });
</script>

<style>
        #patient_name_search{
                width: 17%;
        }.amount_paid{
                background-color: #ddefdd !important;
        }.page-size-dropdwn{
                height: 30px !important;
                line-height: 30px;
                font-size: 13px;
                display: inline-block;
                padding: 0px 0px 0px 7px;
        }.other_amount{
                background-color: #faeae9 !important;
        }
</style>



