<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Supply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supply-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cod_simpro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'un_vr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'und')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cod_tnumm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_padrao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_agend')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_agend_cob')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nature')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
