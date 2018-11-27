<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use backend\models\search\CategorySearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\libs\Tree;
use yii\web\UploadedFile;
use common\models\UploadForm;
/**
 * MenuController implements the CRUD actions for Menu model.
 */
class CategoryController extends BaseController
{

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            $sorts = Yii::$app->request->post('sort');
            if (!empty($sorts)) {
                foreach ($sorts as $id => $v) {
                    $model = $this->findModel($id);
                    $model->sort = $v;
                    $model->save();
                }
                Yii::$app->session->setFlash('success', '操作成功');
            }
        }
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
         $fileupload = new UploadForm();
        $model->addtime = date('Y-m-d H:i:s',time());

        if ($model->load(Yii::$app->request->post())) {
            $fileupload->images = UploadedFile::getInstance($model,'images');
         $model->images = $fileupload->uploadPic('category');
         if($model->save())return $this->redirect(['index']);
        } 
            $model->pid = Yii::$app->request->get('pid', 0);
            $arr = Category::find()->asArray()->all();
            $treeObj = new Tree($arr);
            return $this->render('create', [
                'model' => $model,
                'treeArr' => $treeObj->getTree(),
            ]);
        
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $fileupload = new UploadForm();
        
      
        if ($model->load(Yii::$app->request->post())) {
        $model->updatetime = date('Y-m-d H:i:s',time()); 
        $fileupload->images = UploadedFile::getInstance($model,'images');//print_r($fileupload->images);die;
        if($fileupload->images){
            $model2 = $this->findModel($id);
            if($model2->images){
                $old_img = "./".$model2->images;
                @unlink($old_img);
            }
            $model->images = $fileupload->uploadPic('category');
        }else{
          unset($model->images);  
        }
        if($model->save())return $this->redirect(['index']);
        } else {
            $arr = Category::find()->asArray()->all();
            $treeObj = new Tree($arr);
            return $this->render('update', [
                'model' => $model,
                'treeArr' => $treeObj->getTree(),
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $info = Category::findOne($id);    
        $fileimg = "./".$info->images;
        if(file_exists($fileimg))
        {
            @unlink($fileimg);
        }
        Category::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
