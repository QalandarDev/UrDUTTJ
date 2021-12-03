<?php

namespace app\components\web;


use Yii;
use yii\helpers\Url;
use Closure;
class View extends \yii\web\View
{
    public function ColumnTitle(string $column): Closure
    {
        return static fn($model): array => ['title' => $model->$column];
    }

    public function getMenuItems(): array
    {
        $menuList = Yii::$app->params['mainMenu'];
        foreach ($menuList as $id => &$item) {
            $item['label'] = __(trim($item['label']));
            if (isset($item['items']) && !empty($item['items'])) {
                foreach ($item['items'] as $p => &$childItem) {
//                    if (!$this->_user()->canAccessToResource($childItem['url'])) {
//                        unset($menuList[$id]['items'][$p]);
//                    }
                    $childItem['label'] = $resources[$childItem['url']] ?? __($childItem['label']);
                    $childItem['id'] = $childItem['url'];
                    $childItem['url'] = [$childItem['url']];
                }
                if (count($item['items']) === 0) {
                    unset($menuList[$id]);
                }
            }
            if ((!isset($item['items']) || count($item['items']) === 0)) {
                unset($menuList[$id]);
            }
            $item['id'] = trim($item['url'], '/');
            $item['url'] = Url::to([$item['url']]);
        }

        return $menuList;
    }
}

