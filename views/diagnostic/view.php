<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Diagnostic */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Diagnostics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="diagnostic-view">

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
            'accident_indication',
            'ans_code',
            'number_form_main',
            'authorization_date',
            'expiry_date_password',
            'number_form_assigned_operator',
            'patient_id',
            'professional_id',
            'service_character',
            'request_date',
            'clinical_indication',
            'contractor_name',
            'contracted_operator_code',
            'executor_contractor_name',
            'cod_operator_executing',
            'service_type',
            'type_medical_appointment',
            'provider_form_number',
            'reason_closing_service',
            'contractor_applicant_id',
            'contractor_executor_id',
            'note:ntext',
        ],
    ]) ?>

</div>
