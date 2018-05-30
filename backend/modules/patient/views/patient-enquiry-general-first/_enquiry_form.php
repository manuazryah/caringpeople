<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Enquiries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enquiry-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                </div>

                <?= Html::a('<i class="fa-th-list"></i><span> Manage Enquiry</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top:10px']) ?>


                <?=
                $this->render('_main_menus', [
                    'model' => $patient_info,
                ])
                ?>


                <div class="panel-body panel_body_background">
                    <div class="tab-content tab_data_margin">
                        <div class="tab-pane active" id="main-1">
                            <?=
                            $this->render('_sub_menu_1', [
                            ])
                            ?>

                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'form']]); ?>
                            <div class="tab-content second-tab">
                                <div class="tab-pane active" id="home-4">
                                    <?=
                                    $this->render('enquiry_general_form', [
                                        'patient_info' => $patient_info,
                                        'patient_info_second' => $patient_info_second,
                                        'form' => $form,
                                    ])
                                    ?>
                                </div>
                                <div class="tab-pane" id="profile-4">
                                    <?=
                                    $this->render('enquiry_hospital_form', [
                                        'patient_hospital' => $patient_hospital,
                                        'patient_hospital_second' => $patient_hospital_second,
                                        'hospital_details' => $hospital_details,
                                        'patient_info' => $patient_info,
                                        'form' => $form,
                                    ])
                                    ?>
                                </div>

                                <div class="tab-pane" id="assesment">
                                    <?=
                                    $this->render('_patient_assessment', [
                                        'patient_info' => $patient_info,
                                        'patient_assessment'=>$patient_assessment,
                                        'form' => $form,
                                    ])
                                    ?>
                                </div>


                                <div class="tab-pane" id="mediacl_assesment">
                                                                        <?=
                                                                        $this->render('medical_assessment', [
                                                                            'patient_info' => $patient_info,
                                                                            'medical_assessment' => $medical_assessment,
                                                                            'form' => $form,
                                                                        ])
                                                                        ?>
                                 </div>


                            </div>
                            <?php ActiveForm::end(); ?>


                        </div>
                        <div class="tab-pane" id="main-2">
                            <?=
                            $this->render('_sub_menu_2', [
                            ])
                            ?>


                            <div class="tab-content">
                                <div class="tab-pane active" id="home-12">
                                    <?=
                                    $this->render('remarks', [
                                        'patient_info' => $patient_info,
                                        'type' => 1,
                                    ])
                                    ?>
                                </div>
                                <div class="tab-pane" id="profile-13">
                                    <?=
                                    $this->render('followups', [
                                        'patient_info' => $patient_info,
                                        'type' => 1,
                                    ])
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<script>
        var submitted = false;
        $('#form').submit(function () {
                submitted = true;
        });

        $('#form').data('serialize', $('#form').serialize());
        $(window).bind('beforeunload', function (e) {
                if ($('#form').serialize() != $('#form').data('serialize') && !submitted)
                        return true;
                else
                        e = null;
        });
</script>

