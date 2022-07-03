<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DiagnosticSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Diagnostics');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diagnostic-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Diagnostic'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'number_form_assigned_operator',
            [
                'label' => 'Operadora',
                'value' => function ($d) {
                    return $d->operator->name;
                }
            ],
            [
                'label' => 'Paciente',
                'value' => function ($model) {
                    return $model->patient->name;
                }
            ],
            'number_form_main',
            [
                'label' => 'Data de autorização',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDateTime($model->authorization_date, 'php:d/m/Y');
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>



</div>
