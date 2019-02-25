<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    th a{
        display: block !important;
        text-align: center !important;
    }
</style>
<div class="adminuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加管理员', ['create'], ['class' => 'btn btn-success']) ?>
	<?= Html :: button('全选',['class' => 'btn btn-primary']);?>
        <?= Html :: button('全不选',['class' => 'btn btn-info']);?>
        <?= Html :: button('批量删除',['class' => 'btn btn-danger']);?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>['class'=>'text-center'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            // 'id',
            #[
            #    'attribute'=>'id',
            #    'contentOptions'=>['width'=>'30px'],
            #],
	    ['class' => 'yii\grid\CheckboxColumn',

                'checkboxOptions' => function($model, $key, $index, $column) {

                    return ['value' => $model->id];

                },
                'headerOptions' => ['class' =>'text-center'],
                'contentOptions' => ['width'=>'50px'],
             ],
            // 'username',
            [
                'attribute'=>'username',
                'contentOptions'=>['width'=>'200px'],
            ],            
            // 'nickname',
            [
                'attribute'=>'nickname',
                'contentOptions'=>['width'=>'200px'],
            ],             
            //'password',
            'email:email',
            'profile:ntext',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}　{update}　{delete}　{reset}　{privilige}',
                'buttons'=>[
                    'reset'=>function($url,$model,$key){
                        $options = [
                            'title'=> Yii::t('yii','重置密码'),
                            'aria-label'=>Yii::t('yii','重置密码'),
                            'data-confirm'=>Yii::t('yii','您确定重置密码吗？该操作不可恢复！'),
                            'data-method'=>'post',
                            'data-pajax' => 0
                        ];
                        return Html::a("<span class='glyphicon glyphicon-wrench'></span>",$url,$options);
                    },
                    'delete'=>function($model,$url,$key){
                        // $options = [
                        //     'title'=> Yii::t('yii','删除'),
                        //     'aria-label'=>Yii::t('yii','删除'),
                        //     'data-confirm'=>Yii::t('yii','您确定删除该用户吗？'),
                        //     'data-methor'=>'post',
                        //     'data-pajax' => $url -> id
                        // ];                      
                        return Html::a("<span class='glyphicon glyphicon-remove-circle'></span>",['adminuser/delete','id'=>$url -> id],['data'=>['confirm'=>'您确定删除该用户吗？','method'=>'post']]);
                    },
                    'privilige'=>function($url,$model,$key){
                        $options = [
                            'title'=> Yii::t('yii','权限分配'),
                            'aria-label'=>Yii::t('yii','权限分配'),
                            // 'data-confirm'=>Yii::t('yii','您确定重置密码吗？该操作不可恢复！'),
                            'data-method'=>'post',
                            'data-pajax' => 0
                        ];
                        return Html::a("<span class='glyphicon glyphicon-user'></span>",$url,$options);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
