<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Internment */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .highlight {
        background-color: #E9E9E9;
        padding: 20px;
        border-radius: 5px;
    }
</style>
<?php 

$fields = $model->dateFields;
foreach ($fields as $field) {
    if (isset($model->{$field})) {
        $model->{$field} = date('d/m/Y', strtotime($model->{$field}));
    }
}


?>
<div class="internment-form">
    <br />
    <h3>Informações da Ficha</h3>
    <hr/>
    <h4>Prorrogação da Ficha <span style="color:#B80000"><?= $parent->number_form_assigned_operator ?></span></h4>

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    
    <?= $form->field($parent, 'operator_id')->hiddenInput()->label(false); ?>
    <?= $form->field($parent, 'hospital_requested_id')->hiddenInput()->label(false); ?>
    <?= $form->field($parent, 'hospital_authorized_id')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'internment_id')->hiddenInput(['value' => $parent->id])->label(false) ?>

    <div class="container g-0 ">
        <br />
        <div class="highlight">
            <div class="row">
                <div class="col-3">
                    
                    <?= $form->field($parent->operator, 'ans_code')->textInput(['readonly' => true]) ?>


                </div>
                <div class="col">
                    <?= $form->field($parent, 'number_form_assigned_operator')->textInput(['readonly' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'provider_form_number')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'authorization_date')->widget(DatePicker::class, [
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]); ?>
                </div>
                <div class="col">
                    <?= $form->field($parent, 'password')->textInput(['maxlength' => true, ]) ?>
                </div>
                <div class="col">
                    
                    <?= $form->field($model, 'expiry_date_password')->widget(DatePicker::class, [
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="row pt-3 pb-3">
            <div class="col">
                <h3>Dados do Beneficiário</h3>
            </div>
        </div>
        <div class="highlight">
            <div class="row">
                <div class="col">
                <?php
                    $patients = \app\models\Patient::find()->all();
                    $list = ArrayHelper::map($patients, 'id', 'name');

                    print $form->field($model, 'patient_id')->widget(Select2::class, [
                        'data' => $list,
                        'language' => 'pt',
                        'options' => ['placeholder' => 'Selecione o paciente ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ])->label('Paciente');
                    ?>
                </div>
            </div>
        </div>

        <div class="row pt-3 pb-3">
            <div class="col">
                <h3>Dados do Contratado Solicitante</h3>
            </div>
        </div>

        <div class="highlight">
            <div class="row">
                <div class="col">
                <?php
                    $hospitals = \app\models\Hospital::find()->all();
                    $list = ArrayHelper::map($hospitals, 'id', 'name');

                    print $form->field($model, 'hospital_applicant_id')->widget(Select2::class, [
                        'data' => $list,
                        'language' => 'pt',
                        'options' => ['placeholder' => 'Selecione o hospital ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ])->label('Hospital Solicitante');
                    ?>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <?php
                    //enviando os profissionais para view
                    $profissionais_solicitantes = \app\models\Professional::find()->where(['type' => ['MC', 'MP']])->all();
                    $profissionais_solicitantes = ArrayHelper::map($profissionais_solicitantes, 'id', 'name');

                    print $form->field($model, 'professional_id')->widget(Select2::class, [
                        'data' => $profissionais_solicitantes,
                        'language' => 'pt',
                        'options' => ['placeholder' => 'Selecione o profissional ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ])->label('Profissionais');
                    ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-3 pb-3">
            <div class="col">
                <h3>Dados da Internação</h3>
            </div>
        </div>


        <div class="highlight">
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'quantity_daily_requested')->textInput() ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'requested_accommodation_type')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
               
                <div class="col">
                    <?= $form->field($model, 'clinical_indication')->textarea(['rows' => 6])?>
                </div>
            </div>
        </div>

        <div class="row pt-3 pb-3">
            <div class="col">
                <h3>Procedimentos ou Itens Assistenciais Solicitados</h3>
            </div>
        </div>
        <div class="highlight">
            <div class="row">
            <?php
                $procedures = app\models\Procedure::find()->all();
                $procedures = ArrayHelper::map($procedures, 'id', 'procedure_code');

                $internmentProcedures = empty($model->internmentProcedure) ? [new app\models\InternmentProcedure()] : $model->internmentProcedure;

                DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 0, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $internmentProcedures[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'quantity_requested',
                        'quantity_authorized',
                        'procedure_price',
                        'procedure_id'
                    ],
                ]);
            ?>

            <div class="panel-heading pb-3">
                <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i>
                    Adicionar Procedimento
                </button>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items">
                <!-- widgetContainer -->
                <?php foreach ($internmentProcedures as $index => $internmentProcedure) : ?>
                    <div class="item panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-4">
                                    <?= $form->field($internmentProcedure, "[{$index}]procedure_id")->dropDownList($procedures, ['prompt' => 'Selecione']) ?>
                                </div>
                                <div class="col">
                                    <?= $form->field($internmentProcedure, "[{$index}]quantity_requested")->textInput() ?>
                                </div>
                                <div class="col">
                                    <?= $form->field($internmentProcedure, "[{$index}]quantity_authorized")->textInput() ?>
                                </div>
                                <div class="col">
                                    <?= $form->field($internmentProcedure, "[{$index}]is_accountable")->dropDownList(['Não', 'Sim']) ?>
                                </div>
                                <div class="col-1" style="align-self: center;">
                                    <button type="button" class="pull-right remove-item btn btn-danger "><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <?php endforeach; ?>
            <?php DynamicFormWidget::end(); ?>
            </div>
        </div>


       
        <div class="row pt-3 pb-3">
            <div class="col">
                <h3>Dados da Autorizacão</h3>
            </div>
        </div>
        <div class="highlight">
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'quantity_daily_authorized')->textInput() ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'authorized_accommodation_type')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
               
                <div class="col">
                    <?= $form->field($model, 'operator_justification')->textarea(['rows' => 6])?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'request_date')->widget(DatePicker::class, [
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]); ?>
                </div>
            </div>
        </div>

        <br />
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>