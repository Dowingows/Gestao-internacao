<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model app\models\Medicine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medicine-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cod_tiss')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'um_vr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'und')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cod_tnumm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_brasindice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_tiss_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_agend')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_agend_cob')->textInput(['maxlength' => true]) ?>

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
