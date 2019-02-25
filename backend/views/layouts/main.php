<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\Comment;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <style>
        html, body {width:100%;!important;height:100%;!important;} /*非常重要的样式让背景图片100%适应整个屏幕*/
        .bg {display: table;width: 100%;height: 100%;padding: 100px 0;text-align: center;color: #fff;background: url(http://pic19.nipic.com/20120210/7827303_221233267358_2.jpg)  no-repeat bottom center;background-color: #000;background-size: cover;}
        .my-navbar {padding:0px 0;transition: background 0.5s ease-in-out, padding 0.5s ease-in-out;}
        .my-navbar a{background:transparent !important;color:#fff !important}
        .my-navbar a:hover {color:#6f42c1 !important;background:transparent;!important;outline:0}
        .my-navbar a {transition: color 0.5s ease-in-out;!important;}/*-webkit-transition ;-moz-transition*/
        .top-nav {padding:0;!important;background:#000;!important;}
        .color{
            color:red!important;
        }
        a{
            text-decoration: none!important;
        }
        .footer{
            height: 70px!important;
            background: #444; /* Show a solid color for older browsers */
            background: -moz-linear-gradient(#555, #333);
            background: -o-linear-gradient(#555, #333);
            background: -webkit-linear-gradient(#555, #333);
            -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 2px;
            -moz-box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 2px;
            box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 2px;
            border: 1px solid #444;
            color: #AAA;
            text-shadow: 1px 1px #000;}
        }
    </style>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '青彦博客系统',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top my-navbar',
        ],
    ]);
    $menuItems = [
        ['label' => '文章管理', 'url' => ['/post/index']],
        ['label' => '评论管理', 'url' => ['/comment/index']],
        "<li><span class='badge badge-inverse' style='color:skyblue;background-color:white'>".Comment::getPengdingCommentCount()."</span></li>",
        ['label' => '管理员管理', 'url' => ['/adminuser/index']],  
        ['label' => '会员管理', 'url' => ['/user/index']],
        ['label' => '公众平台','url' => ['/public-num/index']],
        ['label' => '首页', 'url' => ['/post/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '退出 (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="pull-right"><b>青彦科技责任有限公司</b></p>
<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
    $(window).scroll(function () {
        if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav");
        }else {
            $(".navbar-fixed-top").removeClass("top-nav");

        }
    })
</script>
