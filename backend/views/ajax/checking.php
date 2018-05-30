<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
use common\models\PatientGeneral;
use common\models\PatientGuardianDetails;
?>


<div class="modal-content " >

        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Profile Missing Datas/Files</h4>
        </div>

        <div class="modal-body">
                <div class="row clearfix">




                        <div class="row">
                                <div class="col-md-12">
                                        <?php
                                        if (count($not_uploaded) > 0) {
                                                foreach ($not_uploaded as $value) {

                                                        if (!empty($value)) {
                                                                ?>
                                                                <div class="col-md-6">
                                                                        <?= $value ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                        <spna style='color: red'>x</spna>
                                                                </div></br>
                                                                <?php
                                                        }
                                                }
                                        } else {
                                                echo 'No missing';
                                        }
                                        ?>
                                </div>

                        </div>


                </div>
        </div>


</div>





