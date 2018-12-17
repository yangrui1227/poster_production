<?php

namespace backend\controllers;

use Yii;
use backend\models\ActivityPoster;
use backend\models\search\ActivityPosterSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ActivityPoster1;
use backend\models\ActivityPoster2;
use backend\models\ActivityPoster3;
use backend\models\UploadFiles;

/**
 * ActivityPosterController implements the CRUD actions for ActivityPoster model.
 */
class ActivityPosterController extends BaseController
{
    /**
     * {@inheritdoc}
     */
   /* public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/

    /**
     * Lists all ActivityPoster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivityPosterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActivityPoster model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
       $model =  $this->findModel($id);
       if($model->category_id==1){
        $model_params =  ActivityPoster1::find()->where(['poster_id'=>$model->id])->one();
       }
       if($model->category_id==2){
        $model_params =  ActivityPoster2::find()->where(['poster_id'=>$model->id])->one();
       }
       if($model->category_id==3){
        $model_params =  ActivityPoster3::find()->where(['poster_id'=>$model->id])->one();
       }
        return $this->render('view', [
            'model' => $model,
            'model_params'=>$model_params
        ]);
    }

    
   

    /**
     * Deletes an existing ActivityPoster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $info = $this->findModel($id);
        /*删除人主拓活动表信息*/
        if($info->category_id==1){
             ActivityPoster1::find()->where(['poster_id'=>$info->id])->one()->delete(); 
        }
        /*删除创说会活动表信息*/
       if($info->category_id==2){
             ActivityPoster2::find()->where(['poster_id'=>$info->id])->one()->delete(); 
        }
        /*删除个人荣誉表信息*/
         if($info->category_id==3){
             ActivityPoster3::find()->where(['poster_id'=>$info->id])->one()->delete(); 
        }
        /*删除海报图片*/
        $fileimg = ".".$info->poster_image;
        if(file_exists($fileimg))
        {
            @unlink($fileimg);
        }
        /*删除上传的背景图片*/
        if($info->background_image){
              $files =   UploadFiles::findOne($info->background_image);
              $save_path = "./".$files->save_path;
            if(file_exists($save_path))
            {
                @unlink($save_path);
            }
             $files->delete();
         }
         /*删除活动图片*/
         if($info->activity_image){
              $fileshd =   UploadFiles::findOne($info->activity_image);
              $save_path2 = "./".$fileshd->save_path;
            if(file_exists($save_path2))
            {
                @unlink($save_path2);
            }
             $fileshd->delete();
         }
         /*删除海报制作的信息表单*/
        $info->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ActivityPoster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActivityPoster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActivityPoster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
