<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = $model -> username;
$this->params['breadcrumbs'][] = ['label' => '管理员管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="adminuser-update">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php $form = ActiveForm::begin(); ?>
 	<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>	
 	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile')->textarea(['rows' => 6]) ?>	

	<div>
		<?=Html::submitButton('保存',['class'=>' btn btn-success'])?>
	</div>

	<?php $form = ActiveForm::end();?>
    

</div>
