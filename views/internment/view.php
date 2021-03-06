<?php

use yii\helpers\Html;
use app\assets\CustomAsset;

CustomAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Internment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Internments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

function formatMoney($val)
{
    if (empty($val)) {
        $val = 0;
    }
    $val = str_replace(".", ',', sprintf("%.2f", $val));
    return 'R$ ' . $val;
}

?>

<?php
$this->title = Yii::t('app', 'View Internment: {name}', [
    'name' => $model->id,
]);
?>

<div class="internment-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if (empty($model->deleted_at)) : ?>
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>

            <?= Html::a(Yii::t('app', 'Extend'), ['create-extension', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Expenses'), ['view-expense', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>


        </p>
    <?php else : ?>
        <h4 class="text-danger text-center"><i>Ficha removida em <?= Yii::$app->formatter->asDatetime($model->deleted_at, 'php:d/m/Y, H:i:s') ?></i></h4>
    <?php endif ?>
    
    <?php if(!empty($model->batch_id)): ?>
        <h5 class="text-end display-block"><i>Ficha associada ao <span class="text-primary">  <?= Html::a('lote '.$model->batch_id, ["/batch/view", 'id' => $model->batch_id]); ?></span></i></h5>
    <?php endif; ?>
      
    <div class="scrolly">
        <div class="rp-content ">

            <div class="rp-row g-0">
                <div class="rp-field rp-field-p-10" style="width:280px">
                    <div class="rp-field-label">1 - Registro ANS</div>
                    <div class="rp-field-value">
                        <?= $model->operator->ans_code ?>
                    </div>
                </div>
                <div class="rp-field " style="width:280px">
                    <div class="rp-field-label">2 - N??mero da Guia no Prestador</div>
                    <div class="rp-field-value">
                        <?= $model->provider_form_number ?>
                    </div>
                </div>

                <div class="rp-field " style="width:280px">
                    <div class="rp-field-label">3 - N??mero da Guia Atribuido pela operadora</div>
                    <div class="rp-field-value">
                        <?= $model->number_form_assigned_operator ?>
                    </div>
                </div>
            </div>

            <div class="rp-row">
                <div class="rp-field rp-field-p-20" style="width:420px">
                    <div class="rp-field-label">4 - Data da autoriza????o</div>
                    <div class="rp-field-value">
                        <?= Yii::$app->formatter->asDateTime($model->authorization_date, 'php:d/m/Y'); ?>
                    </div>
                </div>


                <div class="rp-field " style="width:420px">
                    <div class="rp-field-label">6 - Data de validade da Senha</div>
                    <div class="rp-field-value">
                        <?= Yii::$app->formatter->asDateTime($model->expiry_date_password, 'php:d/m/Y') ?>
                    </div>
                </div>
            </div>


            <!--    Dados do Benefici??rio -->
            <!--    SECTION BENEFICIARIO-->
            <div class="section-title">Dados do Benefici??rio</div>

            <div class="rp-row">
                <div class="rp-field rp-field-150">
                    <div class="rp-field-label">7 - N??mero da Carteira</div>
                    <div class="rp-field-value">
                        <?= $model->patient->card_id_number ?>
                    </div>
                </div>

                <div class="rp-field rp-field-p-25">
                    <div class="rp-field-label">8 - Validade da Carteira</div>
                    <div class="rp-field-value">
                        <?= Yii::$app->formatter->asDateTime($model->patient->card_expiration_date, 'php:d/m/Y'); ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-25">
                    <div class="rp-field-label">9 - Atendimento de RN</div>
                    <div class="rp-field-value">

                    </div>
                </div>
            </div>

            <div class="rp-row">
                <div class="rp-field rp-field-425">
                    <div class="rp-field-label">10 - Nome</div>
                    <div class="rp-field-value">
                        <?= $model->patient->name ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-20" style="width:284px">
                    <div class="rp-field-label">11 - Cart??o Nacional de Sa??de</div>
                    <div class="rp-field-value">
                        <?= $model->patient->card_health_national ?>
                    </div>
                </div>
            </div>


            <!--    SECTION CONTRATADO SOLICITANTE-->
            <div class="section-title">Dados do Contratado Solicitante</div>

            <div class="rp-row">
                <div class="rp-field rp-field-160">
                    <div class="rp-field-label">12 - C??digo da Operadora</div>
                    <div class="rp-field-value">
                        <?= $model->hospitalApplicant->cnpj ?>
                    </div>
                </div>
                <div class="rp-field rp-field-425" style="width:551px">
                    <div class="rp-field-label">13 - Nome do Contratado</div>
                    <div class="rp-field-value">
                        <?= $model->hospitalApplicant->name ?>
                    </div>
                </div>
            </div>

            <div class="rp-row">
                <div class="rp-field rp-field-225">
                    <div class="rp-field-label">14 - Nome do Profissional Solicitante</div>
                    <div class="rp-field-value">
                        <?= $model->professional->name ?>

                    </div>
                </div>
                <div class="rp-field rp-field-p-15">
                    <div class="rp-field-label">15 - Conselho Profissional</div>
                    <div class="rp-field-value">
                        <?= $model->professional->council ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-15">
                    <div class="rp-field-label">16 - Numero do conselho</div>
                    <div class="rp-field-value">
                        <?= $model->professional->council_number ?>
                    </div>
                </div>
                <div class="rp-field rp-field-50">
                    <div class="rp-field-label">17 - UF</div>
                    <div class="rp-field-value">
                        <?= $model->professional->uf ?>
                    </div>
                </div>
                <div class="rp-field rp-field-100">
                    <div class="rp-field-label">18 - C??digo CBO</div>
                    <div class="rp-field-value">
                        <?= $model->professional->cbo_code ?>
                    </div>
                </div>
            </div>

            <!--    SECTION DADOS DO HOSPITAL-->
            <div class="section-title">Dados do Hospital / Local Solicitado / Dados da interna????o</div>

            <div class="rp-row">
                <div class="rp-field rp-field-p-20">
                    <div class="rp-field-label">19 - C??digo na Operadora/CNPJ</div>
                    <div class="rp-field-value">
                        <?= $model->hospitalRequested->cnpj ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-25">
                    <div class="rp-field-label">20 - Nome do Hospital/Local Solicitado</div>
                    <div class="rp-field-value">

                        <?= $model->hospitalRequested->name ?>
                    </div>
                </div>
                <div class="rp-field rp-field-215">
                    <div class="rp-field-label">21 - Data sugerida para interna????o</div>
                    <div class="rp-field-value">
                        <?= Yii::$app->formatter->asDate($model->suggested_hospitalization_date, 'php:d/m/Y'); ?>
                    </div>
                </div>
            </div>

            <div class="rp-row">
                <div class="rp-field rp-field-p-15">
                    <div class="rp-field-label">22 - Carater de atendimento</div>
                    <div class="rp-field-value">
                        <?= $model->service_character ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-15">
                    <div class="rp-field-label">23 - Tipo de interna????o</div>
                    <div class="rp-field-value">
                        <?php // $model->tipo_internacao 
                        ?>
                        <?= 'PENDENTE' ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-15">
                    <div class="rp-field-label">24 - Regime de interna????o</div>
                    <div class="rp-field-value">
                        <?= $model->regime ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-15">
                    <div class="rp-field-label">25 - Qtde. di??rias Solicitadas</div>
                    <div class="rp-field-value">
                        <?= $model->quantity_daily_requested ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-20">
                    <div class="rp-field-label">26 -Previs??o de uso de OPME</div>
                    <div class="rp-field-value">
                        <?= $model->opme_usage_forecast ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-20" style="width: 240px">
                    <div class="rp-field-label">27 -Previs??o de uso de Quimioter??pico</div>
                    <div class="rp-field-value">
                        <?= $model->chemotherapy_usage_forecast ?>
                    </div>
                </div>
            </div>
            <div class="rp-row">
                <div class="rp-field" style="width: 1128px;">
                    <div class="rp-field-label">28 - Indica????o Clinica</div>
                    <div class="rp-field-value rp-field-textarea ">
                        <?= $model->clinical_indication ?>
                    </div>
                </div>
            </div>

            <div class="rp-row">
                <div class="rp-field rp-field-p-20  rp-gray" style="width:180px">
                    <div class="rp-field-label">29 - CID10 Principal(Opcional)</div>
                    <div class="rp-field-value">
                        <?= $model->cid10_1 ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-20 rp-gray" style="width:180px">
                    <div class="rp-field-label">30 - CID10(2) (Opcional)</div>
                    <div class="rp-field-value  ">
                        <?= $model->cid10_2 ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-20 rp-gray" style="width:180px">
                    <div class="rp-field-label">31 - CID10(3) (Opcional)</div>
                    <div class="rp-field-value  ">
                        <?= $model->cid10_3 ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-20 rp-gray" style="width:180px">
                    <div class="rp-field-label">32 - CID10(4) (Opcional)</div>
                    <div class="rp-field-value ">
                        <?= $model->cid10_4 ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-20 " style="width:404px">
                    <div class="rp-field-label">33 - Indica????o de Acidente (acidente ou doen??a relacionada)</div>
                    <div class="rp-field-value ">
                        <?= $model->accident_indication ?>
                    </div>
                </div>
            </div>

            <!--    Procedimentos ou Itens Assistenciais Solicitados -->
            <div class="section-title">Procedimentos ou Itens Assistenciais Solicitados</div>

            <div class="rp-row">
                <div class="rp-box">
                    <table>
                        <tr class="tb-title">
                            <td width="10%">34 - Tabela</td>
                            <td width="20%"> 35 - C??digo do procedimento</td>
                            <td width="40%">36 - Descri????o</td>
                            <td width="10%">37 - Qtde. Solic.</td>
                            <td width="10%">38 - Qtde. Aut</td>
                            <td width="20%">Valor Unit</td>
                        </tr>
                        <tbody>
                            <?php foreach ($model->internmentProcedure as $key => $int) : ?>
                                <tr class="tb-body">
                                    <td class="text-mini"><span class="text-tiny">
                                            <?= $key + 1 ?></span>
                                        - <?= $int->procedure->table ?>
                                    </td>
                                    <td class="text-mini"><?= $int->procedure->procedure_code ?></td>
                                    <td class="text-mini"><?= $int->procedure->description ?></td>
                                    <td class="text-mini"><?= $int->quantity_requested ?></td>
                                    <td class="text-mini"><?= $int->quantity_authorized ?></td>
                                    <?php $class = empty($int->is_accountable) ? 'text-danger' : ''; ?>
                                    <td class="text-mini <?= $class ?> "><?= formatMoney($int->procedure_price) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--    DADOS DA AUTORIZAC??O -->
            <div class="section-title">Dados da Autoriza????o</div>
            <div class="rp-row">
                <div class="rp-field rp-field-p-25 ">
                    <div class="rp-field-label">39 - Data prov??vel da Admiss??o hospitalar</div>
                    <div class="rp-field-value">
                        <?= Yii::$app->formatter->asDate($model->hospital_admission_date, 'php: d/m/Y'); ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-20 ">
                    <div class="rp-field-label">40 - Qtde Diarias Autorizadas</div>
                    <div class="rp-field-value">
                        <?= $model->quantity_daily_authorized; ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-20 ">
                    <div class="rp-field-label">41 - Tipo de acomoda????o autorizada</div>
                    <div class="rp-field-value">
                        <?= $model->authorized_accommodation_type; ?>
                    </div>
                </div>
            </div>

            <div class="rp-row">
                <div class="rp-field rp-field-p-30 ">
                    <div class="rp-field-label">42 - C??digo na operadora / CNPJ autorizado</div>
                    <div class="rp-field-value">
                        <?= $model->hospitalAuthorized->cnpj ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-35 ">
                    <div class="rp-field-label">43 - Nome do Hospital / Local Autorizado</div>
                    <div class="rp-field-value">
                        <?= $model->hospitalAuthorized->name ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-35 " style="width:396px">
                    <div class="rp-field-label">44 - C??digo CNES</div>
                    <div class="rp-field-value">
                        <?= $model->cnes_code; ?>
                    </div>
                </div>

            </div>
            <div class="rp-row">
                <div class="rp-field rp-gray" style="width:1128px">
                    <div class="rp-field-label">45 - Observa????o</div>
                    <div class="rp-field-value rp-field-textarea ">

                        <?= $model->note; ?>
                    </div>
                </div>
            </div>
            <div class="rp-row">
                <div class="rp-field rp-field-p-25 ">
                    <div class="rp-field-label">46 - Data da Solicita????o</div>
                    <div class="rp-field-value">
                        <?= Yii::$app->formatter->asDate($model->request_date, 'php: d/m/Y'); ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-25">
                    <div class="rp-field-label">47 - Assinatura do Profissional Solicitante</div>
                    <div class="rp-field-value">

                    </div>
                </div>
                <div class="rp-field rp-field-p-25">
                    <div class="rp-field-label">48 - Assinatura do benefici??rio ou respons??vel</div>
                    <div class="rp-field-value">

                    </div>
                </div>
                <div class="rp-field rp-field-p-25" style="width:287px">
                    <div class="rp-field-label">49 - Assinatura do respons??vel pela Autoriza????o</div>
                    <div class="rp-field-value">

                    </div>
                </div>
            </div>
            
            <div class="content-bottom">
                Criado em <?= Yii::$app->formatter->asDatetime($model->created_at, 'php:d/m/Y, H:i:s') ?>.

                ??ltima modifica????o <?= Yii::$app->formatter->asDatetime($model->updated_at, 'php:d/m/Y, H:i:s') ?>
            </div>
        </div>
        <hr />
            <?php foreach ($model->extensions as $extension) : ?>
                <div class="">
                    <?= Html::a('Prorroga????o - ' . $extension->id, ["/internment/view", 'id' => $extension->id], ['class' => 'btn btn-md btn-primary']); ?>
                </div>
                <br />
            <?php endforeach; ?>
    </div>
</div>