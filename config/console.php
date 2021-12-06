<?php

use yii\console\controllers\MigrateController;
use yii\redis\Connection;
use yii\log\FileTarget;
use yii\caching\FileCache;

$params = require __DIR__ . '/params.php';
$definitions = require __DIR__ . '/definitions.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'yii2-console',
    'basePath' => '@app',
    'runtimePath' => '@runtimePath/console',
    'vendorPath' => '@vendorPath',
    'bootstrap' => ['log', 'queue'],
    'controllerNamespace' => 'app\console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'container' => [
        'definitions' => $definitions,
    ],
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'redis' => [
            'class' => Connection::class,
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            // Other driver options
        ],
    ],
    'params' => $params,


    'controllerMap' => [
//        'fixture' => [ // Fixture generation command line.
//            'class' => 'yii\faker\FixtureController',
//        ],
        'migrate' => [
            'class' => MigrateController::class,
            'migrationPath' => '@migrationPath',
            'migrationTable' => "bot.migration",
        ],
    ],

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'templates' =>[
                    'default' => '@app/components/gii/model'
                ]
            ],
        ],
    ];
}

return $config;
