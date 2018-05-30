<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
?>


<div class="modal-content " >

        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">ADD REMARKS</h4>
        </div>

        <div class="modal-body">
                <div class="row clearfix">
                        <form id="add-remarks" >

                                <input type="hidden" name="scheduleid" id="scheduleid" value="<?= $schedule_id ?>">

                                <?php
                                $service_schedule = common\models\ServiceSchedule::findOne($schedule_id);
                                $service = common\models\Service::findOne($service_schedule->service_id);
                                ?>
                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label>Remarks:</label>
                                                </div>

                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">

                                                <textarea id="ckeditor" class="remarks_patient" name="remarks_patient">
                                                        <?php
                                                        if (!empty($service_schedule->remarks_from_patient)) {
                                                                echo $service_schedule->remarks_from_patient;
                                                        }
                                                        ?>

                                                </textarea>
                                        </div>
                                </div>




                                <input type="submit" name="submitf" id="submitf" class="btn btn-primary" style="float: right;margin-top: 10px;">

                        </form>
                </div>
        </div>


</div>


<style>
        .fields{
                width:100%;
        }
        .row{
                margin-bottom: 10px;
        }

</style>




<script src="<?= Yii::$app->homeUrl; ?>admin/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
        CKEDITOR.addCss('h3{font-weight:bold;}');
        CKEDITOR.addCss('h3{text-decoration:underline;}');
        CKEDITOR.replace('ckeditor',
                {
                        toolbar: 'Basic', /* this does the magic */
                        height: '150px',

                });
</script>

