<?php
namespace app\controllers;
 
use yii\rest\ActiveController;
use app\models\PostSearch;
use app\models\Post;
use app\rbac\Rbac;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use yii\web\ServerErrorHttpException;

class UserController extends ActiveController
{

public $modelClass = 'app\models\User';

    public function behaviors(){
        $behaviors=parent::behaviors();
        $behaviors['authenticator']['only']=['create','update','delete'];
        $behaviors['authenticator']['authMethods']=[
            HttpBasicAuth::ClassName(),
            HttpBearerAuth::ClassName(),
        ];
        $behaviors['access']=[
            'class' => AccessControl::className(),
            'only' => ['create','update','delete'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function actions(){
        $actions=parent::actions();
        unset($actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function actionCreate(){
        $model=new Post();
        $model->user_id = Yii::$app->user->id;

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model-save()){
            $response=Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id= implode(',',array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location',Url::toRoute(['view', 'id' => $id],true));
        }
        elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Неудалось создать пользователя');
        }
        return $model;
    }

    public function prepareDataProvider(){
        $searchModel= new PostSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }
     public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['update', 'delete'])) {
            if (!Yii::$app->user->can(Rbac::admin, ['post' => $model])) {
                throw  new ForbiddenHttpException('Нет прав на создания пользователя');
            }
        }
    }

}