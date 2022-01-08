<?php
/**
 * @copyright Copyright (c) 2015 Yiister
 * @license https://github.com/yiister/yii2-gentelella/blob/master/LICENSE
 * @link http://gentelella.yiister.ru
 */

namespace app\assets;

use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;

class BootstrapProgressbar extends AssetBundle
{
    public $sourcePath = '@app/assets/js';
    public $css = [
//        'css/custom.css',
    ];
    public $js = [
        'bootstrap-progressbar.min.js',
    ];
    public $depends = [
        BootstrapPluginAsset::class,
    ];
}