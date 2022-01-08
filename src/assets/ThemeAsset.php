<?php
/**
 * @copyright Copyright (c) 2015 Yiister
 * @license https://github.com/yiister/yii2-gentelella/blob/master/LICENSE
 * @link http://gentelella.yiister.ru
 */

namespace app\assets;

use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class ThemeAsset extends AssetBundle
{
    public $depends = [
        YiiAsset::class,
        BootstrapPluginAsset::class,
        \rmrevin\yii\fontawesome\AssetBundle::class,
        BootstrapProgressbar::class,
        ThemeBuildAsset::class,
        ThemeSrcAsset::class,
    ];
}
