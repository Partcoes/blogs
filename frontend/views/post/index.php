<?php
use yii\widgets\ActiveForm;
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
<div class="containner" id="main">
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
	    <div class="col-xs-12 col-md-3">
			<div class="searchbox">
				<ul class="list-group">
					<li class='list-group-item'>
						<span class='glyphicon glyphicon-search' aria-hidden='true'>　<b>查找文章</b></span>
					</li>
					<li class="list-group-item">

<!--						<form action="--><?//= Url::to(['post/index'])?><!--" method="get" class="form-inline" id="w0">-->
                        <?php $form = ActiveForm::begin(['action' =>['post/index'],'method' => 'get']); ?>
                        <div class="form-inline" id="w0">
							<div class="form-group">
							   <input type="text" class="form-control" name="PostSearch[title]" id='w0input' placeholder="关键字" style="width:170px">
							</div>
							<button type="submit" class="btn btn-default">搜索</button>
<!--						</form>-->
                        </div>
                        <?php ActiveForm::end(); ?>
                    </li>
				</ul>
			</div>

			<div class="tagcloudebox">
				<ol class="list-group">
					<li class='list-group-item'>
						<span class='glyphicon glyphicon-fire' aria-hidden='true'>　<b>热文榜</b></span>
					</li>
<!--					<li class="list-group-item">--><?php //TagCloude::widget(['tags'=>$tags])?><!--</li>-->
                    <?php
                        foreach ($topList as $k => $top){
                            $k = $k+1;
                            echo Html::tag('li',"<b style='color:red'>".$k ."</b>．".Html::encode($top['title']),['class'=>'list-group-item']);
                        }
                    ?>
				</ol>
			</div>

			<div class="searchbox">
				<ul class="list-group">
					<li class='list-group-item'>
						<span class='glyphicon glyphicon-comment' aria-hidden='true'>　<b>最近回复</b></span>
					</li>
					<li class="list-group-item">
						<?=RctReplyWidget::widget(['recentComments'=>$comment])?>
					</li>
				</ul>
			</div>
	    </div>
	</div>
</div>
