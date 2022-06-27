<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Diagnostic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diagnostic-form">
    <br />
    <h3>Guia de Serviço Profissional/Serviço Auxiliar de Diagnóstico e Terápia- SP/SADT</h3>
    <?php $form = ActiveForm::begin(); ?>
    <div class="container ">
        <br/>
        <div class="row">
            <div class="col">
            <?php
            $operators = \app\models\Operator::find()->all();
            $list = ArrayHelper::map($operators, 'id', 'name');

            print $form->field($model, 'operator_id')->widget(Select2::classname(), [
                'data' => $list,
                'language' => 'pt',
                'options' => ['placeholder' => 'Selecione a operadora ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ]])->label('Operadora');
            ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'number_form_main')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'provider_form_number')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'authorization_date')->widget(DatePicker::className(), [
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'autoclose' => true
                ]]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'password')->textInput() ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'expiry_date_password')->widget(DatePicker::className(), [
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'autoclose' => true
                ]]); ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'number_form_assigned_operator')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row pt-3 pb-3">
            <div class="col">
                <h3>Beneficiário</h3>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <?php
                    $patients = \app\models\Patient::find()->all();
                    $list = ArrayHelper::map($patients, 'id', 'name');

                    print $form->field($model, 'patient_id')->widget(Select2::classname(), [
                        'data' => $list,
                        'language' => 'pt',
                        'options' => ['placeholder' => 'Selecione o paciente ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]])->label('Paciente');
                ?>
            </div>
        </div>

        <div class="row pt-3 pb-3">
            <div class="col">
                <h3>Dados do Contratado Soliciante</h3>
            </div>
        </div>



        <?= $form->field($model, 'accident_indication')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ans_code')->textInput(['maxlength' => true]) ?>





        <?= $form->field($model, 'expiry_date_password')->textInput() ?>



       

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

        <?= $form->field($model, 'reason_closing_service')->textInput(['maxlength' => true]) ?> <?= $form->field($model, 'contractor_applicant_id')->textInput() ?> <?= $form->field($model, 'contractor_executor_id')->textInput() ?> <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?> <br />
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>