<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => "pgsql:host=".getenv('DB_HOST').";port=".getenv('DB_PORT').";dbname=".getenv('DB_NAME'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASS'),
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql' => [
          'class' => 'yii\db\pgsql\Schema',
          'defaultSchema' => 'public' //specify your schema here, public is the default schema
        ]
    ]

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
