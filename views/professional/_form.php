<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\Models\Professional;

/* @var $this yii\web\View */
/* @var $model app\models\Professional */
/* @var $form yii\widgets\ActiveForm */
/* @var $professional app\Models\Professional */
?>

<div class="professional-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'council')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'council_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cbo_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(Professional::getTypesList(), ['empty'=>'selecione um tipo de profissional']) ?>

 
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
