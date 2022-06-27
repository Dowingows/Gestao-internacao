<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DiagnosticSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diagnostic-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'operator_id') ?>

    <?= $form->field($model, 'accident_indication') ?>

    <?= $form->field($model, 'ans_code') ?>

    <?= $form->field($model, 'number_form_main') ?>

    <?php // echo $form->field($model, 'authorization_date') ?>

    <?php // echo $form->field($model, 'expiry_date_password') ?>

    <?php // echo $form->field($model, 'number_form_assigned_operator') ?>

    <?php // echo $form->field($model, 'patient_id') ?>

    <?php // echo $form->field($model, 'professional_id') ?>

    <?php // echo $form->field($model, 'service_character') ?>

    <?php // echo $form->field($model, 'request_date') ?>

    <?php // echo $form->field($model, 'clinical_indication') ?>

    <?php // echo $form->field($model, 'contractor_name') ?>

    <?php // echo $form->field($model, 'contracted_operator_code') ?>

    <?php // echo $form->field($model, 'executor_contractor_name') ?>

    <?php // echo $form->field($model, 'cod_operator_executing') ?>

    <?php // echo $form->field($model, 'service_type') ?>

    <?php // echo $form->field($model, 'type_medical_appointment') ?>

    <?php // echo $form->field($model, 'provider_form_number') ?>

    <?php // echo $form->field($model, 'reason_closing_service') ?>

    <?php // echo $form->field($model, 'contractor_applicant_id') ?>

    <?php // echo $form->field($model, 'contractor_executor_id') ?>

    <?php // echo $form->field($model, 'note') ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
