<?php
namespace mobile\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use mobile\models\PasswordResetRequestForm;
use mobile\models\ResetPasswordForm;
use mobile\models\SignupForm;
use mobile\models\ContactForm;
use yii\web\Response;
use mobile\models\Config;
/**
 * Site controller
 */
class SiteController extends Controller
{
    
     /**
     * 初始化配置信息
     * 网站配置或模板配置等
     */
    public function init() {
        parent::init();
        Yii::$app->params['basic'] = Config::getConfigs('basic');
        return true;
    }
    

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

   

}
