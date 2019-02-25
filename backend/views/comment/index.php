<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    th a{
        display: block !important;
        text-align: center;
        /*border:1px solid red !important;*/
    }
</style>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加评论', ['create'], ['class' => 'btn btn-success']) ?>
	<?= Html :: button('全选',['class' => 'btn btn-primary']);?>
        <?= Html :: button('全不选',['class' => 'btn btn-info']);?>
        <?= Html :: button('批量删除',['class' => 'btn btn-danger']);?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>['class'=>'text-center'],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            #[
            #    'attribute'=>'id',
            #    'contentOptions'=>['width'=>'30px']
            #i],
	    ['class' => 'yii\grid\CheckboxColumn',

                'checkboxOptions' => function($model, $key, $index, $column) {

                    return ['value' => $model->id];

                },
                'headerOptions' => ['class' =>'text-center'],
                'contentOptions' => ['width'=>'50px'],
             ],
            // 'content:ntext',
            [
                'attribute'=>'content',
                'value'=>'beginning',
            ],
            // 'status',
            [
                'attribute'=>'status',
                'contentOptions'=>['width'=>'150px'],
                'value'=>function($model){
                    return $model -> status0 ->name;
                },
                'filter'=>yii\helpers\ArrayHelper::map(common\models\Commentstatus::find() -> all(),'id','name'),
                'contentOptions'=>function($model){
                    return $model -> status == 1?['style'=>'color:red']:['style'=>'color:green'];
                }

            ],
            // 'create_time:datetime',
            [
                'attribute'=>'create_time',
                'value'=>function($model){
                    //asDate的一个细节问题，就是转换日期格式时要用大写的M，否则转换的是其他纪年法
                    return Yii::$app -> formatter -> asDate($model -> create_time,'Y-M-d H:i:s');
                }
            ],
            // 'userid',
            [
                'attribute'=>'userName',
                'value'=>function($model){
                    return $model -> user -> username;
                }
            ],
            'email:email',
            'url:url',
            // 'post_id',
            [
                'attribute'=>'post_id',
                'value'=>function($model){
                    return $model -> post -> title;
                }
            ],
            //采取对象.属性的方法也可以获取值
            //'post.title',
            // 'remind',
            [
                'attribute'=>'remind',
                'contentOptions'=>['width'=>'100px'],
                'value'=>function($model){
                    return $model -> remind == 1?'已提醒':'未提醒';
                },
                'filter'=>['1'=>'已提醒','0'=>'未提醒'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>"{view}　{delete}　{update}　{check}",
                'buttons'=>[
                    'check'=>function($url,$model,$key){
                        $options = [
                            'title' => Yii::t('yii','审核'),
                            'aria-label' => Yii::t('yii','审核'),
                            //弹窗
                            'data-confirm' => Yii::t('yii','您确定要审该评论？'),
                            'data-pajax' => 0,
                            //提交的方式
                            'data-methor' => 'post'
                        ];
                        return Html::a("<span class='glyphicon glyphicon-ok-circle'></span>",$url,$options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
