<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = mb_substr($model->title,0,26);
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    table{
        /*text-align: center !important;*/
       /* vertical-align: right !important;*/

    }
</style>
<div class="post-view" id="copy">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '是否删除该条文章?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
//            [
//                    'attribute' => 'content',
//                    'value' => function($model){
//                        return $model -> content;
//                    }
//            ],
            'tags:ntext',
            // 'status',
            [
                'attribute'=>'status',
                'value'=>function($model){
                    return $model -> status0 -> name;
                }
            ],
            //'create_time:datetime',
            [
                'attribute'=>'create_time',
                'value'=>function($model){
                    return date('Y-m-d H:i:s',$model -> create_time);
                }
            ],            
            // 'update_time:datetime',
            [
                'attribute'=>'update_time',
                'value'=>function($model){
                    return date('Y-m-d H:i:s',$model -> update_time);
                }
            ],
            // 'author_id',
            [
                'attribute'=>'author_id',
                'value'=>function($model){
                    return $model -> author -> nickname;
                }
            ]
        ],
        'template'=>"<tr><th width='120' style='text-align:center !important;'>{label}</th><td>{value}</td></tr>",
        'options'=>['class'=>'table table-bordered table-hover']
    ]) ?>

</div>
<script src="http://qing.lixianze.top:99/assets/f066b21/jquery.js"></script>
<script>
    $(document).ready(function() {
        var text = $('tr').eq(2)[0].innerText;
        $('tr').eq(2).find('td')[0].innerHTML = text;
        $('#copy').bind("copy", function(e) {
            console.log('感谢您的光临！本站已开启禁止复制！');
            e.preventDefault();
        });
    });

</script>

