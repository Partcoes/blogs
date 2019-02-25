<?php

namespace backend\controllers;

use Yii;
use backend\models\PublicNum;
use backend\models\PublicNumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * PublicNumController implements the CRUD actions for PublicNum model.
 */
class PublicNumController extends PublicController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
                            'class' => VerbFilter::className(),
                            'actions' => [
                                'delete' => ['POST'],
                            ],
                        ];
        return $behaviors;
    }

    /**
     * Lists all PublicNum models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app -> user -> can('publicList')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }
        $searchModel = new PublicNumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PublicNum model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app -> user -> can('publicView')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PublicNum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app -> user -> can('publicCreate')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }
        $model = new PublicNum();

        if ($model->load(Yii::$app->request->post())) {
            $model -> create_time = time();
            $model -> user_id = Yii::$app ->user-> id;
            if ($model -> save()) {
                return $this->redirect(['view', 'id' => $model->public_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PublicNum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->public_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PublicNum model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PublicNum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PublicNum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PublicNum::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
