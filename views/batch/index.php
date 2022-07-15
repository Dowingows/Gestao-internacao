<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\CustomAsset;

CustomAsset::register($this);

use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lotes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lote-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Gerar Lote Internação', ['create-internment'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Gerar Lote Diagnóstico', ['create-lote-diagnostico'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'hash',
            [
                'label' => 'Mês',
                'value' => function ($data) {
                    return sprintf("%02d", $data->month);
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d/m/Y']
            ],
            [
                'label' => '',
                'format' => 'raw',
                'value' => function ($data) {
                    $action_view = Html::a('', ["/batch/view", 'id' => $data->id], [
                        'class' => 'fa fa-fw fa-eye', ['escape' => false]]);
                    $action_delete = Html::a('', ["/batch/delete", 'id' => $data->id], [
                        'data' => [
                            'confirm' => 'Você deseja remover esse lote?',
                            'method' => 'post',
                        ],
                        'class' => 'fa fa-fw fa-trash text-danger'
                    ]);
                    return $action_view . "    " . $action_delete;
                }
            ],
        ],

    ]); ?>
</div>