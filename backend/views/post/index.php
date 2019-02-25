<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Poststatus;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    table{
        text-align: center !important;

    }
</style>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加文章', ['create'], ['class' => 'btn btn-success']) ?>
	<?= Html :: button('全选',['class' => 'btn btn-primary']);?>
	<?= Html :: button('全不选',['class' => 'btn btn-info']);?>
	<?= Html :: button('批量删除',['class' => 'btn btn-danger']);?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            //'id',
            #[
            #	'attribute'=>'id',
            #	'contentOptions'=>['width'=>'30px']
            #],
	    ['class' => 'yii\grid\CheckboxColumn',

                'checkboxOptions' => function($model, $key, $index, $column) {

                    return ['value' => $model->id];

                },
                'headerOptions' => ['class' =>'text-center'],
                'contentOptions' => ['width'=>'50px'],
             ],
            [
                'attribute'=>'title',
                'value' => function($data){
                    return mb_substr($data -> title,0,50);
                }
            ],
            // 'content:ntext',
            'tags:ntext',
            //自己做的方法
            // 'status',
            //[
            //    'attribute'=>'status',
            //    'value'=>function($model){
            //        return $model -> status0 -> name;
            //    }
            //],
            //第二种方法
            [
            	'attribute'=>'status',
            	'value'=>'status0.name',
            	'filter'=>Poststatus::find()
            				->select(['name','id'])
            				->orderBy('position')
            				->indexBy('id')
            				->column(),
            ],
            // 'create_time:datetime',
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
                    // return date('Y-m-d H:i:s',$model -> update_time);
                    // asDate()的参数用标准日期格式在格式前面加上（php:）前缀
                    return Yii::$app -> formatter -> asDate($model -> update_time,'php:Y-m-d H:i:s');
                }
            ],
            // 'author_id',
            [
                'attribute'=>'author_id',
                'value'=>function($model){
                    return $model -> author -> nickname;
                },
                'contentOptions'=>['width'=>'30px']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>"{view}　{update}　{delete}"
            ],
        ],
    ]); ?>
</div>
