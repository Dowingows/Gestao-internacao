<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Professional */

$this->title = Yii::t('app', 'Create Professional');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Professionals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professional-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
