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
            <th class="file">Tipo de internação</th>
            <th class="file">Data da autorização</th>
            <th class="file">Paciente</th>
            <th class="file">Operadora</th>
            <?php
            $hasInternacao = !empty($internments);
            if ($hasInternacao) {
                echo '<th><input type="checkbox" id="check-all"></th>';
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        
        <?php foreach ($internments as $internment): ?>

            <tr>
                <td> <?= Html::a('# ' . $i++, ['/internment/view/', 'id' => $internment->id], ['target' => 'blank']); ?></td>
                <td class="file">
                    <?= $internment->number_form_assigned_operator; ?>
                </td>
                <td>
                    <?= $internment->getTypeName(); ?>
                </td>
                <td class="action">
                    <?= date('d/m/Y', strtotime($internment->authorization_date)); ?>
                </td>
                <td>
                    <?= $internment->patient->name ?>
                </td>

                <td><?= $internment->operator->name ?></td>
                <td class="check">
                    <?=
                    Html::checkBox("answers[{$internment->id}]", isset($answers) ? isset($answers[$internment->id]) : '');
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>

