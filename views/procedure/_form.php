<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model app\models\Procedure */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="procedure-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'table')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'procedure_code')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                'prefix' => 'R$ ',
                'min' => 0,
                'max' => 100000000,
                'allowMinus' => false,
                'groupSeparator' => ' ',
                'radixPoint' => ',',
                'rightAlign' => false
            ],
    ]); ?>
    <br/>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
