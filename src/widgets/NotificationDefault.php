<?php

namespace app\widgets;

use lavrentiev\widgets\toastr\Notification as NotificationBase;
use lavrentiev\widgets\toastr\ToastrAsset;
use yii\base\InvalidConfigException;
use yii\helpers\Json;

class NotificationDefault extends NotificationBase
{
    /**
     * @throws InvalidConfigException
     */
    public function init(): void
    {
        $this->view->registerAssetBundle(ToastrAsset::class);

        $this->title = is_string($this->title) ? Json::encode(['m' => $this->title]) : Json::encode(['m' => null]);

        $this->message = is_string($this->message) ?
            Json::encode(['m' => $this->message]) : Json::encode(['m' => $this->messageDefault]);

        $this->options = is_array($this->options) ?
            Json::encode($this->options) : Json::encode([]);
    }

    /**
     * @return string|void
     */
    public function run()
    {
        if (in_array($this->type, $this->types, true)) {
            return $this->view->registerJs("toastr.{$this->type}({$this->message}.m, {$this->title}.m, {$this->options});");
        }

        return $this->view->registerJs("toastr.{$this->typeDefault}({$this->message}.m, {$this->title}.m, {$this->options});");
    }
}
