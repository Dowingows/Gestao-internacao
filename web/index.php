<?php

// comment out the following two lines when deployed to production
// defined('YII_DEBUG') or define('YII_DEBUG', true);
// defined('YII_ENV') or define('YII_ENV', 'dev');
print_r('hellow world');
die;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// LOAD ENV vars
$dotenv =  \Dotenv\Dotenv::createImmutable(__DIR__,'../.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
