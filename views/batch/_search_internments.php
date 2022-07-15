<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\InternacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="internacao-search">
    <?php $form = ActiveForm::begin([
        'action' => ['create-internment'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'operator_id')->dropDownList(ArrayHelper::map(\app\models\Operator::find()->all(), 'id', 'name')) ?>
        </div>
        <div class="col">

            <?= $form->field($model, 'date_initial')->widget(DatePicker::class, [
                'convertFormat' => true,
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]); ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'date_final')->widget(DatePicker::class, [
                'convertFormat' => true,
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]); ?>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>