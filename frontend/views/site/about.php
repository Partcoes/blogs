<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = '关于我们';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    th{
        border-right: 1px solid #cccccc!important;
        width: 10% !important;
    }
    a{
        text-decoration: none!important;
    }
</style>
<div class="site-about">
<!--    <h1>--><?php ////Html::encode($this->title); ?><!--</h1>-->
<!--    <p>站长QQ:2247809345</p>-->
<!--    <p>站长邮箱：<span style="font-weight: bold!important;color: blue!important;">2247809345@qq.com</span></p>-->
<!--    <p>当前版本：<span style="color: blue!important;">v1.20</span></p>-->
<!--    <p>公司地址：北京市朝阳区西坝河甲24号楼2栋101室</p>-->
<!--    <code>--><?//= __FILE__ ?><!--</code>-->
    <table class="table table-striped table-hover">
        <tr>
            <th>站长QQ：</th>
            <td><span style="font-weight: bold!important;">2247809345</span></td>
        </tr>
        <tr>
            <th>站长邮箱：</th>
            <td><span style="font-weight: bold!important;color: blue!important;">2247809345@qq.com</span></td>
        </tr>
        <tr>
            <th>当前版本：</th>
            <td><span style="color: blue!important;font-weight: bold">v1.30</span></td>
        </tr>
        <tr>
            <th>公司地址：</th>
            <td><span style="font-weight: bold!important;">公司地址:北京市海淀区丰户营</span></td>
        </tr>
    </table>
</div>
