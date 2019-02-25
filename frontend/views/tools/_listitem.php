<?php
use yii\helpers\Html;
// var_dump($model);die;

?>
<div class="post">
	<div class="title">
		<div class="content">
            <?=Html::a($model -> file_name,['tools/detail','id'=>$model -> file_id])?>
		</div>
		<br>

	</div>
</div>