<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Despesa */

$this->title = 'Adicionar Despesa';
$this->params['breadcrumbs'][] = ['label' => "Despesa da Internação {$internment->id}", 'url' => ["internment/view-expense/", 'id'=>$internment->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="despesa-create">

    <h2><?= Html::encode($this->title) ?> </h2>

    <?= $this->render('_form', [
        'model' => $model,
        'internment' => $internment,
        'expenseModel' => $expenseModel
    ]) ?>

</div>
