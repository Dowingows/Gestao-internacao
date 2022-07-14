<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Batch */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Batches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?php
$this->title = Yii::t('app', 'View Batch: {name}', [
    'name' => $model->id,
]);
?>

<div class="batch-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?= !empty($model->internments) ? 'Internação' : 'Diagnóstico';  ?></h3>
    <p>
        <?= Html::a(' XML', ['xml', 'id' => $model->id], ['target' => '_blank', 'class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hash',
            'created_at',
            'updated_at'
        ],
    ]) ?>

</div>
