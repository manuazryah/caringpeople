<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
?>


<div class="modal-content " >

    <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Edit Service</h4>
    </div>

    <div class="modal-body">
        <div class="row clearfix">
            <form id="change-staff-manager" >

                <input type="hidden" name="service_id" id="service_id" value="<?= $service->id ?>">


                <div class="row">
                    <div class="col-md-12 col-sm-6 col-xs-12">
                        <?php
                        $gender_pref='';
                        $staff_manager='';
                        if (isset($service->gender_preference) && $service->gender_preference != '') {
                            $gender_pref = $service->gender_preference;
                        } 
                        if (isset($service->staff_manager) && $service->staff_manager != '') {
                            $staff_manager=$service->staff_manager;
                        }
                        ?>

                        <table style="width:95%;margin-left:10px;">
                            <tr>
                                <td><label><b>Staff Preference </b></label> </td>
                                <td>:</td>
                                <td>
                                    <select name="service-staff-prefernce" id="service-staff-prefernce" class="form-control" >
                                        <option value="0" <?php if($gender_pref==0){ echo 'selected';} ?>>Male</option>
                                        <option value="1" <?php if($gender_pref==1){ echo 'selected';} ?>>Female</option>
                                        <option value="2" <?php if($gender_pref==2){ echo 'selected';} ?>>Any</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label><b>Staff Manager </b></label>  </td>
                                <td>:</td>
                                <td>
                                    <?php $mangers = \common\models\StaffInfo::find()->where(['branch_id' => $service->branch_id, 'status' => 1, 'post_id' => 6])->orWhere(['post_id' => 1])->orWhere(['post_id' => 13])->orderBy(['staff_name' => SORT_ASC])->all(); ?>

                                    <select name="service_staff_amanger" id="service-staff-amanger" class="form-control" >
<option value=''>--Select--</option>
                                        <?php
                                        foreach ($mangers as $mangers) {
                                            $selected='';
                                            if($staff_manager==$mangers->id){
                                                $selected='selected';
                                            }
                                            echo "<option value='" . $mangers->id . "'".$selected.">" . $mangers->staff_name . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>



                            <tr>
                                                                <td><label><b>Client Notes </b></label> </td>
                                                                <td>:</td>
                                                                <td>
                                                                        <textarea class="form-control" rows="6" name="client_notes"><?= $service->client_notes ?></textarea>

                                                                </td>
                                                        </tr>


<?php if ($service->status == 2) { ?>
                              <tr>
                                                                <td><label><b>Status </b></label> </td>
                                                                <td>:</td>
                                                                <td>
                                                                        <select name="status" class="form-control">
                                                                                <option>--Select--</option>
                                                                                <option value="1" <?php
                                                                                if ($service->status == 1) {
                                                                                        echo 'selected';
                                                                                }
                                                                                ?>>Opened</option>
                                                                                <option value="2" <?php
                                                                                if ($service->status == 2) {
                                                                                        echo 'selected';
                                                                                }
                                                                                ?>>Closed</option>
                                                                                <option value="3" <?php
                                                                                if ($service->status == 3) {
                                                                                        echo 'selected';
                                                                                }
                                                                                ?>>Advanced</option>
                                                                        </select>

                                                                </td>
                                                        </tr>
<?php } ?>


                            <tr>
                                <td colspan="3">
                                    <input type="submit" name="submitf" id="submitf" class="btn btn-primary" style="float: right;margin-top: 10px;">

                                </td>
                            </tr>
                        </table>

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




