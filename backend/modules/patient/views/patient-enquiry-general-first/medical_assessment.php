<?php

use yii\helpers\Html;
use common\models\StaffExperienceList;

/* @var $this yii\web\View */
/* @var $patient_assessment common\models\PatientBystanderDetails */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
       
</style>
<div class="patient-bystander-details-form form-inline">

        <h4 style="color:#000;font-style: italic;font-weight: bold;">Medical Assessment</h4>
        <hr class="enquiry-hr"/>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('skin_condition'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'skin_condition')->checkbox(['label' => 'Intact', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'skin_condition')->checkbox(['label' => 'Redness', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'skin_condition')->checkbox(['label' => 'Decubitus ulcer', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'skin_condition')->checkbox(['label' => 'Excoriation', 'value' => 4, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('diabetic'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'diabetic')->checkbox(['label' => 'Insulin', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'diabetic')->checkbox(['label' => 'Oral hypoglycemic', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'diabetic')->checkbox(['label' => 'Diet Controlled', 'value' => 3, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('behaviour'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'behaviour')->checkbox(['label' => 'Compliant to care', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'behaviour')->checkbox(['label' => 'Anxious', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'behaviour')->checkbox(['label' => 'Restless', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'behaviour')->checkbox(['label' => 'Agitated', 'value' => 4, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('aggression'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'aggression')->checkbox(['label' => 'Verbal', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'aggression')->checkbox(['label' => 'Physical', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'aggression')->checkbox(['label' => 'Sexual', 'value' => 3, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('inappropriateness'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'inappropriateness')->checkbox(['label' => 'Verbal', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'inappropriateness')->checkbox(['label' => 'Social', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'inappropriateness')->checkbox(['label' => 'Sexual', 'value' => 3, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('abuse'); ?></div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'abuse')->checkbox(['label' => 'History of being abused', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'abuse')->checkbox(['label' => 'History of being abusive', 'value' => 2, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('risks'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'risks')->checkbox(['label' => 'Elopement', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'risks')->checkbox(['label' => 'Falls', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'risks')->checkbox(['label' => 'Aggression', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'risks')->checkbox(['label' => 'Choking', 'value' => 4, 'uncheck' => null]) ?></div>
        </div>

        <div class="row left_padd">
                <?= $form->field($medical_assessment, 'social_concerns')->textarea(['rows' => 2]) ?>
        </div>


        <h4 style="color:#000;font-style: italic;font-weight: bold;">Functional Status</h4>
        <hr class="enquiry-hr"/>


        <div class="row">
                <div class="col-md-6">
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('transferring'); ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'transferring')->checkbox(['label' => 'Self', 'value' => 1, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'transferring')->checkbox(['label' => 'Assist', 'value' => 2, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'transferring')->checkbox(['label' => 'Total care', 'value' => 3, 'uncheck' => null]) ?></div>
                </div>

                <div class="col-md-6">
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('feeding_1'); ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'feeding_1')->checkbox(['label' => 'Self', 'value' => 1, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'feeding_1')->checkbox(['label' => 'Assist', 'value' => 2, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'feeding_1')->checkbox(['label' => 'Total care', 'value' => 3, 'uncheck' => null]) ?></div>
                </div>

        </div>

        <div class="row">
                <div class="col-md-6">
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('appetite'); ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'appetite')->checkbox(['label' => 'Good', 'value' => 1, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'appetite')->checkbox(['label' => 'Fair', 'value' => 2, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'appetite')->checkbox(['label' => 'Poor', 'value' => 3, 'uncheck' => null]) ?></div>
                </div>

                <div class="col-md-6">
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('bathing'); ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bathing')->checkbox(['label' => 'Self', 'value' => 1, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bathing')->checkbox(['label' => 'Assist', 'value' => 2, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bathing')->checkbox(['label' => 'Bed', 'value' => 3, 'uncheck' => null]) ?></div>
                </div>

        </div>

        <div class="row">
                <div class="col-md-6">
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('meal_prep'); ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'meal_prep')->checkbox(['label' => 'Self', 'value' => 1, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'meal_prep')->checkbox(['label' => 'Assist', 'value' => 2, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'meal_prep')->checkbox(['label' => 'Total care', 'value' => 3, 'uncheck' => null]) ?></div>
                </div>

                <div class="col-md-6">
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('housework'); ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'housework')->checkbox(['label' => 'Self', 'value' => 1, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'housework')->checkbox(['label' => 'Assist', 'value' => 2, 'uncheck' => null]) ?></div>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'housework')->checkbox(['label' => 'Total care', 'value' => 3, 'uncheck' => null]) ?></div>
                </div>

        </div>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('toiletting'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'toiletting')->checkbox(['label' => 'Self', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'toiletting')->checkbox(['label' => 'assist', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'toiletting')->checkbox(['label' => 'Incontinent', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'toiletting')->checkbox(['label' => 'Bladder', 'value' => 4, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'toiletting')->checkbox(['label' => 'Bowel', 'value' => 5, 'uncheck' => null]) ?></div>

        </div>

        <div class="row">
                <?= $form->field($medical_assessment, 'notes')->textarea(['rows' => 2]) ?>
        </div>

        <h4 style="color:#000;font-style: italic;font-weight: bold;">Sensory Perception</h4>
        <hr class="enquiry-hr"/>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('vision'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'vision')->checkbox(['label' => 'Normal', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'vision')->checkbox(['label' => 'Impaired', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'vision')->checkbox(['label' => 'Blind', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'vision')->checkbox(['label' => 'Contacts', 'value' => 4, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'vision')->checkbox(['label' => 'Glasses', 'value' => 5, 'uncheck' => null]) ?></div>
        </div>


        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('hearing'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'hearing')->checkbox(['label' => 'Normal', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'hearing')->checkbox(['label' => 'Impaired', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'hearing')->checkbox(['label' => 'Deaf', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'hearing')->checkbox(['label' => 'Hearing Aid', 'value' => 4, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('speech'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'speech')->checkbox(['label' => 'Normal', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'speech')->checkbox(['label' => 'Impaired', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'speech')->checkbox(['label' => 'Aphasic', 'value' => 3, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('literacy'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'literacy')->checkbox(['label' => 'Literate', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'literacy')->checkbox(['label' => 'Illiterate', 'value' => 2, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('pain'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'pain')->checkbox(['label' => 'None', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'pain')->checkbox(['label' => 'Acute', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'pain')->checkbox(['label' => 'Chronic', 'value' => 3, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <?= $form->field($medical_assessment, 'sensory_notes')->textarea(['rows' => 2]) ?>
        </div>

        <h4 style="color:#000;font-style: italic;font-weight: bold;">Activity</h4>
        <hr class="enquiry-hr"/>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('mobility'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'mobility')->checkbox(['label' => 'Independent', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'mobility')->checkbox(['label' => 'Bedridden', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'mobility')->checkbox(['label' => 'Assistance Required', 'value' => 3, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('assistive_devices'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'assistive_devices')->checkbox(['label' => 'Mechanical Lifts', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'assistive_devices')->checkbox(['label' => 'Walker', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'assistive_devices')->checkbox(['label' => 'Cane ', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'assistive_devices')->checkbox(['label' => 'Crutches ', 'value' => 4, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'assistive_devices')->checkbox(['label' => 'Wheelchair ', 'value' => 5, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'assistive_devices')->checkbox(['label' => 'Prosthetics ', 'value' => 6, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'assistive_devices')->checkbox(['label' => 'Leg Brace ', 'value' => 7, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'assistive_devices')->checkbox(['label' => 'Neck Brace ', 'value' => 8, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'assistive_devices')->checkbox(['label' => 'Haering Aid ', 'value' => 9, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('limbs'); ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> Upper Limbs :</div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'limbs')->checkbox(['label' => 'Normal', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'limbs')->checkbox(['label' => 'Impairment ( R/L )', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'limbs')->checkbox(['label' => 'Tremor ( R/L )', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'limbs')->checkbox(['label' => 'Amputation ( R/L )', 'value' => 4, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'limbs')->checkbox(['label' => 'Prosthesis ', 'value' => 5, 'uncheck' => null]) ?></div>
                <div style="clear:both"></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> </div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> Lower Limbs :</div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'limbs')->checkbox(['label' => 'Normal', 'value' => 6, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'limbs')->checkbox(['label' => 'Impairment ( R/L )', 'value' => 7, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'limbs')->checkbox(['label' => 'Tremor ( R/L )', 'value' => 8, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'limbs')->checkbox(['label' => 'Amputation ( R/L )', 'value' => 9, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'limbs')->checkbox(['label' => 'Prosthesis ', 'value' => 10, 'uncheck' => null]) ?></div>

        </div>

        <div class="row">
                <?= $form->field($medical_assessment, 'activity_notes')->textarea(['rows' => 2]) ?>
        </div>

        <h4 style="color:#000;font-style: italic;font-weight: bold;">Nutrirtion</h4>
        <hr class="enquiry-hr"/>


        <div class="row">
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> Nutritional Status</div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>  <?= $form->field($medical_assessment, 'height')->textInput(['placeholder' => 'Height'])->label(FALSE) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>  <?= $form->field($medical_assessment, 'weight')->textInput(['placeholder' => 'Weight'])->label(FALSE) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>  <?= $form->field($medical_assessment, 'on_date')->textInput(['placeholder' => 'On'])->label(FALSE) ?></div>
        </div>

        <div class="row">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('mouth'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'mouth')->checkbox(['label' => 'Own Teeth', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'mouth')->checkbox(['label' => 'Partial', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'mouth')->checkbox(['label' => 'Dentures ( Up/Low )', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'mouth')->checkbox(['label' => 'No Teeth', 'value' => 4, 'uncheck' => null]) ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'mouth')->checkbox(['label' => 'Ulcers ', 'value' => 5, 'uncheck' => null]) ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'mouth')->checkbox(['label' => 'Infection ', 'value' => 6, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'mouth')->checkbox(['label' => 'Drooling ', 'value' => 7, 'uncheck' => null]) ?></div>
        </div>
        <div class="row">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('feeding'); ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'feeding')->checkbox(['label' => 'Independent', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'feeding')->checkbox(['label' => 'Supervision', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'feeding')->checkbox(['label' => 'Assistance', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'feeding')->checkbox(['label' => 'Total Feed', 'value' => 4, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'feeding')->checkbox(['label' => 'Chocking Problem', 'value' => 5, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'feeding')->checkbox(['label' => 'Swallowing Problem', 'value' => 6, 'uncheck' => null]) ?></div>
        </div>

        <div class="row">
                <div class="col-md-6">
                        <?= $form->field($medical_assessment, 'diet')->textInput() ?>
                </div>
                <div class="col-md-6">
                        <?= $form->field($medical_assessment, 'supplement')->textInput() ?>
                </div>
        </div>

        <div class="row">
                <?= $form->field($medical_assessment, 'nutrition_notes')->textarea(['rows' => 2]) ?>
        </div>

        <h4 style="color:#000;font-style: italic;font-weight: bold;">Elimination</h4>
        <hr class="enquiry-hr"/>

        <div class="row">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('bladder'); ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bladder')->checkbox(['label' => 'Continent', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bladder')->checkbox(['label' => 'Incontinent', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bladder')->checkbox(['label' => 'Noctuna', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bladder')->checkbox(['label' => 'Type and Size', 'value' => 4, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'type_size')->textInput()->label(FALSE) ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bladder')->checkbox(['label' => 'Insertion date', 'value' => 5, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'insertion_date')->textInput()->label(FALSE) ?></div>
                <div style="clear:both"></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bladder')->checkbox(['label' => 'In & Out Catheterization', 'value' => 6, 'uncheck' => null]) ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bladder')->checkbox(['label' => 'Type and Size', 'value' => 7, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'type_size_1')->textInput()->label(FALSE) ?></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bladder')->checkbox(['label' => 'Insertion date', 'value' => 8, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'insertion_date_1')->textInput()->label(FALSE) ?></div>

        </div>

        <div class="row">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> <?= $medical_assessment->getAttributeLabel('bowels'); ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Continent', 'value' => 1, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Self Care', 'value' => 2, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Ostomy Care/Ostomy Type', 'value' => 3, 'uncheck' => null]) ?></div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'ostomy_type')->textInput()->label(FALSE) ?></div>
                <div style="clear:both"></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Incontinent', 'value' => 4, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Assist', 'value' => 5, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Date to be changed', 'value' => 6, 'uncheck' => null]) ?></div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'date_changed')->textInput()->label(FALSE) ?></div>
                <div style="clear:both"></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Constipation', 'value' => 7, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Total Care', 'value' => 8, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Mushrrom Catheter Date Inserted', 'value' => 9, 'uncheck' => null]) ?></div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'mushrrom_catheter')->textInput()->label(FALSE) ?></div>
                <div style="clear:both"></div>
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd'> </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Diarrhea', 'value' => 10, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Difficile', 'value' => 11, 'uncheck' => null]) ?></div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'bowels')->checkbox(['label' => 'Type and Size', 'value' => 12, 'uncheck' => null]) ?></div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?= $form->field($medical_assessment, 'type_size_2')->textInput()->label(FALSE) ?></div>
        </div>

   <div class="row">
                <?= $form->field($medical_assessment, 'primary_diagnoses')->textarea(['rows' => 2]) ?>
        </div>

</div>

<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?php if ($patient_assessment->isNewRecord) { ?>
                        <?= Html::submitButton($patient_assessment->isNewRecord ? 'Create' : 'Update', ['class' => $patient_assessment->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>
                        <?php
                } else {
                        ?>
                        <?= Html::submitButton($patient_assessment->isNewRecord ? 'Create' : 'Update', ['class' => $patient_assessment->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button', 'name' => 'update_button']) ?>
                        <?php if (!$patient_info->isNewRecord && $patient_info->status != 3) { ?>
                                <?= Html::submitButton('Proceed to Patient', ['class' => 'btn btn-primary', 'style' => 'margin-top: 18px;height: 36px; width: auto;', 'name' => 'patinet_info']) ?>
                                <?php
                        }
                }
                ?>
        </div>
</div>



<style>
        /* .squaredFour */
        .squaredFour {
                width: 20px;
                position: relative;
                margin: 20px auto;
                label {
                        width: 20px;
                        height: 20px;
                        cursor: pointer;
                        position: absolute;
                        top: 0;
                        left: 0;
                        background: #fcfff4;
                        background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
                        border-radius: 4px;
                        box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
                        &:after {
                                content: '';
                                width: 9px;
                                height: 5px;
                                position: absolute;
                                top: 4px;
                                left: 4px;
                                border: 3px solid #333;
                                border-top: none;
                                border-right: none;
                                background: transparent;
                                opacity: 0;
                                transform: rotate(-45deg);
                        }
                        &:hover::after {
                                opacity: 0.5;
                        }
                }
                input[type=checkbox] {
                        visibility: hidden;
                        &:checked + label:after {
                                opacity: 1;
                        }
                }
        }
        /* end .squaredFour */

</style>