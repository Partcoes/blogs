<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
class PublicController extends Controller
{
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //只对改方法进行限制授权
                // 'only' => ['index'],
                'rules' => [
                    [
                        //true是授权可以访问，false是拒绝访问且跳转到登录页面
                        'allow' => true,
                        //访客状态可以访问的方法列表
                        'actions' => ['power'],
                        //？代表访客状态@代表登录状态
                        'roles' => ['?'],
                    ],
                    [
                        'allow' =>true,
                        // 'actions'=>['getopen'],
                        'roles' =>['@'],
                    ],
                ],
            ],
        ];
    }

    // public function actionIndex()
    // {
    //     echo 1;
    // }
    // public function actionTest()
    // {
    //     echo 0;
    // }
    // public function actionPower()
    // {
    //     echo 'power';
    // }
}