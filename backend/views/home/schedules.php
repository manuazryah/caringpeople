
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Branch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Doctor;
use common\models\Location;
use common\models\Pro;
use yii\widgets\ListView;
?>
<style>
        .fa-ban:before {
                content: "\f05e";
                font-size: 20px;
        }
</style>
<section id="login-box">
        <div class="container">
                <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 shadow">
                                <h3 style="text-align:center;text-decoration: underline;color:#e26c04">Schedules</h3>
                                <section id="notification">
                                        <div class="container">
                                                <div class="row">
                                                        <?php
                                                        echo ListView::widget([
                                                            'dataProvider' => $dataProvider,
                                                            'itemView' => '_list_schedules',
                                                        ]);
                                                        ?>
                                                </div>
                                        </div>
                                </section>
                        </div>
                        <div class="col-md-3"></div>
                </div>
        </div>
</section>

<style>
        .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
                border: 1px solid #ddd;
                text-align: center;
        }
        .fa-globe:before {
                content: "\f0ac";
                font-size: 20px;
        }
        .remarks{
                cursor: pointer;
                float: right;
                text-decoration: none !important;
        }
</style>


<script>
        $(document).ready(function () {
                $('.remarks_Staff').click(function () {
                        var schedule_id = $(this).attr('id');
                        $.ajax({
                                type: 'POST',
                                url: homeUrl + 'serviceajax/staffremarks',
                                data: {schedule_id: schedule_id},
                                success: function (data) {
                                        $("#modal-pop-up").html(data);
                                        $('#modal-6').modal('show', {backdrop: 'static'});
                                }
                        });
                });

                $(document).on('submit', '#staff-remarks', function (e) {
                        e.preventDefault();
                        var data = $(this).serialize();
                        $.ajax({
                                type: 'POST',
                                url: homeUrl + 'serviceajax/updatestaffremarks',
                                data: data,
                                success: function (data) {
                                        $('#modal-2').modal('hide');
                                        location.reload();
                                }
                        });
                });
        });
</script>