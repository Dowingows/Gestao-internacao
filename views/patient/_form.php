<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
if(isset($model->card_expiration_date)) {
    $model->card_expiration_date = date('d/m/Y',strtotime($model->card_expiration_date));
}
?>
<div class="patient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_id_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_expiration_date')->widget(DatePicker::className(), [
        'convertFormat' => true,
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'card_health_national')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
