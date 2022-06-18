<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MedicineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medicine-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cod_tiss') ?>

    <?= $form->field($model, 'um_vr') ?>

    <?= $form->field($model, 'und') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'cod_tnumm') ?>

    <?php // echo $form->field($model, 'cod_brasindice') ?>

    <?php // echo $form->field($model, 'cod_tiss_2') ?>

    <?php // echo $form->field($model, 'cod_agend') ?>

    <?php // echo $form->field($model, 'cod_agend_cob') ?>

    <?php // echo $form->field($model, 'price') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
