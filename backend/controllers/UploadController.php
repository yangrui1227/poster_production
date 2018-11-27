<?php 
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\components\Upload;
use yii\web\Response;
class UploadController extends Controller
{
   
    //webUploader上传
    public function actionUpload()
    {
        try {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = new Upload();
            $info = $model->upImage();
            if ($info && is_array($info)) {
                return $info;
            } else {
                return ['code' => 1, 'msg' => 'error'];
            }
        } catch (\Exception $e) {
            return ['code' => 1, 'msg' => $e->getMessage()];
        }
    }
}