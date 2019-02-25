<?php

namespace backend\controllers;

use Yii;
use backend\models\SignupForm;
use common\models\Adminuser;
use common\models\AdminuserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ResetForm;
use common\models\AuthItem;
use common\models\AuthAssignment;
use yii\web\ForbiddenHttpException;
/**
 * AdminuserController implements the CRUD actions for Adminuser model.
 */
class AdminuserController extends Controller
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
     * Lists all Adminuser models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
        $searchModel = new AdminuserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Adminuser model.
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
     * Creates a new Adminuser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
	 if (!Yii::$app -> user -> can('adminCreate')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }

        $model = new SignupForm();
        // var_dump($model);die;
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model -> signup()) {
               return $this->redirect(['view', 'id' => $user->id]);
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Adminuser model.
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
	 if (!Yii::$app -> user -> can('adminEditor')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model -> save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Adminuser model.
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
	 if (!Yii::$app -> user -> can('adminDelete')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Adminuser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Adminuser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Adminuser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionReset($id)
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
	 if (!Yii::$app -> user -> can('adminReset')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }

        $model = new ResetForm();
        if ($model -> load(Yii::$app -> request -> post())) {
            if ($user = $model -> resetPassword($id)) {
                return $this -> redirect(['view','id'=>$user -> id]);
            }
        }
        return $this -> render('reset',['model'=>$model]);
    }

    public function actionPrivilige($id)
    {
        if (empty(Yii::$app -> user -> identity)) {
            return $this -> redirect(['site/login']);
        }
	if (!Yii::$app -> user -> can('adminPrivilige')) {
            throw new ForbiddenHttpException('您没有该项操作的权限！');
        }

        $allPrivileges = AuthItem::find() -> select(['name','description']) -> where(['type'=>1]) -> orderBy('description') -> all(); 
        foreach ($allPrivileges as  $v) {
            $allprivilegesArray[$v -> name] = $v -> description;
        }
        $userAllNode = AuthAssignment::find() -> select(['item_name']) -> where(['user_id'=>$id]) ->all();
        $AuthAssignmentArray = [];
        foreach ($userAllNode as $k => $v) {
            array_push($AuthAssignmentArray,$v -> item_name);
        }
        // var_dump($_POST);die;
        if (isset($_POST['newPri'])) {
            AuthAssignment::deleteAll('user_id=:id',[':id'=>$id]);
            $newPri = $_POST['newPri'];
            for ($i=0; $i < count($newPri) ; $i++) { 
                $pri = new AuthAssignment();
                $pri -> user_id = $id;
                $pri -> item_name = $newPri[$i];
                $pri -> created_at = time();
                $pri -> save();
            }
            return $this -> redirect(['adminuser/index']);
        }

        return $this -> render('privilige',['id'=>$id,'all'=>$allprivilegesArray,'user'=>$AuthAssignmentArray]);

    }
}
