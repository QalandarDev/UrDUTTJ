<?php

use yii\db\pgsql\Schema;
use yii\db\Connection;

return [
    'class' => Connection::class,
    'dsn' => getenv('DB_DSN'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql'=> [
            'class'=> Schema::class,
            'defaultSchema' => 'ttj' //specify your schema here
        ]
    ], // PostgreSQL

    // Schema cache options (for production environment)
//    'enableSchemaCache' => true,
//    'schemaCacheDuration' => 60,
//    'schemaCache' => 'cache',
];
