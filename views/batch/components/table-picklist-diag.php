<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $generator \yii\gii\Generator */
/* @var $files CodeFile[] */
/* @var $answers array */
/* @var $id string panel ID */

?>
<div class="default-view-files">

    <p>Selecione as <code>Fichas</code> para a geração do <code>Lote</code></p>

    <table class="table table-bordered table-striped table-condensed">
        <thead>
        <tr>
            <th></th>
            <th class="file">Número da Guía</th>
            <th class="file">Data da autorização</th>
            <th class="file">Paciente</th>
            <th class="file">Operadora</th>
            <?php
            $hasDiag = count($diagnosticos) > 0;
            if ($hasDiag) {
                echo '<th><input type="checkbox" id="check-all"></th>';
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach ($diagnosticos as $diagnostico): ?>
            <tr>
                <td> <?= Html::a('# ' . $i++, ['/diagnosticos/view/', 'id' => $diagnostico->id], ['target' => 'blank']); ?></td>
                <td class="file">
                    <?= $diagnostico->num_guia_atribuido_operadora; ?>
                </td>

                <td class="action">
                    <?= date('d/m/Y', strtotime($diagnostico->data_autorizacao)); ?>
                </td>
                <td>
                    <?= $diagnostico->paciente->nome ?>
                </td>

                <td><?= $diagnostico->operadora->nome ?></td>
                <td class="check">
                    <?=
                    Html::checkBox("answers[{$diagnostico->id}]", isset($answers) ? isset($answers[$diagnostico->id]) : '');
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

