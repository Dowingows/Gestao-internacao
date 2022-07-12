<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Internment */

$this->title = Yii::t('app', 'Create Internment Extension');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Internments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="internment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_extension', [
        'model' => $model,
        'parent' => $parent,
    ]) ?>

</div>
