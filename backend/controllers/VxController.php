<?php
namespace backend\controllers;
use Yii;
use backend\controllers\CommonController;
use backend\models\PublicNum;
class VxController extends CommonController
{
	public $enableCsrfValidation = false;
	public function actionIndex()
	{
		// $postXml = file_get_contents(__DIR__.'/1.txt');
		// $value_array = simplexml_load_string($postXml, 'SimpleXMLElement', LIBXML_NOCDATA);
		// var_dump($value_array);die;
		$public_id = Yii::$app -> request ->get('id',0);
		$publicinfo = PublicNum::findOne($public_id);
		$name = $publicinfo -> public_name;
		$postXml= file_get_contents("php://input",false);
		// libxml_disable_entity_loader(true);
		file_put_contents(__DIR__.'/1.txt',$postXml);
		error_log($postXml);
		$dataObj= simplexml_load_string($postXml);
		// print_r($dataObj);die;
		$touser=$dataObj->FromUserName;
		$fromuser=$dataObj->ToUserName;
		$msgtype=$dataObj->MsgType;
		$event=$dataObj->Event;
		$content = $dataObj->Content;


		if($msgtype=='event'&&$event=='subscribe'){
			$sendXml="<xml><ToUserName><![CDATA[".$touser."]]></ToUserName><FromUserName><![CDATA[".$fromuser."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$name."欢迎您！如有疑问请输入帮助！]]></Content></xml>";
			return $sendXml;
		}elseif($msgtype == 'text'){
				$this -> msg($content,$touser,$fromuser,$dataObj);
		}elseif($msgtype=='image'){
			$this -> actionImg($dataObj);
		}
	}
	public function msg($content,$touser,$fromuser,$dataObj = '')
	{
		// file_put_contents(__DIR__.'/1.txt','12132');
		if($content != "帮助"){
            $query = (new \yii\db\Query())
                ->from('post')
                ->where("`title` like :keyword or `content` like :content")
                ->addParams([':keyword'=>"%$content%",':content' => "%$content%"])
                ->all();
		}else{
			$query = false;
		}

			if ($query == false) {
			$keyword = (new \yii\db\Query())
								->from('keyword')
								->where("`keyword` like :keyword")
								->addParams([':keyword'=>"%$content%"])
								->one();
				if ($keyword) {
					$content = $keyword['message'];
					if($content == "查询最新的文章"){
						$article = json_decode(file_get_contents("http://blogs.lixianze.top?r=post/new"));
						$url = "http://qing.lixianze.top:99/index.php?r=post%2Fdetail&id=".$article -> id ."&title=" . $article -> title;
                        return $this -> actionImg($dataObj,$url,$article -> title);
					}elseif($content == "现在是北京时间"){
						$content = $content . date('Y-m-d H:i:s',time());
					}
				}else{
					$content = "小青正在努力开发中！如有疑问请输入：帮助";
				}
			}else{
				$rand = rand(0,(count($query) -1));
				$query = $query[$rand];
                $url = "http://qing.lixianze.top/index.php?r=post%2Fdetail&id=".$query['id'] ."&title=" . $query['title'];
                return $this -> actionImg($dataObj,$url,$query['title']);
			}
			// file_put_contents(__DIR__.'/1.txt','12132');
			$sendXml="<xml><ToUserName><![CDATA[{$touser}]]></ToUserName><FromUserName><![CDATA[{$fromuser}]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[{$content}]]></Content></xml>";
			echo $sendXml;


	}


	public function actionImg($obj,$url,$title)
	{

		$tousername = $obj -> FromUserName;
		$fromusername = $obj -> ToUserName;
		$rand = rand(1,5);
		$imgxml = "<xml><ToUserName><![CDATA[".$tousername."]]></ToUserName><FromUserName><![CDATA[".$fromusername."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>2</ArticleCount><Articles><item><Title><![CDATA[".$title."！]]></Title><Description><![CDATA[青彦博客欢迎您！]]></Description><PicUrl><![CDATA[http://blogs.lixianze.top/images/pic/snow".$rand.".jpg]]></PicUrl><Url><![CDATA[". $url ."]]></Url></item><item><Title><![CDATA[青彦测试！]]></Title><Description><![CDATA[青彦博客欢迎您！]]></Description><PicUrl><![CDATA[http://blogs.lixianze.top/images/pic/snow".$rand.".jpg]]></PicUrl><Url><![CDATA[http://www.baidu.com]]></Url></item></Articles></xml>";
//		$imgxml = "<xml><ToUserName><![CDATA[".$tousername."]]></ToUserName><FromUserName><![CDATA[".$fromusername."]]></FromUserName><CreateTime>12345678</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>2</ArticleCount><Articles><item><Title><![CDATA['我曹']]></Title><Description><![CDATA[我曹]]></Description><PicUrl><![CDATA[https://csdnimg.cn/cdn/content-toolbar/football.gif]]></PicUrl><Url><![CDATA[http://www.baidu.com]]></Url></item><item><Title><![CDATA[你好]]></Title><Description><![CDATA[你好]]></Description><PicUrl><![CDATA[https://csdnimg.cn/cdn/content-toolbar/football.gif]]></PicUrl><Url><![CDATA[http://www.baidu.com]]></Url></item></Articles></xml>";
		echo $imgxml;
	}
	public function actionCreate()
	{
		$post = [
			'expire_seconds'=>'604800',
			'action_name'=>'QR_SCENE',
			'action_info'=>[
				'scene'=>[
					'scene_id'=>'123',
				]
			],
		];
		$post = json_encode($post);
		$token = $this -> gettoken();
		$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$token";
		$tikets = $this -> curl('post',$url,$post);
		// var_dump($tikets);die;
		// var_dump($tikets);die;
		$tikets = urlencode($tikets['ticket']);
		$turl = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$tikets";
		// echo hash('md5',123);
		echo "<img src='$turl'>";
	}
	public function actionTurnShort()
	{
		$turl = "https://mp.weixin.qq.com/debug/cgi-bin/apiinfo?t=index&type=%E5%9F%BA%E7%A1%80%E6%94%AF%E6%8C%81&form=%E8%8E%B7%E5%8F%96access_token%E6%8E%A5%E5%8F%A3%20/token";
		$post = ['action'=>'long2short','long_url'=>$turl];
		$post = json_encode($post);
		$token = $this -> gettoken();
		$url = "https://api.weixin.qq.com/cgi-bin/shorturl?access_token=$token";
		$res = $this -> curl('post',$url,$post);
		var_dump($res);
	}
	public function actionGetopen()
	{
		header("content-type:text/html;charset=utf-8");
		//$token = $this -> gettoken();

			$url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=11_qP3ZuvUEfF2YDanmK7vHg2-OyYQrAgEukijQG4JAEAZzW7nfCop3XmGWLThBj1s-I9573r4MEtU79Bv4awqiuB1y2Ak1Wrc3TiaSzHHhW_HJmabsqRiYHqAJifwCCChAFAPPP&next_openid=NEXT_OPENID";
			$data = $this -> curl('get',$url);
			//$data = json_decode($data,true);
			//$openid_arr = $data['data'];
			var_dump($data);die;
			//print_r($openid_arr);die;


	}
	public function actionInfo()
	{
		header("content-type:text/html;charset=utf-8");
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=11_RSlPykWQ2bKa6EwhZ4PkCcgWJZLUcBp4Ar_3qk5yegj46qLZOex3IuAtN34RhIHECL7iewTIUjXIfg3TTtbfM0gngwJHfuAVMrFBWBmmnQTVrmOjyUFtbYd5pclpcRQTs-WvozfWR4sAAHZDYCDgAJARVW&openid=oyh1y0bD9pagMH2qp6jiZlJ-d5DQ&lang=zh_CN";
		$data = $this -> curl('get',$url);
		var_dump($data);
		//return $data;
	}
	public function actionCreateButton()
	{
		$token = $this -> gettoken();
		// echo $token;die;
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$token";
		$post = [
			'button' =>[
				[
					'type'=>'click',
					'name'=>urlencode('最新文章'),
					'key'=>'today'
				],
				[
					'name'=>urlencode('菜单'),
					'sub_button' =>[
						'type'=>'view',
						'name'=>urlencode('搜索'),
						'url'=>'http://www.soso.com/'
					],
				],
				[
					'type'=>'miniprogram',
					'name'=>'wxa',
					'url'=>'http://mp.weixin.qq.com',
					'appid'=>'wx627b04951c50d180',
					'pagepath'=>'pages/lunar/index'
				],
				[
					'type'=>'click',
					'name'=>urlencode('赞一下我们'),
					'key'=>'good'
				]
			]
		];
		$post = json_encode($post,true);
		$data = $this -> curl('post',$url,$post);
		var_dump($data);
	}
	public function gettoken()
	{
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxd24fe0928307a31b&secret=ac412f51f3830143c98221acdd639f14";
		if (isset($_COOKIE['token'])) {
			return $_COOKIE['token'];
		}else{
			$token = $this -> curl('get',$url);
			$token = $token['access_token'];
			// print_r($token);die;
			setcookie('token',$token,time()+7200);
			// var_dump($_COOKIE);die;
			return $token;
		}
	}
	public function curl($type,$url,$data='')
	{
		$cn = curl_init();
		curl_setopt($cn,CURLOPT_URL,$url);
		curl_setopt($cn,CURLOPT_RETURNTRANSFER,1);
		if ($type == 'post') {
			curl_setopt($cn, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($cn,CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($cn,CURLOPT_SSL_VERIFYHOST,false);
			curl_setopt($cn,CURLOPT_POST,1);
			curl_setopt($cn,CURLOPT_POSTFIELDS,$data);
			curl_setopt($cn,CURLOPT_AUTOREFERER,1);
			curl_setopt($cn, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
			curl_setopt($cn, CURLOPT_FOLLOWLOCATION, 1);
		}
		$res = curl_exec($cn);
		if (curl_errno($cn)) {
			$error = curl_error($res);
			curl_close($cn);
			return $error;
		}else{
			curl_close($cn);
			return json_decode($res,true);
		}
	}
}
?>
