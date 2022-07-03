<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;
use kartik\date\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Diagnostic */
/* @var $form yii\widgets\ActiveForm */

?>
<?php

$fields = ['authorization_date', 'expiry_date_password', 'request_date'];
foreach ($fields as $field) {
    if (isset($model->{$field})) {
        $model->{$field} = date('d/m/Y', strtotime($model->{$field}));
    }
}

$procedures = app\models\Procedure::find()->all();
$procedures = ArrayHelper::map($procedures, 'id', 'procedure_code');

?>

<style>
    .highlight {
        background-color: #E9E9E9;
        padding: 20px;
        border-radius: 5px;
    }
</style>

<div class="diagnostic-form">
    <br />
    <h3>Guia de Serviço Profissional/Serviço Auxiliar de Diagnóstico e Terápia- SP/SADT</h3>
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="container g-0 ">
        <br />
        <div class="highlight">
            <div class="row">
                <div class="col">
                    <?php
                    $operators = \app\models\Operator::find()->all();
                    $list = ArrayHelper::map($operators, 'id', 'name');

                    print $form->field($model, 'operator_id')->widget(Select2::class, [
                        'data' => $list,
                        'language' => 'pt',
                        'options' => ['placeholder' => 'Selecione a operadora ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ])->label('Operadora');
                    ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'number_form_main')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'provider_form_number')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'authorization_date')->widget(DatePicker::class, [
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'password')->textInput() ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'expiry_date_password')->widget(DatePicker::class, [
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]); ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'number_form_assigned_operator')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="row pt-3 pb-3">
            <div class="col">
                <h3>Beneficiário</h3>
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
                <div class="col-12">
                    <?php
                    $hospitals = \app\models\Hospital::find()->all();
                    $list = ArrayHelper::map($hospitals, 'id', 'name');

                    print $form->field($model, 'contractor_applicant_id')->widget(Select2::class, [
                        'data' => $list,
                        'language' => 'pt',
                        'options' => ['placeholder' => 'Selecione o hospital ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ])->label('Contratado Solicitante');
                    ?>
                </div>
                <div class="col-12">
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

        <div class="row pt-3 pb-3">
            <div class="col">
                <h3>Dados da Solicitação/Procedimentos e Exames Solicitados</h3>
            </div>
        </div>

        <div class="highlight">
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'service_character')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'request_date')->widget(DatePicker::class, [
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]); ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'clinical_indication')->textInput(['maxlength' => true]) ?>
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

                $diagnosticProcedure = empty($model->diagnosticProcedure) ? [new app\models\DiagnosticProcedure()] : $model->diagnosticProcedure;

                DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 0, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $diagnosticProcedure[0],
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
                <?php foreach ($diagnosticProcedure as $index => $procedureExecuted) : ?>
                    <div class="item panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-5">
                                    <?= $form->field($procedureExecuted, "[{$index}]procedure_id")->dropDownList($procedures, ['prompt' => 'Selecione']) ?>
                                </div>
                                <div class="col">
                                    <?= $form->field($procedureExecuted, "[{$index}]quantity_requested")->textInput() ?>
                                </div>
                                <div class="col">
                                    <?= $form->field($procedureExecuted, "[{$index}]quantity_authorized")->textInput() ?>
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
                <h3>Dados do Contratado Executante</h3>
            </div>
        </div>

        <div class="highlight">
            <div class="row">
                <div class="col">
                    <?php
                    $hospitals = \app\models\Hospital::find()->all();
                    $list = ArrayHelper::map($hospitals, 'id', 'name');

                    print $form->field($model, 'contractor_executor_id')->widget(Select2::class, [
                        'data' => $list,
                        'language' => 'pt',
                        'options' => ['placeholder' => 'Selecione o hospital ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ])->label('Contratado Solicitante');
                    ?>
                </div>
            </div>
        </div>
        <div class="row pt-3 pb-3">
            <div class="col">
                <h3>Dados do Atendimento</h3>
            </div>
        </div>



        <div class="highlight">
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'service_type')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'accident_indication')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'type_medical_appointment')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'reason_closing_service')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>

        <!-- TODO: CHECK IF IT IS NEEDED TO REMOVE THESE FIELDS IN MIGRATIONS AND MODEL                      -->
        <?php $form->field($model, 'ans_code')->textInput(['maxlength' => true]) ?>
        <?php $form->field($model, 'contractor_name')->textInput(['maxlength' => true]) ?>
        <?php $form->field($model, 'contracted_operator_code')->textInput(['maxlength' => true]) ?>
        <?php $form->field($model, 'executor_contractor_name')->textInput(['maxlength' => true]) ?>
        <?php $form->field($model, 'cod_operator_executing')->textInput(['maxlength' => true]) ?>


        <br />

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>