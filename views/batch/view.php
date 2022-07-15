<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\assets\CustomAsset;

CustomAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Lote */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$this->title = Yii::t('app', 'View Batch: {name}', [
    'name' => $model->id,
]);
?>

<div class="lote-view">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <p class="pull-right">
        <?= Html::a(' XML', ['xml', 'id' => $model->id], ['target' => '_blank', 'class' => 'btn btn-primary']) ?>
        <?= Html::a('Remover', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hash',
            'month',
            [
                'label' => 'Criado em',
                'value' => function ($model) {
                    if (!empty($model->created_at)) {
                        return date('d/m/Y, H:i', strtotime($model->created_at)); // $data['name'] for array data, e.g. using SqlDataProvider.
                    }
                    return '';
                }
            ],
        ],
    ]) ?>

</div>

<?php if (!empty($model->diagnostics)): ?>
    <div class="diagnostic-index">
        <h4><?= Yii::t('app', 'Diagnostics') ?></h4>
        <table class="table table-striped table-bordered">
            <thead>
            <th></th>
            <th>Número da Guía Atribuído pela Operadora</th>
            <th>Data da Autorização</th>
            <th>Paciente</th>
            <th>Operadora</th>
            </thead>
            <tbody>
            <?php $i = 1;
            foreach ($model->diagnostics as $diag) : ?>
                <tr>
                    <td> <?= Html::a('# ' . $i++, ['/diagnostic/view/', 'id' => $diag->id], ['target' => '_blank']); ?></td>

                    <td><?= $diag->number_form_assigned_operator ?></td>

                    <td>
                        <?= Yii::$app->formatter->asDateTime($diag->authorization_date, 'php:d/m/Y'); ?>
                    </td>
                    <td><?= $diag->patient->name; ?></td>
                    <td><?= $diag->operator->name; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>

<?php if (!empty($model->internments)): ?>
    <div class="internments-index">
        <h4>Internações</h4>
        <table class="table table-striped table-bordered">
            <thead>
            <th></th>
            <th>Nº Guia Atribuido pela Operadora</th>
            <th>Tipo</th>
            <th>Data da Autorização</th>
            <th>Paciente</th>
            <th>Operadora</th>
            </thead>
            <tbody>
            <?php $i = 1;
            foreach ($model->internments as $int) : ?>
                <tr>
                    <td> <?= Html::a('# ' . $i++, ['/internment/view/', 'id' => $int->id], ['target' => '_blank']); ?></td>

                    <td><?= $int->number_form_assigned_operator ?></td>
                    <td>
                        <?= $int->getTypeName(); ?>
                    </td>
                    <td>
                        <?= Yii::$app->formatter->asDateTime($int->authorization_date, 'php:d/m/Y'); ?>
                    </td>
                    <td><?= $int->patient->name; ?></td>
                    <td><?= $int->operator->name; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>
