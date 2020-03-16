<?php
namespace app\commands;
use Yii;
use yii\console\Controller;
class RbacController extends Controller
{
public function actionInit()
{
$role = Yii::$app->authManager->createRole('admin');
$role->description = 'Администратор';
Yii::$app->authManager->add($role);
$role = Yii::$app->authManager->createRole('simple');
$role->description = 'Пользователь';
Yii::$app->authManager->add($role);
}

public function actionRoleAdmin(){
 $adminRole = Yii::$app->authManager->getRole('admin');
Yii::$app->authManager->assign($adminRole,1);
}

public function actionRoleUser(){
    $adminRole = Yii::$app->authManager->getRole('simple');
   Yii::$app->authManager->assign($adminRole,2);
   }
}