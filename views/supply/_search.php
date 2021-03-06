<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SupplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cod_simpro') ?>

    <?= $form->field($model, 'un_vr') ?>

    <?= $form->field($model, 'und') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'cod_tnumm') ?>

    <?php // echo $form->field($model, 'cod_padrao') ?>

    <?php // echo $form->field($model, 'cod_agend') ?>

    <?php // echo $form->field($model, 'cod_agend_cob') ?>

    <?php // echo $form->field($model, 'nature') ?>

    <?php // echo $form->field($model, 'price') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
