<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PublicNumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = '公众号管理平台';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    th a{
        display: inline-block !important;
        width: 100%;
        padding-left: 50px !important;
    }
</style>
<div class="public-num-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加公众号', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'rowOptions'=>['class'=>'text-center'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            'public_id',
            'public_name',
            'public_brief',
            'public_token',
            // 'user_id',
            [
                'attribute'=>'user_id',
                'value'=>function($model){
                    return $model -> username -> username;
                }
            ],
            // 'create_time:datetime',
            [
                // 'contentOptions' => ['class'=>'text-center'],
                'attribute'=>'create_time',
                'value'=>function($model){
                    return date('Y-m-d H:i:s',$model -> create_time);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
