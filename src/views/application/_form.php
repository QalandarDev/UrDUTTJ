<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TtjAriza */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ttj-ariza-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, '_student')->textInput() ?>

    <?= $form->field($model, 'about')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, '_pdf')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
