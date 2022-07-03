<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'operator_id',
            'number_form_assigned_operator',
            'provider_form_number',
            'authorization_date',
            //'password',
            //'expiry_date_password',
            //'patient_id',
            //'hospital_applicant_id',
            //'professional_id',
            //'hospital_requested_id',
            //'suggested_hospitalization_date',
            //'service_character',
            //'regime',
            //'quantity_daily_requested',
            //'opme_usage_forecast',
            //'chemotherapy_usage_forecast',
            //'clinical_indication:ntext',
            //'cid10_1',
            //'cid10_2',
            //'cid10_3',
            //'cid10_4',
            //'accident_indication',
            //'hospital_admission_date',
            //'quantity_daily_authorized',
            //'authorized_accommodation_type',
            //'hospital_authorized_id',
            //'cnes_code',
            //'note:ntext',
            //'request_date',
            //'created_at',
            //'updated_at',
            //'deleted_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action,  $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
