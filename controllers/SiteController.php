<?php
namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\LoginForm;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use yii\rest\ActiveController;

class SiteController  extends Controller
{
    public $modelClass = 'app\models\User';
    public function actionIndex()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         return $this->asJson('Тест');
  
    }



    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return $token;
        } else {
            return $model;
        }
    }

    protected function verbs()
    {
        return [
            'login' => ['post'],
             'index' => ['POST']
        ];
    }
}