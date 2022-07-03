<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\InternmentSearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Internments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="internment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Internment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute' => 'number_form_assigned_operator',
                'value' => 'number_form_assigned_operator',
                'label'=> 'Nº Guia OP'
            ],
            [
                'attribute' => 'operator_name',
                'value' => 'operator.name'
            ],
            [

                'attribute' => 'authorization_date',
                'format' => ['date', 'php:d/m/Y']
            ], 
            [
                'attribute' => 'patient_name',
                'value' => 'patient.name'
            ],
            'password',
            [
                'value' => 'created_at',
                'label' => 'Data de Entrada',
                'format' => ['date', 'php:d/m/Y']
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action,  $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
