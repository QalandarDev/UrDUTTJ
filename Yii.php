<?php

use app\components\web\User;
use yii\base\InvalidConfigException;


/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property \app\components\web\View $view The user component. This property is read-only. Extended component.
 * @property User $user The user component. This property is read-only. Extended component.
 */
class WebApplication extends yii\web\Application
{
    /**
     * Returns the user component.
     * @return User the user component.
     * @throws InvalidConfigException
     */
    public function getUser(): User
    {
        return $this->get('user');
    }
}

/**
 * Class ConsoleApplication
 * Include only Console application related components here
 *
 */
class ConsoleApplication extends yii\console\Application
{
}
