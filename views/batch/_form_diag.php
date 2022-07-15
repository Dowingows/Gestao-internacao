<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $internacoes app\models\Internacao[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $answers array */
?>

<div class="lote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $this->render('components/table-picklist-diag', [
        'diagnostics' => $diagnostics,
        'answers' => $answers
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Gerar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'disabled' => empty($diagnostics)]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
