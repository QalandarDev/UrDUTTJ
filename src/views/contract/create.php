<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TtjShartnoma */

$this->title = Yii::t('app', 'Create Ttj Shartnoma');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ttj Shartnomas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ttj-shartnoma-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
