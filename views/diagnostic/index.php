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

            'id',
            'operator_id',
            'accident_indication',
            'ans_code',
            'number_form_main',
            //'authorization_date',
            //'expiry_date_password',
            //'number_form_assigned_operator',
            //'patient_id',
            //'professional_id',
            //'service_character',
            //'request_date',
            //'clinical_indication',
            //'contractor_name',
            //'contracted_operator_code',
            //'executor_contractor_name',
            //'cod_operator_executing',
            //'service_type',
            //'type_medical_appointment',
            //'provider_form_number',
            //'reason_closing_service',
            //'contractor_applicant_id',
            //'contractor_executor_id',
            //'note:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
