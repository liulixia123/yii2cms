<?php
namespace api\controllers;

use yii;
use yii\web\Controller;
use api\models\LoginForm;
/**
 * Site controller
 */
class UserController extends Controller
{
	public $enableCsrfValidation = false;
	
	//设置返回数据格式为json默认为xml
	public function beforeAction($action)
	{
	   return Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	}

	public function actionIndex(){
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		//p(array('a'=>'red','b'=>"blue",'g'=>'green'));
		//echo Yii::$app->params['url'];//常用参数
           return [
               'message' => 'API test Ok!',
               'code' => 100,
           ];
	}
	/**
	 * [actionLogin 登录接口]
	 * @return [type] [username 用户名 password 密码]
	 */
	public function actionLogin(){
		$model = new LoginForm;
		$model->setAttributes(Yii::$app->request->post());
        if ($model->login()) {
            return ['access_token' => $model->login()];
        }
        else {
            $model->validate();
            return $model;
        }
	}

	public function actionRegister(){
		return ['code'=>100];
	}
}