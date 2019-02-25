<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    th a{

        display: block !important;
        text-align: center !important;
    }
    a{
	text-decoration:none !important;		
    }
</style>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<p>
	     <?= Html :: button('全选',['class' => 'btn btn-primary']);?>
             <?= Html :: button('全不选',['class' => 'btn btn-info']);?>
             <?= Html :: button('批量删除',['class' => 'btn btn-danger']);?>
	</p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>['class'=>'text-center'],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            
            //'id',
            #[
            #    'attribute' => 'id',	
            #    'contentOptions' => ['width'=>'30px'],
            #],
	     ['class' => 'yii\grid\CheckboxColumn',

                'checkboxOptions' => function($model, $key, $index, $column) {

                    return ['value' => $model->id];

                },
		'headerOptions' => ['class' =>'text-center'],
		'contentOptions' => ['width'=>'50px'],
	     ],
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            // 'status',
            [
                'attribute'=>'status',
                'value'=>function($model){
                    return $model -> status == 10 ?'活跃':'禁用';
                },
                'filter' =>['10'=>'活跃','0'=>'禁用']
            ],
            // 'created_at',
            [
                'attribute'=>'created_at',
                'value'=>function($model){
                    return date('Y-m-d H:i:s',$model -> created_at);
                },
                'label' => '注册时间'
            ],            
            // 'updated_at',
            [
                'attribute'=>'updated_at',
                'value'=>function($model){
                    return date('Y-m-d H:i:s',$model -> updated_at);
                },
                'label' => '修改时间'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}　{delete}',
		'buttons' =>[
			'delete'=>function($model,$url,$key){
                        // $options = [
                        //     'title'=> Yii::t('yii','删除'),
                        //     'aria-label'=>Yii::t('yii','删除'),
                        //     'data-confirm'=>Yii::t('yii','您确定删除该用户吗？'),
                        //     'data-methor'=>'post',
                        //     'data-pajax' => $url -> id
                        // ];                      
                        return Html::a(" <span class='glyphicon glyphicon-trash' title='删除'></span> ",['user/delete','id'=>$url -> id],['data'=>['confirm'=>'您确定删除该用户吗？','method'=>'post']]);
                    },

		]
            ],
        ],
    ]); ?>
</div>
