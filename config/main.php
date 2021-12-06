<?php

use yii\log\FileTarget;
use app\models\forms\User;
use yii\caching\FileCache;

/* @var $rootPath string */

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$definitions = require __DIR__ . '/definitions.php';
$routes = require __DIR__ . '/routes.php';

$config = [
    'id' => 'talim.urdu.uz',
    'basePath' => '@app',
    'runtimePath' => '@runtimePath',
    'vendorPath' => '@vendorPath',
    'language' => 'uz',
    'bootstrap' => ['log', 'queue'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'container' => [
        'definitions' => $definitions,
    ],
    'homeUrl' => '/',
    'modules'=>[

    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Cpi_vU33Ko1on8zujdmeI9FyOc1oUDEX',
        ],
        'darsjadvalbot' => [
            'class' => 'aki\telegram\Telegram',
            'botToken' => '2120273228:AAGjh_VWhGWzBNUNMdM9IcenrnsDNApZ6fc',
        ],
        'cache' => [
            'class' => FileCache::class,
        ],
        'user' => [
            'class' => \yii\web\User::class,
            'identityClass' => \app\models\User::class,
            'enableAutoLogin' => true,
        ],
        'view' => [
            'class' => \app\components\web\View::class,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $routes,
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            // Other driver options
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@messagesPath',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
