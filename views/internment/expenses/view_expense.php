<?php

use app\assets\CustomAsset;
use yii\helpers\Html;

CustomAsset::register($this);

use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Despesa */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Internment'), 'url' => ["internment/view/", 'id'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title;

function formatMoney($val)
{
    if (empty($val)) {
        $val = 0;
    }
    $val = str_replace(".", ',', sprintf("%.2f", $val));
    return 'R$ ' . $val;
}

;

function formatDate($date)
{
    if (empty($date))
        return '';

    return date('d/m/Y', strtotime($date));
}


?>
<style>


    .rp-box table td {
        font-size: 10px;
        padding: 5px;
        font-weight: 400;
        /*text-transform: uppercase;*/
        text-align: left;
    }

    tbody tr:nth-child(odd) {
        background-color: #ccc;
    }
</style>
<div class="despesa-view">
    <h3 class="section-title" style="text-align: center">ANEXO DE OUTRAS DESPESAS</h3>
    <h5 class="text-center">(Internação <?= $model->id ?>) </h5>
    <div class="rp-ficha-actions">

        <?= Html::a('Atualizar', ["/internment/manage-expense",
            'id' => $model->id],
            ['class' => 'btn btn-md btn-primary']); ?>


    </div>
    <div class="rp-content scrolly">
        <div class="rp-row">
            <div class="rp-field rp-field-p-15">
                <div class="rp-field-label">1 - Registro ANS</div>
                <div class="rp-field-value">
                    <?= $model->operator->ans_code; ?>
                </div>
            </div>

            <div class="rp-field rp-field-p-25">
                <div class="rp-field-label">2 - Número Guia Referenciada</div>
                <div class="rp-field-value">
                    <?= $model->provider_form_number; ?>
                </div>
            </div>
        </div>
        <!--    DADOS DO CONTRATADO EXECUTANTE-->
        <div class="section-title">Dados do Contratado Executante</div>
        <div class="rp-row">
            <div class="rp-field rp-field-p-20">
                <div class="rp-field-label">3 - Código na Operadora</div>
                <div class="rp-field-value">
                    <?= $model->hospitalAuthorized->cnpj; ?>
                </div>
            </div>

            <div class="rp-field rp-field-p-35">
                <div class="rp-field-label">4 - Nome do Contratado</div>
                <div class="rp-field-value">
                    <?= $model->hospitalAuthorized->name; ?>
                </div>
            </div>
            <div class="rp-field rp-field-p-15">
                <div class="rp-field-label">5 - Código CNES</div>
                <div class="rp-field-value">
                    <?= $model->cnes_code; ?>
                </div>
            </div>
        </div>

        <!--    SECTION DESPESAS REALIZADAS-->
        <div class="section-title">Despesas realizadas</div>
        <div class="rp-box">
            <table>

                <tr class="tb-title" style="background-color: #F5F5F5">
                    <td width="10%">6 - CD</td>
                    <td width="10%">7 - Data</td>
                    <td width="10%">8 - Hora inicial</td>
                    <td width="10%">9 - Hora final</td>
                    <td width="10%">10 - Tabela</td>
                    <td width="10%">11 - Código do Item</td>
                    <td width="10%">12 - Qtde</td>
                    <td width="10%">13 - Unidade de medida</td>
                    <td width="10%">14 - Fator Red.</td>
                    <td width="10%">15 - Valor Unitario</td>
                    <td width="10%">16 - Valor Total-R$</td>


                </tr class="tb-title">
                <tr>
                    <td colspan="3">17 - Registro ANVISA do material</td>
                    <td colspan="5">18 - Referência do material no fabricante</td>
                    <td colspan="6">19 - N Autorização de Funcionamento</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php $total_medicines = 0.0; ?>
                <?php $total_materiais = 0.0; ?>
                <?php $total_procedimentos = 0.0; ?>
                <?php $total_geral = 0.0; ?>

                <?php foreach ($model->expense as $i => $expense): ?>
                    <!-- MEDICAMENTOS -->
                    <?php if (!empty($expense->medicine)): ?>
                        <tr class="rp-body">

                            <td width="10%">
                            <span class="text-tiny" style="font-weight: bold"><?= $i + 1 ?>
                                - </span> <?= $expense->cd ?> </span>
                            </td>

                            <td width="7%"><span class="text-mini"></span> <?= formatDate($expense->date) ?></td>
                            <td width="10%"><span class="text-mini"></span> <?= $expense->start_time ?></td>
                            <td width="10%"><span class="text-mini"></span> <?= $expense->end_time ?></td>
                            <td width="10%"><span class="text-mini"></span> </td>
                            <td width="10%"><span class="text-mini"></span> <?= $expense->medicine->cod_tiss ?></td>
                            <td width="10%"><span class="text-mini"></span> <?= $expense->amount ?></td>
                            <td width="10%"><span class="text-mini"></span> <?= $expense->medicine->und ?></td>
                            <td width="10%"><span class="text-mini"></span> </td>
                            <!--                            depois mudar, o valor tem que vir de despesa-->
                            <td width="20%"><span
                                        class="text-mini"></span><?= formatMoney($expense->medicine->price) ?>
                            </td>
                            <td>
                                <span class="text-mini"></span><?= formatMoney($expense->medicine->price * $expense->amount) ?>
                                <?php $total_medicines += ($expense->medicine->price * $expense->amount); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="5"><?= $expense->medicine->description ?></td>
                            <td colspan="6"></td>
                        </tr>
                    <?php endif; ?>
                    <!-- MATERIAIS -->
                    <?php if (!empty($expense->supply)): ?>
                        <tr class="rp-body">
                            <td width="10%">
                            <span class="text-tiny" style="font-weight: bold"><?= $i + 1 ?>
                                - </span> <?= $expense->cd ?> </span>
                            </td>

                            <td width="7%"><span class="text-mini"></span> <?= formatDate($expense->date) ?></td>
                            <td><span class="text-mini"></span> <?= $expense->start_time ?></td>
                            <td><span class="text-mini"></span> <?= $expense->end_time ?></td>
                            <td><span class="text-mini"></span> </td>
                            <td><span class="text-mini"></span> </td>
                            <td><span class="text-mini"></span> <?= $expense->amount ?></td>
                            <td><span class="text-mini"></span> <?= $expense->supply->und ?></td>
                            <td><span class="text-mini"></span> </td>
                            <!--                            depois mudar, o valor tem que vir de despesa-->
                            <td><span class="text-mini"></span><?= formatMoney($expense->unit_price) ?>
                            </td>
                            <td>
                                <span class="text-mini"></span><?= formatMoney($expense->unit_price * $expense->amount) ?>
                                <?php $total_materiais += ($expense->unit_price * $expense->amount); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="5"><?= $expense->supply->description ?></td>
                            <td colspan="6"></td>
                        </tr>
                    <?php endif; ?>
                    <!-- PROCEDIMENTOS -->
                    <?php if (!empty($expense->procedure)): ?>
                        <tr class="rp-body">
                            <td width="10%">
                            <span class="text-tiny" style="font-weight: bold"><?= $i + 1 ?>
                                - </span> <?= $expense->cd ?> </span>
                            </td>

                            <td width="7%"><span class="text-mini"></span> <?= formatDate($expense->date) ?></td>
                            <td><span class="text-mini"></span> <?= $expense->start_time ?></td>
                            <td><span class="text-mini"></span> <?= $expense->end_time ?></td>
                            <td><span class="text-mini"></span></td>
                            <td><span class="text-mini"></span></td>
                            <td><span class="text-mini"></span> <?= $expense->amount ?></td>
                            <td><span class="text-mini"></span></td>
                            <td><span class="text-mini"></span></td>
                            <!--                            depois mudar, o valor tem que vir de despesa-->
                            <td><span class="text-mini"></span><?= formatMoney($expense->unit_price) ?>
                            </td>
                            <td>
                                <span class="text-mini"></span><?= formatMoney($expense->unit_price * $expense->amount) ?>
                                <?php $total_procedimentos += ($expense->unit_price * $expense->amount); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="5"><?= $expense->procedure->description ?></td>
                            <td colspan="6"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
        <?php $total_geral = $total_medicines + $total_procedimentos + $total_materiais; ?>
        <div class="rp-row">
            <div class="rp-field rp-field-p-15  ">
                <div class="rp-field-label">21 - Totais de gastos medicinais</div>
                <div class="rp-field-value">

                </div>
            </div>

            <div class="rp-field rp-field-p-15  ">
                <div class="rp-field-label">22 - Total Medicamentos</div>
                <div class="rp-field-value">
                    <?= formatMoney($total_medicines) ?>
                </div>
            </div>
            <div class="rp-field rp-field-p-15  ">
                <div class="rp-field-label">23 - Total Materiais (R$)</div>
                <div class="rp-field-value">
                    <?= formatMoney($total_materiais) ?>
                </div>
            </div>
            <div class="rp-field rp-field-p-15  ">
                <div class="rp-field-label">24 - Total de OPME</div>
                <div class="rp-field-value">

                </div>
            </div>
            <div class="rp-field rp-field-p-15 ">
                <div class="rp-field-label">25 - Total de Taxas e Alugueis</div>
                <div class="rp-field-value">

                </div>
            </div>
            <div class="rp-field rp-field-p-10 " style="width:141px">
                <div class="rp-field-label">26 - Total de diárias (R$)</div>
                <div class="rp-field-value">
                    <?= formatMoney($total_procedimentos) ?>
                </div>
            </div>
            <div class="rp-field rp-field-p-15 ">
                <div class="rp-field-label">27 - Total Geral (R$)</div>
                <div class="rp-field-value">
                    <?= formatMoney($total_geral) ?>
                </div>
            </div>

        </div>
    </div>
</div>

