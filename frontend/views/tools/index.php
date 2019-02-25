<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ListView;
use frontend\component\TagCloude;
use frontend\component\RctReplyWidget;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<style type="text/css">
	a{
		text-decoration: none !important;
	}
</style>
<div class="containner">
	<div class="row">
	    <div class='col-xs-12 col-md-9'>
	    	<ol class="breadcrumb">
	    		<li><?=Html::a("首页",Yii::$app -> homeUrl)?></li>
	    		<li><?='青彦博客'?></li>
	    	</ol>
			<?=ListView::widget([
				'id'=>'postlist',
				'dataProvider'=>$dataProvider,
				'itemView'=>'_listitem',
				'layout'=>'{items}{pager}',
				'pager'=>[
					'maxButtonCount'=>10,
					'nextPageLabel'=>Yii::t('app','下一页'),
					'prevPageLabel'=>Yii::t('app','上一页'),
				],
			])?>
	    </div>
	</div>
</div>
