<?php

use yii\helpers\Html;

$this->title = 'Cadastrar Lote de Diagnóstico';
$this->params['breadcrumbs'][] = ['label' => 'Lotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lote-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search_diagnostics', ['model' => $search]); ?>
    <?php if (isset($error_message)) : ?>
        <h4 class="text-danger text-center" style="text-transform: uppercase"><?= $error_message ?></h4>
    <?php endif; ?>
    <?php
    if ($showForm) {
        echo $this->render('_form_diag', [
            'model' => $model,
            'diagnostics' => $diagnostics,
            'answers' => $answers
        ]);
    }
    ?>
</div>