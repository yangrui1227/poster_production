<?php

namespace backend\controllers;

use Yii;
use backend\models\UploadFiles;
use backend\models\search\UploadFilesSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UploadFilesController implements the CRUD actions for UploadFiles model.
 */
class UploadFilesController extends BaseController
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
    }
*/
    /**
     * Lists all UploadFiles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UploadFilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   
    /**
     * Deletes an existing UploadFiles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $info = $this->findModel($id);
        $fileimg = "./".$info->save_path;
        if(file_exists($fileimg))
        {
            @unlink($fileimg);
        }
        $info->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UploadFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UploadFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UploadFiles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
