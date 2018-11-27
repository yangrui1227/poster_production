<?php

namespace backend\controllers;

use Yii;
use common\models\Gallery;
use common\models\GalleryItem;
use backend\models\search\GallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\AccessControl;
/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends BaseController
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
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }


    /*图集的排序和描述的修改操作*/
    public function actionItemUpdate($id){
        $modelitem = new GalleryItem();
        $model = $this->findModel($id);
        $item = $modelitem->find()->where('item = :item',[':item'=>$id])->asArray()->all();
        if ($modelitem->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            //print_r($data);die;
            foreach ($data['GalleryItem']['listorder']  as $key => $value){
               $item = GalleryItem::find()->where(['id' => $data['GalleryItem']['id'][$key]])->one();              
               $item->item = $model->id;
               $item->introduce = $data['GalleryItem']['introduce'][$key];
               $item->listorder =$value;
               $item->save(false);
            } 
            return $this->redirect(['item-update', 'id' => $model->id]);
        }
        return $this->render('item-view', [
            'model' => $model,
            'item'=>$item,
            'modelitem'=>$modelitem
        ]);
    }

    /*图集的图片删除*/
    public function actionItemDelete($id,$item)
    {
        $info = GalleryItem::findOne($id);
        $fileimg = ".".$info->files;
        if(file_exists($fileimg))
        {
            @unlink($fileimg);
        }
         GalleryItem::findOne($id)->delete();

        return $this->redirect(['item-update','id' => $item]);
    }
    /**
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gallery();
        $modelitem = new GalleryItem();
        $data= Yii::$app->request->post();
        //print_r($gallery);die;
        $model->addtime = date('Y-m-d H:i:s',time());
        try {
          if ($model->load(Yii::$app->request->post())) {
            if($model->save(false)){
                 if($data['GalleryItem']['files']&&is_array($gallery = $data['GalleryItem']['files'])){
                   foreach ($gallery  as $key => $value){
                   $item = new GalleryItem();
                   $item->item = $model->id;
                   $item->files = $value;
                   $item->save();
                } 
                }           
                
            return $this->redirect(['view', 'id' => $model->id]);              
            }
            
            }  
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        
        return $this->render('create', [
            'model' => $model,
            'modelitem'=>$modelitem
        ]);
    }

    /**
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelitem = new GalleryItem();
       $modelitem_value = GalleryItem::getGalleryItem($id);
        
        $data= Yii::$app->request->post();
        
        try {
          if ($model->load(Yii::$app->request->post())&& $model->save() && $modelitem->GalleryItemSave($id)) {     
        return $this->redirect(['view', 'id' => $model->id]);
            }  
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $this->render('update', [
            'model' => $model,
            'modelitem'=>$modelitem,
            'modelitem_value'=>$modelitem_value
        ]);
    }

    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $info = Gallery::findOne($id);
        $lists = GalleryItem::find()->where(['item'=>$info->id])->all();
        foreach ($lists as $key => $val) {
            //删除旧文件
            if(!empty($val['files'])){
                @unlink('.'.$val['files']);
            }
        }
        GalleryItem::deleteAll(['item'=>$info->id]);
        $fileimg = ".".$info->thumb;
        if(file_exists($fileimg))
        {
            @unlink($fileimg);
        }
        Gallery::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
