<?php
/**
 * @copyright Copyright (c) 2015 Yiister
 * @license https://github.com/yiister/yii2-gentelella/blob/master/LICENSE
 * @link http://gentelella.yiister.ru
 */

namespace app\assets;

use yii\web\AssetBundle;

class ExtensionAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/';
    public $js = [
        'js/extension.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
