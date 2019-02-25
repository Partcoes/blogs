<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="/css/login/reset.css">
        <link rel="stylesheet" href="/css/login/supersized.css">
        <link rel="stylesheet" href="/css/login/style.css">
        <style>
            label{
                display: inline-block!important;
                width: 0%!important;
            }
            .username,.password ,.email{
                width: 100%!important;
                display: inline-block!important;
            }
            .help-block{
                display: none !important;
            }
        </style>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    <body>

        <div class="page-container">
            <h1>注册</h1>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['class'=>'username','placeholder'=>'please enter your acount']) -> label("") ?>

            <?= $form->field($model, 'password')->passwordInput(['class'=>'password','placeholder'=>"please enter your password"]) -> label("") ?>
            
            <?= $form->field($model, 'email')->passwordInput(['class'=>'email','placeholder'=>"please enter your email"]) -> label("") ?>

            <div class="form-group">
                <?= Html::submitButton('注册', ['class' => 'button-login', 'name' => 'signup-button']) ?>
            </div>
            <div class="error"><span>+</span></div>

            <?php ActiveForm::end(); ?>
<!--            <form action="" method="post">-->
<!--                <input type="text" name="username" class="username" placeholder="please enter your acount">-->
<!--                <input type="password" name="password" class="password" placeholder="please enter your password">-->
<!--                <button type="submit">登录</button>-->
<!--                <div class="error"><span>+</span></div>-->
<!--            </form>-->
        </div>
        <!-- Javascript -->
        <script src="/js/login/jquery-1.8.2.min.js"></script>
        <script src="/js/login/supersized.3.2.7.min.js"></script>
        <script src="/js/login/supersized-init.js"></script>
        <script src="/js/login/scripts.js"></script>
        <script type="text/javascript">
            $(".error").click(function(){
                $(".error").prop("style","display:none");
            })
        </script>

    </body>

</html>

