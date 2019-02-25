<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\commentStatus;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() -> radioList(yii\helpers\ArrayHelper::map(commentStatus::find() -> all(),'position','name')) ?>

    <?php //$form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'userid')->dropDownList(yii\helpers\ArrayHelper::map(User::find() -> all(),'id','username')) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_id')->textInput() ?>

    <?= $form->field($model, 'remind')->textInput() ->radioList(['1'=>'已提醒','2'=>'未提醒']) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
