<?php


/* @var $this \yii\web\View */

/* @var $model \app\models1\TalabaForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'yunalish') ?>
<?= $form->field($model, 'soni') ?>
<?= $form->field($model, 'url') ?>
<div class="form-group">
    <?= Html::submitButton('Submit',['class'=>'btn btn-primary'])?>
</div>
<?php ActiveForm::end() ?>
