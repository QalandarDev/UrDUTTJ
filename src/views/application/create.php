<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TtjAriza */

$this->title = Yii::t('app', 'Create Ttj Ariza');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ttj Arizas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ttj-ariza-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
