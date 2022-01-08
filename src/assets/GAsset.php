<?php
/**
 * @copyright Copyright (c) 2015 Yiister
 * @license https://github.com/yiister/yii2-gentelella/blob/master/LICENSE
 * @link http://gentelella.yiister.ru
 */

namespace app\assets;

use yii\web\AssetBundle;

class GAsset extends AssetBundle
{
    public $depends = [
        ThemeAsset::class,
        ExtensionAsset::class,
    ];
}
