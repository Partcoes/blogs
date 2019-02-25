<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PublicNum */

$this->title = '修改公众号信息: ' . $model->username -> username;
$this->params['breadcrumbs'][] = ['label' => '公众号第三方管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username -> username, 'url' => ['view', 'id' => $model->public_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="public-num-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
