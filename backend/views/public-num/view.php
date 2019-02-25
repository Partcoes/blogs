<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PublicNum */

$this->title = $model->username -> username;
$this->params['breadcrumbs'][] = ['label' => '公众号列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="public-num-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->public_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->public_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '是否删除该公众号?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'public_id',
            'public_name',
            'public_brief',
            'public_token',
            //'user_id'
            [
                'attribute'=>'user_id',
                'value'=>function($model){
                        return $model -> username -> username;
                    }
            ],
            //'create_time:datetime',
            [
            	'attribute'=>'create_time',
            	'value'=>function($model){
            		return date('Y-m-d H:i:s',$model -> create_time);
            	}
            ],
//            'appid',
//            'secret',
//            [
//                'attribute' => 'serverurl',
//                'value'=>function($model){
//                    return "http://47.93.99.191/advanced/backend/web/?r=vx/index&id=".$model -> public_id;
//                }
//            ],


        ],
    ]) ?>

</div>
