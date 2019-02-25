<?php

namespace backend\controllers;

use Yii;
use common\models\Comment;
use common\models\CommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
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
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
	 if (!Yii::$app -> user -> can('commentEditor')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }

        $model = new Comment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comment model.
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
	if (!Yii::$app -> user -> can('commentEditor')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comment model.
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
	if (!Yii::$app -> user -> can('commentDelete')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
    public function actionCheck($id)
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
	if (!Yii::$app -> user -> can('comentcheck')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }
        $model = $this -> findModel($id);
        if ($model -> check()) {
            return $this -> redirect(['index']);
        }
    }
}
