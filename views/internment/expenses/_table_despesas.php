<?php use yii\helpers\Html;

?>

<div class="header">
    <div class="wrap-logo" style="float:left;width: 300px;">
        <?php if ($model->operadora->registro_ans == 323080): ?>
            <?= Html::img('@web/img/logo-geap.png'); ?>
        <?php elseif ($model->operadora->registro_ans == 412538): ?>
            <?= Html::img('@web/img/logo.jpg'); ?>
        <?php endif; ?>
    </div>
    <div class="wrap-title" style="width: 450px; text-align: center;">
        <h1 style="text-transform: uppercase;font-size: 18px; font-weight: 700;">
            Anexo de outras despesas </h1>
    </div>
    <div class="" style="width: 95px;">

    </div>
</div>

<div class="content-land">
    <div class="rp-row">
        <div class="rp-field rp-field-p-15">
            <div class="rp-field-label">1 - Registro ANS</div>
            <div class="rp-field-value">
                <?= $model->operadora->registro_ans; ?>
            </div>
        </div>

        <div class="rp-field rp-field-p-25">
            <div class="rp-field-label">2 - Número Guia Referenciada</div>
            <div class="rp-field-value">
                <?= $model->num_guia_prestador; ?>
            </div>
        </div>
    </div>
    <!--    DADOS DO CONTRATADO EXECUTANTE-->
    <div class="section-title">Dados do Contratado Executante</div>
    <div class="rp-row">
        <div class="rp-field rp-field-p-20">
            <div class="rp-field-label">3 - Código na Operadora</div>
            <div class="rp-field-value">
                <?= $model->hospitalAutorizado->cnpj; ?>
            </div>
        </div>

        <div class="rp-field rp-field-p-35">
            <div class="rp-field-label">4 - Nome do Contratado</div>
            <div class="rp-field-value">
                <?= $model->hospitalAutorizado->nome; ?>
            </div>
        </div>
        <div class="rp-field rp-field-p-15">
            <div class="rp-field-label">5 - Código CNES</div>
            <div class="rp-field-value">
                <?= $model->hospitalAutorizado->codigo_cnes; ?>
            </div>
        </div>
    </div>

    <!--    SECTION DESPESAS REALIZADAS-->
    <div class="section-title">Despesas realizadas</div>

    <div class="rp-box" style="height: 450px">
        <table>

            <tr class="tb-title" style="background-color: #F5F5F5">
                <td>6 - CD</td>
                <td>7 - Data</td>
                <td>8 - Hora inicial</td>
                <td>9 - Hora final</td>
                <td>10 - Tabela</td>
                <td>11 - Código do Item</td>
                <td>12 - Qtde</td>
                <td>13 - Unidade de medida</td>
                <td>14 - Fator Red.</td>
                <td>15 - Valor Unitario</td>
                <td>16 - Valor Total-R$</td>


            </tr>
            <tr class="tb-title">
                <td colspan="3">17 - Registro ANVISA do material</td>
                <td colspan="5">18 - Referência do material no fabricante</td>
                <td colspan="6">19 - N Autorização de Funcionamento</td>

            </tr>



            <?php foreach ($despesas as $i => $despesa): ?>
                <!-- MEDICAMENTOS -->
                <?php if (!empty($despesa->medicamento)): ?>
                    <tr class="rp-body">

                        <td width="10%">
                            <span class="" style="font-weight: bold"><?= $i + 1 ?>
                                - </span> <?= $despesa->cd ?> </span>
                        </td>

                        <td width="7%"><span></span> <?= formatDate($despesa->data) ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->hora_inicio ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->hora_final ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->medicamento->tabela ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->medicamento->cod_tiss ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->qtd ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->medicamento->und ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->fator_red_acresc ?></td>
                        <!--                            depois mudar, o valor tem que vir de despesa-->
                        <td><span class="text-mini"></span><?= formatMoney($despesa->medicamento->valor) ?>
                        </td>
                        <td>
                            <span class="text-mini"></span><?= formatMoney($despesa->medicamento->valor * $despesa->qtd) ?>

                        </td>
                    </tr>
                    <tr class="rb-odd-body">
                        <td colspan="3"></td>
                        <td colspan="5"><?= $despesa->medicamento->descricao ?></td>
                        <td colspan="6"></td>
                    </tr>
                <?php endif; ?>
                <!-- MATERIAIS -->
                <?php if (!empty($despesa->material)): ?>
                    <tr class="rp-body">
                        <td width="10%">
                            <span class="text-tiny" style="font-weight: bold"><?= $i + 1 ?>
                                - </span> <?= $despesa->cd ?> </span>
                        </td>

                        <td width="7%"><span class="text-mini"></span> <?= formatDate($despesa->data) ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->hora_inicio ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->hora_final ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->material->tabela ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->material->cod_tiss ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->qtd ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->material->und ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->fator_red_acresc ?></td>
                        <!--                            depois mudar, o valor tem que vir de despesa-->
                        <td><span class="text-mini"></span><?= formatMoney($despesa->valor_unitario) ?>
                        </td>
                        <td>
                            <span class="text-mini"></span><?= formatMoney($despesa->valor_unitario * $despesa->qtd) ?>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="5"><?= $despesa->material->descricao ?></td>
                        <td colspan="6"></td>
                    </tr>
                <?php endif; ?>
                <!-- PROCEDIMENTOS -->
                <?php if (!empty($despesa->procedimento)): ?>
                    <tr class="rp-body">
                        <td width="10%">
                            <span class="text-tiny" style="font-weight: bold"><?= $i + 1 ?>
                                - </span> <?= $despesa->cd ?> </span>
                        </td>

                        <td width="7%"><span class="text-mini"></span> <?= formatDate($despesa->data) ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->hora_inicio ?></td>
                        <td><span class="text-mini"></span> <?= $despesa->hora_final ?></td>
                        <td><span class="text-mini"></span></td>
                        <td><span class="text-mini"></span></td>
                        <td><span class="text-mini"></span> <?= $despesa->qtd ?></td>
                        <td><span class="text-mini"></span></td>
                        <td><span class="text-mini"></span> <?= $despesa->fator_red_acresc ?></td>
                        <!--                            depois mudar, o valor tem que vir de despesa-->
                        <td><span class="text-mini"></span><?= formatMoney($despesa->valor_unitario) ?>
                        </td>
                        <td>
                            <span class="text-mini"></span><?= formatMoney($despesa->valor_unitario * $despesa->qtd) ?>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="5"><?= $despesa->procedimento->descricao ?></td>
                        <td colspan="6"></td>
                    </tr>
                <?php endif; ?>


            <?php endforeach; ?>
        </table>


    </div>


</div>