<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = "系统评论";
$this->params['breadcrumbs'][] = ['label' => '评论', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-create">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
