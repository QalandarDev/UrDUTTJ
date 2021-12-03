<?php

use app\widgets\NotificationDefault;
use yii\base\Event;
use yii\base\Widget;
use yii\helpers\VarDumper;
use yii\web\View;
use yii\widgets\Pjax;

$rootPath = dirname(__DIR__);

require $rootPath . '/vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createUnsafeImmutable($rootPath);
$dotenv->load();

defined('YII_DEBUG') or define('YII_DEBUG', getenv('YII_ENV') === 'dev');
defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV'));
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
define('HTTPS_ON', isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] === 443);
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $_SERVER['HTTPS'] = 'on';
}

require $rootPath . '/vendor/yiisoft/yii2/Yii.php';

Yii::setAlias('@app', $rootPath . '/src');
Yii::setAlias('@runtimePath', $rootPath . '/var');
Yii::setAlias('@vendorPath', $rootPath . '/vendor');
Yii::setAlias('@migrationPath', $rootPath . '/src/console/migrations');
Yii::setAlias('@messagesPath', $rootPath . '/messages');

Yii::setAlias('@uploads', $rootPath . '/web/uploads');


function dd(...$variables)
{
    foreach ($variables as $variable) {
        VarDumper::dump($variable, 10, true);
    }
    exit();
}

function __(string $message, array $params = [], string $lang = null): string
{
    return Yii::t('app', $message, $params, $lang);
}

function registerNotifications()
{
    if (Yii::$app->has('session')) {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();

        foreach ($flashes as $type => $data) {
            $data = (array)$data;
            foreach ($data as $i => $message) {

                NotificationDefault::widget([
                    'type' => $type,
                    'message' => $message,
                    'options' => [
                        "closeButton" => false,
                        "debug" => false,
                        "newestOnTop" => false,
                        "progressBar" => false,
                        "positionClass" => NotificationDefault::POSITION_BOTTOM_RIGHT,
                        "preventDuplicates" => false,
                        "onclick" => null,
                        "showDuration" => "300",
                        "hideDuration" => "1000",
                        "timeOut" => $type == 'error' ? "100000" : "10000",
                        "extendedTimeOut" => "1000",
                        "showEasing" => "swing",
                        "hideEasing" => "linear",
                        "showMethod" => "fadeIn",
                        "hideMethod" => "fadeOut"
                    ]
                ]);
            }
            $session->removeFlash($type);
        }
    }
}


Event::on(View::class, \yii\base\View::EVENT_AFTER_RENDER, function ($event) {
    registerNotifications();
});

Event::on(Pjax::class, Widget::EVENT_BEFORE_RUN, function ($event) {
    registerNotifications();
});


