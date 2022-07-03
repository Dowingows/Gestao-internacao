<?php

/** @var yii\web\View $this */

$this->title = 'Página Inicial';

use yii\helpers\Html;


?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Seja bem-vindo! </h1>

        <p class="lead">Sistema de gestão de Fichas de Internação e Diagnóstico</p>

        <p><?= Html::a('Internações', ['/internment/index'], ['class' => 'btn btn-lg btn-info']); ?></p>
        <p><?= Html::a('Diagnósticos', ['/diagnostic/index'], ['class' => 'btn btn-lg btn-success']); ?></p>
    </div>
</div>
