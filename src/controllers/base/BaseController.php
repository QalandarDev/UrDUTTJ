<?php

namespace app\controllers\base;

use yii\filters\auth\CompositeAuth;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\web\Response;

class BaseController extends \yii\rest\Controller
{
    public function behaviors(): array
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::class,
                'actions' => $this->verbs(),
            ],

            'rateLimiter' => [
                'class' => RateLimiter::class,
            ],
            'corsFilter'=>[
                'class' => \yii\filters\Cors::class,
                'cors' => [
                    'Access-Control-Allow-Origin' => [''],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 86400,
                    'Access-Control-Expose-Headers' => [],
                ]
            ],
//            'authenticator' => [
//                'class' => CompositeAuth::class,
//            ],

        ];
    }
}