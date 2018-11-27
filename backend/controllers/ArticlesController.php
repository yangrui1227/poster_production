<?php

namespace backend\controllers;

use Yii;
use common\models\Articles;
use common\models\Category;
use backend\models\search\ArticlesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\libs\Tree;
use backend\components\AccessControl;
use yii\web\UploadedFile;
use common\models\UploadForm;
/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class ArticlesController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access']= [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['upload','item-update','item-delete'],
                        'allow' => true,
                    ],
                    
                ],
            ];
        return $behaviors;
    }

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                "imageUrlPrefix"  => Yii::$app->params['basic']['url'],//图片访问路径前缀
                "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}" //上传保存路径
                ],
            ]
        ];
    }
    
    /**
     * Lists all Articles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticlesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $arr = Category::find()->asArray()->all();
        $treeObj = new Tree($arr);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'treeArr' => $treeObj->getTree(),
        ]);
    }

    /**
     * Displays a single Articles model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Articles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Articles();
         $fileupload = new UploadForm();
       
        if ($model->load(Yii::$app->request->post())) {
             $model->create_time = time();
            $fileupload->images = UploadedFile::getInstance($model,'images');
         $model->images = $fileupload->uploadPic('articles');
            if($model->save())return $this->redirect(['view', 'id' => $model->id]);
        }

        $model->catalog_id = Yii::$app->request->get('catalog_id', 0);
        $model->view_count = 1;
         $model->sort_desc = 0;
        $arr = Category::find()->asArray()->all();
        $treeObj = new Tree($arr);
        return $this->render('create', [
                'model' => $model,
                'treeArr' => $treeObj->getTree(),
            ]);
    }

    /**
     * Updates an existing Articles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $fileupload = new UploadForm();
        if ($model->load(Yii::$app->request->post())) {
        $model->last_update_time = time(); 
        $fileupload->images = UploadedFile::getInstance($model,'images');//print_r($fileupload->images);die;
        if($fileupload->images){
            $model2 = $this->findModel($id);
            if($model2->images){
                $old_img = "./".$model2->images;
                @unlink($old_img);
            }
            $model->images = $fileupload->uploadPic('articles');
        }else{
          unset($model->images);  
        }
        if($model->save())return $this->redirect(['index']);
        }
        $arr = Category::find()->asArray()->all();
        $treeObj = new Tree($arr);
        return $this->render('update', [
            'model' => $model,
            'treeArr' => $treeObj->getTree(),
        ]);
    }

    /**
     * Deletes an existing Articles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $info = Articles::findOne($id);    
        $fileimg = "./".$info->images;
        if(file_exists($fileimg))
        {
            @unlink($fileimg);
        }
        $info->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Articles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Articles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
