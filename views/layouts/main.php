<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    $navColor = getenv('PROD') == null || getenv('PROD') != 'true' ? 'danger' : 'dark';
    NavBar::begin([
        'brandLabel' => getenv('APP_NAME'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => "navbar navbar-expand-md navbar-dark bg-{$navColor} fixed-top",
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => Yii::t('app','Forms'), 'items' => [
                ['label' => Yii::t('app','Diagnostics'), 'url' => ['/diagnostic/index']],
                ['label' => Yii::t('app','Internments'), 'url' => ['/internment/index']],

            ]],
            ['label' => Yii::t('app','Tables'), 'items' => [
                ['label' => Yii::t('app','Professionals'), 'url' => ['/professional/index']],
                ['label' => Yii::t('app','Patients'), 'url' => ['/patient/index']],
                ['label' => Yii::t('app','Medicines'), 'url' => ['/medicine/index']],
                ['label' => Yii::t('app','Procedures'), 'url' => ['/procedure/index']],
                ['label' => Yii::t('app','Supplies'), 'url' => ['/supply/index']]
            ]],
            ['label' => Yii::t('app','Entities'), 'items' => [
                ['label' => Yii::t('app','Hospitals'), 'url' => ['/hospital/index']],
                ['label' => Yii::t('app','Operators'), 'url' => ['/operator/index']],
            ]],
            ['label' => Yii::t('app','Batches'), 'url' => ['/batch/index']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
    ]]);
    NavBar::end();
    ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; BlueInsight <?= date('Y') ?></p>
    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
