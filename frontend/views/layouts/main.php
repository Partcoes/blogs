<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        html, body {width:100%;!important;height:100%;!important;} /*非常重要的样式让背景图片100%适应整个屏幕*/
        .bg {display: table;width: 100%;height: 100%;padding: 100px 0;text-align: center;color: #fff;background: url(http://pic19.nipic.com/20120210/7827303_221233267358_2.jpg)  no-repeat bottom center;background-color: #000;background-size: cover;}
        .my-navbar {padding:5px 0;transition: background 0.5s ease-in-out, padding 0.5s ease-in-out;}
        .my-navbar a{background:transparent !important;color:#fff !important}
        .my-navbar a:hover {color:#6f42c1 !important;background:transparent;!important;outline:0}
        .my-navbar a {transition: color 0.5s ease-in-out;!important;}/*-webkit-transition ;-moz-transition*/
        .top-nav {padding:0;!important;background:#000;!important;}
        .color{
            color:red!important;
        }
        .link-red{
            color: red;
        }
        .link-blue{
            color:blue;
        }
        .link-black{
            color:black;
        }
        .footer{
            height: auto!important;
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
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    if( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false) {
        NavBar::begin([
            'brandLabel' => '青彦博客',
//        'brandUrl' => Yii::$app->homeUrl,
            'brandUrl' => '?r=post/index',
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top my-navbar',
            ],
        ]);
        $menuItems = [
            ['label' => 'H5小游戏', 'url' => ['/games/game']],
	        //['label' => '工具(测验)','url' => ['tools/index']],
            ['label' => '公众号'],
            ['label' => '博客', 'url' => ['/post/index']],
            ['label' => '首页', 'url' => ['/site/index']],
			['label' => '在线代码运行','url'=>'http://code.y444.cn/'],
            ['label' => '关于', 'url' => ['/site/about']],

//        ['label' => '联系我们', 'url' => ['/site/contact']],

        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
        } else {
            $menuItems[] = "<li>"
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
    }
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<div id="qrcode" style="display: none;">
    <img style="width:100px;height: 100px;" src="http://blogs.lixianze.top/images/pic/qrcode_for_gh_e7377b024a86_258.jpg" alt="二维码" title="二维码">
</div>
<?php
if( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false){ ?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">友情链接：
            <a style="margin-right: 20px!important;color:white" href="http://blog.xzlrm.cn/blog/frontend/web/" title="徐sir博客">徐先生</a>
            <a href="http://mocking.xyz/"  style="margin-right: 20px!important;color:white;" title="世伟博客">世伟博客</a>
            <a href="http://qing.lixianze.top:99?r=post/index"  style="margin-right: 20px!important;color:white;" title="青彦博客"><span class="link-red">青</span><span class="link-black">彦博客</span></a>
            <a style="margin-right: 20px!important;color:white" href="https://linux.linuxidc.com/" title="linux公社"><span class="link-red">linux</span><span class="link-black">公社</span></a>
            <a style="margin-right: 20px!important;color:white" href="https://blog.csdn.net/qq_42516413" title="青彦CSDN"><span class="link-red">C</span><span class="link-black">SDN</span></a>
			<a style="margin-right: 20px!important;color:white" href="https://www.oschina.net/" title="开源中国"><span class="link-red">开</span><span class="link-black">源中国</span></a>
        </p>
        <p class="pull-left">站长工具：
            <a href="https://tool.lu/portscan"  style="margin-right: 20px!important;color:white;" title="端口扫描">端口扫描</a>
            <a href="https://c.runoob.com/front-end/854"  style="margin-right: 20px!important;color:white;" title="正则测试">正则测试</a>
        </p>
    </div>

    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
<!--        <p class="pull-left" style="font-weight: bold">今天是:　<span style="color:blue;">--><?//= date('Y/m/d H:i:s') ?><!--</span></p>-->
<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
        <p class="pull-right"><b>青彦科技责任有限公司</b></p>
    </div>
</footer>
<?php }?>
<?php $this->endBody() ?>
</body>
</html>
<script>
    $(window).scroll(function () {
        if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav");
        }else {
            $(".navbar-fixed-top").removeClass("top-nav");

        }
    })
    $(document).ready(function(){
        $('#w2').find('li').eq(1).addClass('public-num');
    })
    $(document).on('mouseover','.public-num',function(){
        $('#qrcode').prop("style",'display:block;position:absolute;top:10%;left:60%;')
    })
    $(document).on('mouseleave','.public-num',function(){
        $('#qrcode').prop("style",'display:none;')
    })
</script>
<?php $this->endPage() ?>
