<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\CustomAsset;

CustomAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Diagnostic */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Diagnostics'), 'url' => ['index']];
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
$this->title = Yii::t('app', 'View Diagnostic: {name}', [
    'name' => $model->id,
]);
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
    <div class="scrolly">
        <div class="rp-content ">

            <div class="rp-row g-0">
                <div class="rp-field rp-field-p-10">
                    <div class="rp-field-label">1 - Registro ANS</div>
                    <div class="rp-field-value">
                        <?= $model->operator->ans_code ?>
                    </div>
                </div>
                <div class="rp-field " style="width:180px">
                    <div class="rp-field-label">2 - Número Guia no Prestador</div>
                    <div class="rp-field-value">
                        <?= $model->provider_form_number ?>
                    </div>
                </div>

                <div class="rp-field " style="width:180px">
                    <div class="rp-field-label">3 - Número da Guia Principal</div>
                    <div class="rp-field-value">
                        <?= $model->number_form_main ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-15">
                    <div class="rp-field-label">4 - Data da autorização</div>
                    <div class="rp-field-value">
                        <?= Yii::$app->formatter->asDateTime($model->authorization_date, 'php:d/m/Y') ?>

                    </div>
                </div>

                <div class="rp-field rp-field-p-7" style="width: 87px">
                    <div class="rp-field-label">5 - Senha</div>
                    <div class="rp-field-value">
                        <?= $model->password ?>
                    </div>
                </div>
                <div class="rp-field " style="width:180px">
                    <div class="rp-field-label">6 - Data de validade da Senha</div>
                    <div class="rp-field-value">
                        <?= Yii::$app->formatter->asDateTime($model->expiry_date_password, 'php:d/m/Y') ?>
                    </div>
                </div>

                <div class="rp-field" style="width: 226px">
                    <div class="rp-field-label">7 - Nº da Guia atribuida/operadora</div>
                    <div class="rp-field-value">
                        <?= $model->number_form_assigned_operator ?>
                    </div>
                </div>
            </div>

            <div class="rp-row">
                <div class="rp-field rp-field-p-30">
                    <div class="rp-field-label">15 - Nome do Profissional Solicitante</div>
                    <div class="rp-field-value">
                        <?= $model->professional->name ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-15">
                    <div class="rp-field-label">16 - Conselho Profissional</div>
                    <div class="rp-field-value">
                        <?= $model->professional->council ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-10" style="width:155px">
                    <div class="rp-field-label">17 - Numero do conselho</div>
                    <div class="rp-field-value">
                        <?= $model->professional->council_number ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-8">
                    <div class="rp-field-label">18 - UF</div>
                    <div class="rp-field-value">
                        <?= $model->professional->uf ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-10">
                    <div class="rp-field-label">19 - Código CBO</div>
                    <div class="rp-field-value">
                        <?= $model->professional->cbo_code ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-25" style="width: 260px">
                    <div class="rp-field-label">20 - Assinatura do Profissional Solicitante</div>
                    <div class="rp-field-value">

                    </div>
                </div>
            </div>

            <!--    DADOS DA SOLICITAÇÃO  / PROCEDIMENTOS E EXAMES SOLICITADOS -->
            <div class="section-title">Dados da solicitação / Procedimentos e Exames Solicitados</div>

            <div class="rp-row">
                <div class="rp-field rp-field-p-20">
                    <div class="rp-field-label">21 - Caráter de atendimento</div>
                    <div class="rp-field-value">
                        <?= $model->service_character ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-20">
                    <div class="rp-field-label">22 - Data da solicitação</div>
                    <div class="rp-field-value">

                        <?= Yii::$app->formatter->asDateTime($model->request_date, 'php:d/m/Y') ?>
                    </div>
                </div>
                <div class="rp-field " style="width: 692px">
                    <div class="rp-field-label">23 - Indicação clinica(Obrigatório se pequena cirurgia, terapia, consulta de
                        referência e alto custo)
                    </div>
                    <div class="rp-field-value">
                        <?= $model->clinical_indication ?>
                    </div>
                </div>
            </div>

            <div class="rp-row">
                <div class="rp-box">
                    <table>
                        <tr class="tb-title">
                            <td width="10%">24 - Tabela</td>
                            <td width="20%"> 25 - Código do procedimento</td>
                            <td width="40%">26 - Descrição</td>
                            <td width="10%">27 - Qtde. Solic.</td>
                            <td width="10%">28 - Qtde. Aut</td>
                            <td width="20%">Valor Unit</td>
                        </tr>

                        <?php foreach ($model->diagnosticProcedure as $key => $diagProcedure) : ?>
                            <tr>
                                <td><span class="text-tiny">
                                        <?= $key + 1 ?></span>
                                    - <?= $diagProcedure->procedure->table ?>
                                </td>
                                <td><?= $diagProcedure->procedure->procedure_code ?></td>
                                <td><?= $diagProcedure->procedure->description ?></td>
                                <td><?= $diagProcedure->quantity_requested ?></td>
                                <td><?= $diagProcedure->quantity_authorized ?></td>
                                <td><?= formatMoney($diagProcedure->procedure_price) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>


            <!--    DADOS DO CONTRATO EXECUTANTE-->
            <div class="section-title">Dados do Contratado executante</div>
            <div class="rp-row">
                <div class="rp-field rp-field-p-20 ">
                    <div class="rp-field-label">29 - Código na operadora</div>
                    <div class="rp-field-value">
                        <?= $model->contractorExecutor->cnpj ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-60 ">
                    <div class="rp-field-label">30 - Nome do Contratado</div>
                    <div class="rp-field-value">
                        <?= $model->contractorExecutor->name ?>
                    </div>
                </div>
                <div class="rp-field  " style="width: 230px">
                    <div class="rp-field-label">31 - Código CNES</div>
                    <div class="rp-field-value">

                    </div>
                </div>
            </div>
            <!--    DADOS DO  ATENDIMENTO-->
            <div class="section-title">Dados do Atendimento</div>
            <div class="rp-row">
                <div class="rp-field rp-field-p-15">
                    <div class="rp-field-label">32 - Tipo de atendimento</div>
                    <div class="rp-field-value">
                        <?= $model->service_type ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-25" style="width: 345px">
                    <div class="rp-field-label">33 - Indicação de Acidente (acidente ou doença relacionada)</div>
                    <div class="rp-field-value">
                        <?= $model->accident_indication ?>
                    </div>
                </div>
                <div class="rp-field rp-field-p-10 " style="width: 150px">
                    <div class="rp-field-label">34 - Tipo de consulta</div>
                    <div class="rp-field-value">
                        <?= $model->type_medical_appointment ?>
                    </div>
                </div>
                <div class="rp-field " style="width: 475px">
                    <div class="rp-field-label">35 -Motivo de encerramento do atendimento</div>
                    <div class="rp-field-value">
                        <?= $model->reason_closing_service ?>
                    </div>
                </div>
            </div>

            <!--    PROCEDIMENTOS E EXAMES REALIZADOS -->
            <div class="section-title">Procedimentos e Exames Realizados</div>
            <div class="rp-row">
                <div class="rp-box">
                    <table>

                        <tr class="tb-title">
                            <td>36 - Data</td>
                            <td>37 - Hora Inicial</td>
                            <td>38 - Hora Final</td>
                            <td>39 - Tabela</td>
                            <td>40 - Código do Procedimento</td>
                            <td>41 - Descrição</td>
                            <td>42 - Qtde</td>
                            <td>43 - Via</td>
                            <td>44 - Téc</td>
                            <td>45 - Fator Red./Acresc</td>
                        </tr>

                        <?php for ($i = 1; $i < 6; $i++) : ?>
                            <tr>
                                <td width="5%"><span class="text-tiny">___/___/___</td>
                                <td width="5%">___:___</td>
                                <td width="5%">___:___</td>
                                <td width="10%">|_|_|</td>
                                <td width="10%">|_|_|_|_|_|_|_|_|</td>
                                <td width="30%">___________________________________________________</td>
                                <td width="10%">|_|_|_|</td>
                                <td width="5%">|_|</td>
                                <td width="5%">|_|</td>
                                <td width="10%">|_|_|_|,|_|_|</td>
                            </tr>
                        <?php endfor; ?>

                    </table>
                </div>
            </div>

            <!--    IDENTIFICACAO DOS PROFISSIONAIS EXECUTANTES-->
            <div class="section-title">Identificação do(s) Profissional(is) Executante(s)</div>
            <div class="rp-row">
                <div class="rp-box">
                    <table>

                        <tr class="tb-title">
                            <td>48 - Seq. Ref</td>
                            <td>49 - Grau Part</td>
                            <td>50 - Codigo da Operadora/CPF</td>
                            <td>51 - Nome do Profissional</td>
                            <td>52 - Conselho do Profissional</td>
                            <td>53 - Descrição</td>
                            <td>54 - UF</td>
                            <td>55 - Código CBO</td>
                        </tr>

                        <?php for ($i = 1; $i < 5; $i++) : ?>
                            <tr>
                                <td width="5%"><span class="text-tiny"><?= $i ?></span></td>
                                <td width="5%">|_|_|</td>
                                <td width="15%">|_|_|_|_|_|_|_|_|_|_|_|_|_|_|</td>
                                <td width="10%">________________________________</td>
                                <td width="10%">|_|_|</td>
                                <td width="30%">___________________________________________________</td>
                                <td width="7%">|_|_|_|_|_|_|_|_|_||_|</td>
                                <td width="5%">|_|_|</td>
                                <td width="5%">|_|_|_|_|_|_|</td>
                            </tr>
                        <?php endfor; ?>

                    </table>
                </div>
            </div>

            <div class="rp-row" style="padding-top: 2px;">
                <div class="rp-box">
                    <table>
                        <tr class="tb-title">
                            <td>56 - Seq. Ref</td>
                            <td>57 - Grau Part</td>

                        </tr>
                        <?php for ($i = 1; $i < 3; $i++) : ?>
                            <tr>
                                <td width="5%"><span class="text-tiny"><?= $i ?></span></td>
                                <td width="5%">|_|_|</td>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </div>
            </div>
            <div class="rp-row" style="padding-top: 2px;">
                <div class="rp-field rp-field-full rp-gray ">
                    <div class="rp-field-label">58 - Observação</div>
                    <div class="rp-field-value rp-field-textarea ">
                            <?= $model->note ?>
                    </div>
                </div>
            </div>

            <div class="rp-row">
                <div class="rp-field rp-field-p-10">
                    <div class="rp-field-label">59 - Total do Procedimento R$</div>
                    <div class="rp-field-value">

                    </div>
                </div>
                <div class="rp-field rp-field-p-10">
                    <div class="rp-field-label">60 - Total Taxas e Aluguéis R$</div>
                    <div class="rp-field-value">

                    </div>
                </div>
                <div class="rp-field rp-field-p-15">
                    <div class="rp-field-label">61 - Total Materiais R$</div>
                    <div class="rp-field-value">

                    </div>
                </div>
                <div class="rp-field rp-field-p-12">
                    <div class="rp-field-label">62 - Total OPME R$</div>
                    <div class="rp-field-value">

                    </div>
                </div>
                <div class="rp-field rp-field-p-15">
                    <div class="rp-field-label">63 - Total Medicamentos</div>
                    <div class="rp-field-value">

                    </div>
                </div>
                <div class="rp-field rp-field-p-25">
                    <div class="rp-field-label">64 - Total Gases Medicinais</div>
                    <div class="rp-field-value">

                    </div>
                </div>
                <div class="rp-field rp-field-p-12" style="width: 183px;">
                    <div class="rp-field-label">65 - Total Geral R$</div>
                    <div class="rp-field-value">

                    </div>
                </div>

            </div>
            <div class="rp-row">
                <div class="rp-field rp-field-p-33">
                    <div class="rp-field-label">66 - Assinatura do Responsável pela Autorização</div>
                    <div class="rp-field-value">

                    </div>
                </div>
                <div class="rp-field rp-field-p-33">
                    <div class="rp-field-label">67 - Assinatura do beneficiário ou Responsável</div>
                    <div class="rp-field-value">

                    </div>
                </div>
                <div class="rp-field rp-field-p-33" style="width: 384px">
                    <div class="rp-field-label">68 - Assinatura do contrato</div>
                    <div class="rp-field-value">

                    </div>
                </div>
            </div>
            <div class="content-bottom">
                Criado em <?= Yii::$app->formatter->asDatetime($model->created_at, 'php:d/m/Y, Y, H:i:s') ?>,
              
                última modificação <?= Yii::$app->formatter->asDatetime($model->updated_at, 'php:d/m/Y, Y, H:i:s') ?>
            </div>
        </div>
    </div>
</div>