<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Procedure */

$this->title = 'Cadastrar procedimento';
$this->params['breadcrumbs'][] = ['label' => 'Procedimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="procedure-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
