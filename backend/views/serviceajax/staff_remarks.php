<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
?>


<div class="modal-content " >

        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Remarks</h4>
        </div>

        <div class="modal-body">
                <div class="row clearfix">
                        <form id="staff-remarks" >

                                <input type="hidden" name="service_id" id="service_id" value="<?= $schedule_id ?>">

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">

                                                <textarea id="ckeditor1" name="remarks_staff">

                                                        <?php
                                                        $schedule = \common\models\ServiceSchedule::findOne($schedule_id);
                                                        if (!empty($schedule->remarks_from_staff)) {
                                                                echo $schedule->remarks_from_staff;
                                                        } else {
                                                                ?>
                                                                                                                <h3 style="font-weight:bold!important">Notes (patient daignosis and findings) </h3>
                                                                                                                                                                                        <br><br>
                                                                                                                                                                                        <h3 style="font-weight:bold!important">Medication Advice </h3>
                                                                                                                                                                                        <br><br>
                                                                                                                                                                                        <h3 style="font-weight:bold!important">Lab test advice  </h3>
                                                                                                                                                                                        <br><br>
                                                                                                                                                                                        <h3 style="font-weight:bold!important">Prescription   </h3>
                                                                <?php
                                                        }
                                                        ?>
                                                </textarea>



                                                <div class="col-md-12">
                                                        <input type="submit" name="submitf" id="submitf" class="btn btn-primary" style="float: right;margin-top: 10px;">
                                                </div>


                                        </div>
                                </div>

                        </form>
                </div>
        </div>


</div>

<script src="<?= Yii::$app->homeUrl; ?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
        CKEDITOR.addCss('h3{font-weight:bold;}');
        CKEDITOR.addCss('h3{text-decoration:underline;}');
        CKEDITOR.replace('ckeditor1',
                {
                        toolbar: 'Basic', /* this does the magic */
                        height: '200px',
                });

</script>


<style>
        .fields{
                width:100%;
        }
        .row{
                margin-bottom: 10px;
        }

</style>




