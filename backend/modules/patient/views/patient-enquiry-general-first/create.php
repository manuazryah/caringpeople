<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PatientEnquiryGeneralFirst */

$this->title = 'Create Patient Enquiry General First';
$this->params['breadcrumbs'][] = ['label' => 'Patient Enquiry General Firsts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>
                        <div class="panel-body">
                                <?=  Html::a('<i class="fa-th-list"></i><span> Manage Patient Enquiry General First</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="patient-enquiry-general-first-create">
                                                <?= $this->render('_form', [
                                                'model' => $model,
                                                ]) ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
                
