<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
use common\models\StaffInfo;
use yii\widgets\LinkPager;
?>

<table id="example-11" class="table table-striped table-bordered staff-search-results" cellspacing="0" width="100%">
        <thead>
                <tr>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Designation</th>
                        <th>Experience</th>
                        <th>Rating</th>
                        <th>Action</th>
                </tr>
        </thead>
        <tbody style="height: 230px;overflow-y: auto;">


                <?php
                $l = 0;

                foreach ($result as $value) {
                        $l++;
                        if (isset($value->designation) && $value->designation != '') {
                                $designation = explode(',', $value->designation);
                                $designations = '';
                                $i = 0;
                                if (!empty($designation)) {
                                        foreach ($designation as $des) {

                                                if ($i != 0) {
                                                        $designations .= ',';
                                                }
                                                $designation_name = MasterDesignations::findOne($des);
                                                $designations .= $designation_name->title;
                                                $i++;
                                        }
                                }
                        }
                        ?>
                        <tr>
                                <td><?= $value->staff_name; ?></td>
                                <td><?= $value->contact_no; ?></td>
                                <td><?= $designations; ?></td>
                                <td><?= $value->years_of_experience; ?></td>
                                <td><?= $value->average_point; ?></td>
                                <td><input type="radio" name="staff_choose" id="<?= $value->id; ?>" class="cbr cbr-secondary staff-choose" value="<?= $value->id; ?>"></td>
                        </tr>

                        <?php
                }
                ?>
        <input type="hidden" name="service_id" value="<?= $service_id; ?>" id="choose_service_id">

        </tbody>
</table>

