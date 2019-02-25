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
<div class="container">

	<div class="row">
	
		<div class="col-xs-12 col-md-9">
		
			<ol class="breadcrumb">
			<li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
			<li><a href="<?= Yii::$app->homeUrl;?>?r=tools/index">工具列表</a></li>
			</ol>
			
			<div class="post">
				<div class="title">
					<h2>
                        <a href="<?= $model->url;?>"><?=$model -> file_name?></a>
                        <?=Html::a("<span class='glyphicon glyphicon-download-alt'></span>",['tools/download',['src'=>$model -> file_src]])?>
                    </h2>

				</div>

			<div class="content">
			<?= HTMLPurifier::process($model->file_desc)?>
			</div>



		</div>
		</div>


		
		
	</div>

</div>
