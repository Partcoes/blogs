<?php  
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\PublicNum;
class CommonController extends Controller
{

	public $enableCsrfValidation = false;
	public function init()
	{
		// echo 1;die;
		$signature = Yii::$app -> request -> get('signature');
		$nonce = Yii::$app -> request ->get('nonce');
		$timestamp =Yii::$app -> request -> get('timestamp');
		$public_id = Yii::$app -> request ->get('id',0);
		$publicinfo = PublicNum::findOne($public_id);
		// var_dump($publicinfo);die;
		if ($publicinfo == '') {
			die;
		}else{
			$token = $publicinfo -> public_token;
		}
		$echostr = Yii::$app -> request -> get('echostr');
		// echo $token;die;
		//写和微信约定好的token
		// $token = "yii2";
		//将三者放入数组，并进行字典序排序
		$arr = [$token,$timestamp,$nonce];
		sort($arr,SORT_STRING);
		//将排序后的数组转字符串，并用sha1方法进行加密
		$tempstr = implode($arr);
		$tempstr = sha1($tempstr);
		//签名进行验证
		// echo $signature.'<br>'.$tempstr;die;
		if ($signature == $tempstr) {
			if ($echostr) {
				ob_clean();
				echo $echostr;die;
			}
			
		}else{
			return false;
		}		
	}
}
?>