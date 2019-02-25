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
		//д��΢��Լ���õ�token
		// $token = "yii2";
		//�����߷������飬�������ֵ�������
		$arr = [$token,$timestamp,$nonce];
		sort($arr,SORT_STRING);
		//������������ת�ַ���������sha1�������м���
		$tempstr = implode($arr);
		$tempstr = sha1($tempstr);
		//ǩ��������֤
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