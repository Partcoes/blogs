<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use common\models\Poststatus;
use common\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // var_dump($dataProvider);die;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
        if (!Yii::$app -> user -> can('postView')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        // var_dump(Yii::$app -> user -> can('updatePost'));die;
        if (!Yii::$app -> user -> can('createPost')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }
        $model = new Post();
        if (!empty(Yii::$app -> user -> identity)) {
            $author_id = Yii::$app -> user -> identity -> id;
        }else{
            return $this -> redirect(['site/login']);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model -> author_id = $author_id;
            if ($model->save()) {
                 return $this->redirect(['view', 'id' => $model->id]);
            }
               
                // return $this -> goBack(); 
        }   
        $post = new Poststatus();
        $state = $post -> find() -> select(['name','id']) -> indexBy('id') -> column();        
        return $this->render('create', [
            'model' => $model,
            'state' => $state,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
        if (!Yii::$app -> user -> can('updatePost')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }        
        header('content-type:text/html;charset=utf-8');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //$model -> update_time = time();
            $model -> author_id = $model -> author -> id;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        $post = new Poststatus();
        $state = $post -> find() -> select(['name','id']) -> indexBy('id') -> column();
        // var_dump($state);die;
        return $this->render('update', [
            'model' => $model,
            'state'=>$state,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
        if (!Yii::$app -> user -> can('deletePost')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }
        //$refer = rtrim('?'.$refer,'&');        
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
        // echo Yii::$app->request-> queryParams;
        return $this -> goBack();
    }

    public function actionNew()
    {
        $searchModel = new Post();
//        var_dump($searchModel);die;
        return json_encode($searchModel -> find() -> select(['id','title']) -> orderBy("update_time DESC") -> one() -> toArray());
    }
    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
