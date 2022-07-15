<?php

use yii\helpers\Html;

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
            $hasData = !empty($diagnostics);
            if ($hasData) {
                echo '<th><input type="checkbox" id="check-all"></th>';
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach ($diagnostics  as $diagnostic): ?>
            
            <tr>
                <td> <?= Html::a('# ' . $i++, ['/diagnostic/view/', 'id' => $diagnostic->id], ['target' => 'blank']); ?></td>
                <td class="file">
                    <?= $diagnostic->number_form_assigned_operator; ?>
                </td>
               
                <td class="action">
                    <?= date('d/m/Y', strtotime($diagnostic->authorization_date)); ?>
                </td>
                <td>
                    <?= $diagnostic->patient->name ?>
                </td>

                <td><?= $diagnostic->operator->name ?></td>
                <td class="check">
                    <?=
                    Html::checkBox("answers[{$diagnostic->id}]", isset($answers) ? isset($answers[$diagnostic->id]) : '');
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

