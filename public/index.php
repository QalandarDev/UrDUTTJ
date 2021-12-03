<?php

//header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
//header('Access-Control-Allow-Origin: 195.158.31.182');
//header('Access-Control-Allow-Origin: https://urdu.uz');
//header('Access-Control-Allow-Credentials: true');
require __DIR__ . '/../config/bootstrap.php';

$config = require __DIR__ . '/../config/main.php';

(new yii\web\Application($config))->run();
