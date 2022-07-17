<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Despesa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="despesa-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($internment, 'id')->hiddenInput()->label(false); ?>
    <div class="form-group">
        <div class="table-responsive">
            <table class="table table-striped" >
                <tbody>
                    <tr>
                        <td><b>Operadora</b></td>
                        <td><?= $internment->operator->name; ?></td>
                    </tr>
                    <tr>
                        <td><b>Executante</b></td>
                        <td><?= $internment->hospitalAuthorized->name; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col">
            <?= $this->render('_form_expenses', [
                    'expenseModelList' => $expenseModel,
                    'internment' => $internment,
                    'form' => $form
                ]); ?>
            </div>

        </div>

        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

