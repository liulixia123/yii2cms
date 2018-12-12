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
		$script = \Yii::$app->request->get("script");
		//errorLog(Yii::$app->request->isPost,'login.log');
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		//p(array('a'=>'red','b'=>"blue",'g'=>'green'));
		//echo Yii::$app->params['url'];//常用参数
		//errorLog(Yii::$app->ipaddress->getIpAddress("10.235.51.16"),'login.log');//根据ip获取地址
           return [
               'message' => 'API test Ok!',
               'code' => 100,
               'script' => $script,
           ];
	}
	/**
	 * [actionLogin 登录接口]
	 * @return [type] [username 用户名 password 密码]
	 */
	public function actionLogin(){
		//errorLog(centers(Yii::$app->request->post()),'login.log');
		//errorLog(Yii::$app->request->headers->get('User-Agent'),'login.log');
		//判断是否是post请求
		if(!Yii::$app->request->isPost){
			Yii::$app->response->statusCode = Yii::$app->params['request_method_not_post'];
        	Yii::$app->response->statusText = "请求方式应为post！";
			return [];
		}
		//判断请求参数是否为空
		if(empty(Yii::$app->request->post('username'))){
			Yii::$app->response->statusCode = Yii::$app->params['username_not_empty'];
        	Yii::$app->response->statusText = "用户名不能为空";
			return [];
		}
		if(empty(Yii::$app->request->post('password'))){
			Yii::$app->response->statusCode = Yii::$app->params['password_not_empty'];
        	Yii::$app->response->statusText = "密码不能为空";
			return [];
		}
		$model = new LoginForm;
		$model->setAttributes(Yii::$app->request->post());
        if ($model->login()) {
            return ['access_token' => $model->login()];
        }else {
        	Yii::$app->response->statusCode = Yii::$app->params['username_or_password_error'];
        	Yii::$app->response->statusText = "用户名或密码错误！";
            //$model->validate();
            //Yii:$app->response->statusCode = 404;
            return [];
        }
	}

	public function actionRegister(){
		//发送短信验证码
		$checkCode = rand(100000,999999); 
		Yii::$app->sms->sendCheckCode('15210074957',$checkCode);
		return ['code'=>100];
	}
}