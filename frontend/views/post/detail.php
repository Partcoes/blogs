<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use frontend\component\TagCloude;
use frontend\component\RctReplyWidget;

use yii\helpers\HtmlPurifier;
use common\models\Comment;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<style>
    a{
        text-decoration: none !important;
    }
</style>
<script src="/js/background/three.min.js"></script>
<div class="container" id="copy">

	<div class="row">
	
		<div class="col-xs-12 col-md-9">
            <?php
                if( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false){?>
			<ol class="breadcrumb">
			<li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
			<li><a href="<?= Yii::$app->homeUrl;?>?r=post/index">文章列表</a></li>
			<li class="active"><?= mb_substr($model->title,0,5)?></li>
			</ol>
            <?php }?>
			
			<div class="post">
				<div class="title">
					<h2><a href="<?= $model->url;?>"><?= Html::encode($model->title);?></a></h2>				
						<div class="author">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?= date('Y-m-d H:i:s',$model->create_time)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?= Html::encode($model->author->nickname);?></em>
						</div>				
				</div>
			<br>
			
			<div class="content">
			<?= HTMLPurifier::process($model->content)?>
			</div>
			
			<br>
                <?php if( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false){?>
			<div class="nav">
				<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
				<?= implode(', ',$model->tagLinks);?>
				<br>
				<?= Html::a("评论({$model->commentCount})",$model->url.'#comments');?>
				最后修改于<?= date('Y-m-d H:i:s',$model->update_time);?>
			</div>
                <?php }?>
		</div>
		
		<div id="comments">
		
			<?php if($added) {?>
			<br>
			<div class="alert alert-warning alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  
			  <h4>谢谢您的回复，我们会尽快审核后发布出来！</h4>
			  
			  <p><?= nl2br($commentModel->content);?></p>
			  	<span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?= date('Y-m-d H:i:s',$model->create_time)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?= Html::encode($model->author->nickname);?></em>	  
			</div>			
			<?php }?>
			
			<?php if($model->commentCount>=1) :?>
			
			<h5><?= $model->commentCount.'条评论';?></h5>
			<?= $this->render('_comment',array(
					'post'=>$model,
					'comments'=>$model->activeComments,
			));?>
			<?php endif;?>
			<?php
                //if( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false){
                  //  echo "<h5>发表评论</h5>";
		//	$commentModel =new Comment();
		//	echo $this->render('_guestform',array(
		//			'id'=>$model->id,
		//			'commentModel'=>$commentModel,
	//		));
      //          }
            ?>

			
			</div>
					
		</div>
        <?php
        if( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false){ ?>
		<div class="col-xs-12 col-md-3">
			<div class="searchbox">
				<ul class="list-group">
				  <li class="list-group-item">
				  <span class="glyphicon glyphicon-search" aria-hidden="true"></span> 查找文章
				  </li>
				  <li class="list-group-item">				  
					  <form class="form-inline" action="index.php?r=post/index" id="w0" method="get">
						  <div class="form-group">
						    <input style="width:170px;" type="text" class="form-control" name="PostSearch[title]" id="w0input" placeholder="按标题">
						  </div>
						  <button type="submit" class="btn btn-default">搜索</button>
					</form>
				  
				  </li>
				</ul>			
			</div>
			
			<div class="tagcloudbox">
				<ol class="list-group">
				  <li class="list-group-item">
                      <span class='glyphicon glyphicon-fire' aria-hidden='true'>　<b>热文榜</b></span>
				  </li>
				  <li class="list-group-item">
<!--				  标签云展示《？php？》 TagCloude::widget(['tags'=>$tags])-->
                      <?php
                      foreach ($topList as $k => $top){
                          $k = $k+1;
                          echo Html::tag('li',"<b style='color:red'>".$k ."</b>．".Html::encode($top['title']),['class'=>'list-group-item']);
                      }
                      ?>
				   </li>
				</ol>
			</div>

			
			<div class="commentbox">
				<ul class="list-group">
				  <li class="list-group-item">
				  <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 最新回复
				  </li>
				  <li class="list-group-item">
				  <?= RctReplyWidget::widget(['recentComments'=>$recentComments])?>
				  </li>
				</ul>			
			</div>
            <?php }?>

		
		</div>
		
		
	</div>

</div>
<script src="http://qing.lixianze.top:99/assets/f066b21/jquery.js"></script>
<script>
    $(document).ready(function() {
        $('#copy').bind("copy", function(e) {
            console.log('感谢您的光临！本站已开启禁止复制！');
            e.preventDefault();
        });
    });
</script>
