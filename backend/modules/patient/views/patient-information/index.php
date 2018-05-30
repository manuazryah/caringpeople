<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use common\models\Branch;

$branch = Branch::branch();

/* @var $this yii\web\View */
/* @var $searchModel common\models\PatientInformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-information-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                                                <div class="alert alert-danger" role="alert">
                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-success" role="alert">
                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>

                                        <a class="patient-advanced-search" style="font-size: 17px;color:#0e62c7;cursor: pointer;">Advanced Search</a>
                                        <hr class="appoint_history" style="margin-top:5px;"/>
                                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> New Patient </span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        
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

<?php
                                        $gridColumns = [
                                                ['class' => 'yii\grid\SerialColumn'],
                                            'patient_id',
                                            // 'first_name',
                                            // 'last_name',
                                            [
                                                'header' => 'Name',
                                                'attribute' => 'first_name',
                                                'value' => function($model, $key, $index, $column) {
                                                        return $model->first_name . " " . $model->last_name;
                                                },
                                            ],
                                            // 'contact_name',
                                            // 'contact_gender',
                                            // 'referral_source',
                                            // 'contact_mobile_number_1',
                                            // 'contact_mobile_number_2',
                                            // 'contact_mobile_number_3',
                                            // 'contact_city',
                                            // 'contact_zip_or_pc',
                                            // 'contact_email:email',
                                            // 'contact_perosn_relationship',
                                            // 'patient_name',
                                            // 'patient_gender',
                                            // 'patient_age',
                                            // 'patient_weight',
                                            // 'other_relationships',
                                            // 'veteran_or_spouse',
                                            // 'patient_address',
                                            // 'patient_city',
                                            // 'patient_postal_code',
                                            // 'patient_current_status',
                                            // 'follow_up_date',
                                            // 'notes:ntext',
                                            [
                                                'attribute' => 'status',
                                                'value' => function($model, $key, $index, $column) {
                                                        if ($model->status == '1') {
                                                                return 'Enabled';
                                                        } elseif ($model->status == '2') {
                                                                return 'Disabled';
                                                        } elseif ($model->status == '3') {
                                                                return 'Pending';
                                                        } elseif ($model->status == '4') {
                                                                return 'Deseased';
                                                        }
                                                },
                                                'filter' => [1 => 'Active', 2 => 'Closed', 3 => 'Pending', 4 => 'Deseased'],
                                                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'All'],
                                            ],
                                                [
                                                'attribute' => 'branch_id',
                                                'value' => function($data) {
                                                        return Branch::findOne($data->branch_id)->branch_name;
                                                },
                                                'filter' => ArrayHelper::map($branch, 'id', 'branch_name'),
                                            ],
                                            'average_point',
                                            // 'CB',
                                            // 'UB',
                                            // 'DOC',
                                            // 'DOU',
                                            ['class' => 'yii\grid\ActionColumn',
                                                'template' => '{view}{update}{delete}{missing}',
                                                'visibleButtons' => [
                                                    'delete' => function ($model, $key, $index) {
                                                            return Yii::$app->user->identity->post_id != '1' ? false : true;
                                                    }
                                                ],
                                                'buttons' => [
                                                    'missing' => function($url, $model, $key) {     // render your custom button
                                                       $checking = $model->check($model->id);
                                                            if ($checking == 1) {
                                                            return Html::a('<span class="fa fa-file-image-o" style="padding-top: 0px;"></span>', ['#'], [
                                                                        'title' => Yii::t('app', 'Missing Fileds/ Files'),
                                                                        'class' => 'actions missing-files',
                                                                        'type' => '1',
                                                                        'target' => '_blank',
                                                                        'id' => $model->id
                                                            ]);
                                                       }
                                                    },
                                                ]
                                            ],
                                        ];

                                        if (Yii::$app->user->identity->post_id == '1') {
                                                echo ExportMenu::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'columns' => $gridColumns,
                                                ]);
                                        }
                                        echo \kartik\grid\GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => $gridColumns
                                        ]);
                                        ?>


                                </div>
                        </div>
                </div>
        </div>
</div>


<script>
        $(document).ready(function () {
                $('.patient-advanced-search-form').hide();
                $('.patient-advanced-search').click(function () {
                        $('.patient-advanced-search-form').slideToggle();
                });
        });
</script>

