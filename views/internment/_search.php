<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InternmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="internment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'operator_id') ?>

    <?= $form->field($model, 'number_form_assigned_operator') ?>

    <?= $form->field($model, 'provider_form_number') ?>

    <?= $form->field($model, 'authorization_date') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'expiry_date_password') ?>

    <?php // echo $form->field($model, 'patient_id') ?>

    <?php // echo $form->field($model, 'hospital_applicant_id') ?>

    <?php // echo $form->field($model, 'professional_id') ?>

    <?php // echo $form->field($model, 'hospital_requested_id') ?>

    <?php // echo $form->field($model, 'suggested_hospitalization_date') ?>

    <?php // echo $form->field($model, 'service_character') ?>

    <?php // echo $form->field($model, 'regime') ?>

    <?php // echo $form->field($model, 'quantity_daily_requested') ?>

    <?php // echo $form->field($model, 'opme_usage_forecast') ?>

    <?php // echo $form->field($model, 'chemotherapy_usage_forecast') ?>

    <?php // echo $form->field($model, 'clinical_indication') ?>

    <?php // echo $form->field($model, 'cid10_1') ?>

    <?php // echo $form->field($model, 'cid10_2') ?>

    <?php // echo $form->field($model, 'cid10_3') ?>

    <?php // echo $form->field($model, 'cid10_4') ?>

    <?php // echo $form->field($model, 'accident_indication') ?>

    <?php // echo $form->field($model, 'hospital_admission_date') ?>

    <?php // echo $form->field($model, 'quantity_daily_authorized') ?>

    <?php // echo $form->field($model, 'authorized_accommodation_type') ?>

    <?php // echo $form->field($model, 'hospital_authorized_id') ?>

    <?php // echo $form->field($model, 'cnes_code') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'request_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
