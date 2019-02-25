<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<link rel="stylesheet" type="text/css" href="css/login/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/login/demo.css" />
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="css/login/component.css" />
<style>
    label{
        display: inline-block!important;
        width: 0%!important;
    }
    .help-block{
        display: none !important;
    }
</style>
<!--[if IE]>
<script src="js/login/html5.js"></script>
<![endif]-->
<body class="large-header" id="large-header">
		<div class="container demo-1">
			<div class="content">
				<div id="" class="">
					<canvas id="demo-canvas" style="position: absolute"></canvas>
					<div class="logo_box">
						<h3>欢迎登录青彦后台</h3>
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <div class="input_outer">
                        <?=Html::tag('span','',['class' => 'u_user'])?>
                        <?= $form->field($model, 'username')->textInput(['class'=>'text','placeholder'=>'Please enter your acount']) -> label("") ?>
                        </div>
                        <div class="input_outer">
                        <?=Html::tag('span','',['class' => 'us_uer'])?>
                        <?= $form->field($model, 'password')->passwordInput(['class' => 'text','placeholder'=>'Please enter your password']) -> label("") ?>
                        </div>
                        <?php $form->field($model, 'rememberMe')->checkbox() ?>

                        <div class="form-group">
                            <div class="mb2">
                            <?= Html::tag('button','登录', ['class' => 'act-but submit', 'name' => 'login-button']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
		</div><!-- /container -->
		<script src="js/login/TweenLite.min.js"></script>
		<script src="js/login/EasePack.min.js"></script>
		<script src="js/login/rAF.js"></script>
		<script src="js/login/demo-1.js"></script>
</body>