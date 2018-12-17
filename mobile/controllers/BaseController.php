<?php
namespace mobile\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * Activity controller
 */
class BaseController extends Controller
{
    

    /** 
    * 通用成功跳转 
    * @param unknown $url 成功后跳转的URL 
    * @param number $sec 自动跳转秒数 
    * @return Ambigous <string, string> 
    */ 
    public function msgsuccess($url= [] ,$sec = 3){ 
        $url= empty($url)? ['/activity/index']: $url; 
        $url= Url::toRoute($url); 
        return $this->renderPartial('error',['gotoUrl'=>$url,'sec'=>$sec]); 
    } 

    /** 
    * 通用错误跳转 
    * @param string $msg 错误提示信息 
    * @param number $sec 
    * @return Ambigous <string, string> 
    */ 
    public function msgerror($msg= '',$sec = 3){ 

     return $this->renderPartial('error',['errorMessage'=>$msg,'sec'=>$sec]); 
    }


}
