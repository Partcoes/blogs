<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PublicNum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="public-num-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'public_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'public_brief')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'public_token')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'appid')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'secret')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('添加', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
