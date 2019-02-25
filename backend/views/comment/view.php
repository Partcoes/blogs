<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = $model -> post -> title;
$this->params['breadcrumbs'][] = ['label' => '评论详情', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定删除该评论吗?该操作不可恢复?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'userid',
                'value'=>function($model){
                    return $model -> user -> username;
                }
            ], 
            'url:url',
            // 'post_id',
            [
                'attribute'=>'post_id',
                'value'=>function($model){
                    return $model -> post -> title;
                }
            ],                 
            'content:ntext',
            // 'status',
            [
                'attribute'=>'status',
                'value'=>function($model){
                    return $model -> status == 1?'已审核':'未审核';
                }
            ],
            // 'create_time:datetime',
            [
                'attribute'=>'create_time',
                'value'=>function($model){
                    return Yii::$app -> formatter -> asDate($model -> create_time,'Y-M-d H:i:s');
                }
            ],
            // 'userid',         
            'email:email',         
            // 'remind',
            [
                'attribute'=>'remind',
                'value'=>function($model){
                    return $model -> remind == 1?'已提醒':'未提醒';
                }
            ],            
        ],
        'template'=>"<tr><th style='text-align:center !important;'>{label}</th><td>{value}</td></tr>",
        'options'=>['class'=>'table table-bordered table-hover']
    ]) ?>

</div>
