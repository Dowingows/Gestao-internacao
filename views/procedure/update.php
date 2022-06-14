<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Procedure */

$this->title = Yii::t('app', 'Update Procedure: {name}', [
    'name' => $model->procedure_code,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Procedures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="procedure-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
