<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\InternacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="internacao-search">
    <div class="row">
        <div class="col-md-12">

            <?php $form = ActiveForm::begin([
                'action' => ['create-lote-diagnostico'],
                'method' => 'get',
            ]); ?>
            <div class="col-md-4">
                <?= $form->field($model, 'operadora_id')->dropDownList(ArrayHelper::map(\app\models\Operadora::find()->all(), 'id', 'nome'))->label('Operadora') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'date_initial')->widget(DateControl::classname(), [
                    'displayFormat' => 'php:d-m-Y',
                    'type' => DateControl::FORMAT_DATE,
                ])->label('Data de autorização inicial'); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'date_final')->widget(DateControl::classname(), [
                    'displayFormat' => 'php:d-m-Y',
                    'type' => DateControl::FORMAT_DATE
                ])->label('Data de autorização final');; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

