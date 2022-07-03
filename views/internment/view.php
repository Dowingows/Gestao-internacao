<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Internment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Internments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="internment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'operator_id',
            'number_form_assigned_operator',
            'provider_form_number',
            'authorization_date',
            'password',
            'expiry_date_password',
            'patient_id',
            'hospital_applicant_id',
            'professional_id',
            'hospital_requested_id',
            'suggested_hospitalization_date',
            'service_character',
            'regime',
            'quantity_daily_requested',
            'opme_usage_forecast',
            'chemotherapy_usage_forecast',
            'clinical_indication:ntext',
            'cid10_1',
            'cid10_2',
            'cid10_3',
            'cid10_4',
            'accident_indication',
            'hospital_admission_date',
            'quantity_daily_authorized',
            'authorized_accommodation_type',
            'hospital_authorized_id',
            'cnes_code',
            'note:ntext',
            'request_date',
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]) ?>

</div>
