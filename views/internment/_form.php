<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;

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

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="container g-0 ">
        <br />
        <div class="highlight">
            <div class="row">
                <div class="col-3">
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
                    <?= $form->field($model, 'number_form_assigned_operator')->textInput(['maxlength' => true]) ?>
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
                    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
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
                <h3>Dados Hospital/Local Solicitado/ Dados Internação</h3>
            </div>
        </div>

        <div class="highlight">
            <div class="row">
                <div class="col-8">
                    <?php
                    $hospitals = \app\models\Hospital::find()->all();
                    $list = ArrayHelper::map($hospitals, 'id', 'name');

                    print $form->field($model, 'hospital_requested_id')->widget(Select2::class, [
                        'data' => $list,
                        'language' => 'pt',
                        'options' => ['placeholder' => 'Selecione o hospital ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ])->label('Hospital Solicitante');
                    ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'suggested_hospitalization_date')->widget(DatePicker::class, [
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'service_character')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'regime')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'quantity_daily_requested')->textInput() ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'opme_usage_forecast')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'chemotherapy_usage_forecast')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'clinical_indication')->textarea(['rows' => 6]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'cid10_1')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'cid10_2')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'cid10_3')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'cid10_4')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'accident_indication')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>

        <div class="row pt-3 pb-3">
            <div class="col">
                <h3>Dados da autorização</h3>
            </div>
        </div>


        <div class="highlight">
            <div class="row">
                <div class="col">
                    
                    <?= $form->field($model, 'hospital_admission_date')->widget(DatePicker::class, [
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]); ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'quantity_daily_authorized')->textInput() ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'authorized_accommodation_type')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php
                    $hospitals = \app\models\Hospital::find()->all();
                    $list = ArrayHelper::map($hospitals, 'id', 'name');

                    print $form->field($model, 'hospital_authorized_id')->widget(Select2::class, [
                        'data' => $list,
                        'language' => 'pt',
                        'options' => ['placeholder' => 'Selecione o hospital ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ])->label('Hospital Solicitante');
                    ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'cnes_code')->textInput(['maxlength' => true]) ?>
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