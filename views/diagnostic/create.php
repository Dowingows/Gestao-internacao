<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Diagnostic */

$this->title = Yii::t('app', 'Create Diagnostic');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Diagnostics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diagnostic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
