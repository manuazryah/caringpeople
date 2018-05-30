
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
                                <h3 style="text-align:center;text-decoration: underline;color:#e26c04">My Tasks</h3>
                                <section id="notification">
                                        <div class="container">
                                                <div class="row">
                                                        <?php
                                                        echo ListView::widget([
                                                            'dataProvider' => $dataProvider,
                                                            'itemView' => '_list_tasks',
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
</style>

<script>
        $(document).ready(function () {
                $(document).on('click', '.followup-status', function (e) {

                        var followup_id = $(this).attr('id');
                        var type = '1';
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {followup_id: $(this).attr('id'), type: type},
                                url: homeUrl + 'followupajax/followupstatus',
                                success: function (data) {


                                        $('#' + followup_id).remove();
                                }
                        });
                });
        })
</script>
