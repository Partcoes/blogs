<?php

namespace frontend\controllers;

use yii\web\Controller;
class GamesController extends Controller
{
    //游戏模块
    public function actionGame()
    {
        $rand = rand(0,3);
        $game = ['tzfe','fruit','plane','flytzfe'];
//        return $this -> render('corpse');
        return $this -> render($game[$rand]);
    }
//    测试游戏模块
    public function actionTest()
    {
        return $this -> render('poker');
    }
}