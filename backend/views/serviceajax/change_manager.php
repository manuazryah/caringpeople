<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
?>


<div class="modal-content " >

        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Change Staff Manager</h4>
        </div>

        <div class="modal-body">
                <div class="row clearfix">
                        <form id="change-staff-manager" >

                                <input type="hidden" name="service_id" id="service_id" value="<?= $service->id ?>">


                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label><b>Choose Staff Manager       :</b></label>
                                                </div>

                                                <div class="col-md-6">
                                                        <?php $mangers = \common\models\StaffInfo::find()->where(['branch_id' => $service->branch_id, 'status' => 1, 'post_id' => 6])->orWhere(['post_id' => 1])->orWhere(['post_id' => 10])->orderBy(['staff_name' => SORT_ASC])->all(); ?>
                                                        <select name="service_staff_amanger" id="service-staff-amanger" class="form-control" required>
                                                                <option value="">-Select-</option>
                                                                <?php
                                                                foreach ($mangers as $mangers) {
                                                                        echo "<option value='" . $mangers->id . "'>" . $mangers->staff_name . "</option>";
                                                                }
                                                                ?>
                                                        </select>
                                                </div>

                                                <div class="col-md-6">
                                                </div>

                                                <div class="col-md-6">
                                                        <input type="submit" name="submitf" id="submitf" class="btn btn-primary" style="float: right;margin-top: 10px;">
                                                </div>


                                        </div>
                                </div>





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




