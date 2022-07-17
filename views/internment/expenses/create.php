<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Despesa */

$this->title = 'Gerenciar Despesas';
$this->params['breadcrumbs'][] = ['label' => "Despesa da Internação {$internment->id}", 'url' => ["internment/view-expense/", 'id'=>$internment->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="despesa-create">
    <?= Html::a('Voltar', ['view-expense', 'id' => $internment->id], ['class' => 'btn btn-primary']) ?>
    <h2><?= Html::encode($this->title) ?> </h2>

    <?= $this->render('_form', [
        'model' => $model,
        'internment' => $internment,
        'expenseModel' => $expenseModel
    ]) ?>

</div>
