<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Internment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="internment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'operator_id')->textInput() ?>

    <?= $form->field($model, 'number_form_assigned_operator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provider_form_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authorization_date')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expiry_date_password')->textInput() ?>

    <?= $form->field($model, 'patient_id')->textInput() ?>

    <?= $form->field($model, 'hospital_applicant_id')->textInput() ?>

    <?= $form->field($model, 'professional_id')->textInput() ?>

    <?= $form->field($model, 'hospital_requested_id')->textInput() ?>

    <?= $form->field($model, 'suggested_hospitalization_date')->textInput() ?>

    <?= $form->field($model, 'service_character')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'regime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity_daily_requested')->textInput() ?>

    <?= $form->field($model, 'opme_usage_forecast')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chemotherapy_usage_forecast')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clinical_indication')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cid10_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cid10_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cid10_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cid10_4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accident_indication')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hospital_admission_date')->textInput() ?>

    <?= $form->field($model, 'quantity_daily_authorized')->textInput() ?>

    <?= $form->field($model, 'authorized_accommodation_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hospital_authorized_id')->textInput() ?>

    <?= $form->field($model, 'cnes_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'request_date')->textInput() ?>
    <br/>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
