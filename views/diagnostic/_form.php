<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Diagnostic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diagnostic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'operator_id')->textInput() ?>

    <?= $form->field($model, 'accident_indication')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ans_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_form_main')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authorization_date')->textInput() ?>

    <?= $form->field($model, 'expiry_date_password')->textInput() ?>

    <?= $form->field($model, 'number_form_assigned_operator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_id')->textInput() ?>

    <?= $form->field($model, 'professional_id')->textInput() ?>

    <?= $form->field($model, 'service_character')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_date')->textInput() ?>

    <?= $form->field($model, 'clinical_indication')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contractor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contracted_operator_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'executor_contractor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_operator_executing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_medical_appointment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provider_form_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reason_closing_service')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contractor_applicant_id')->textInput() ?>

    <?= $form->field($model, 'contractor_executor_id')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
    <br/>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
