<?php

namespace app\controllers\base;

use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\AccessControl;
use yii\web\IdentityInterface;
use yii\web\NotFoundHttpException;
use Yii\web\Response;

class Controller extends \yii\web\Controller
{

    protected function addSuccess(string $msg, array $params = []): void
    {
        Yii::$app->getSession()->addFlash('success', __($msg, $params));
    }

    protected function addError(string $msg, array $params = []): void
    {
        Yii::$app->getSession()->addFlash('error', __($msg, $params));
    }

    protected function addWarning(string $msg, array $params = []): void
    {
        Yii::$app->getSession()->addFlash('warning', __($msg, $params));
    }

    protected function addInfo(string $msg, array $params = []): void
    {
        Yii::$app->getSession()->addFlash('info', __($msg, $params));
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function notFound(string $msg = null, array $params = []): void
    {
        throw new NotFoundHttpException(__($msg, $params));
    }

}
