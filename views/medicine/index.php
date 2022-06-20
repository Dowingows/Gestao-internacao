<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedicineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Medicines');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicine-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Medicine'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cod_tiss',
            'um_vr',
            'und',
            'description:ntext',
            //'cod_tnumm',
            //'cod_brasindice',
            //'cod_tiss_2',
            //'cod_agend',
            //'cod_agend_cob',
            //'price',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Medicine $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
