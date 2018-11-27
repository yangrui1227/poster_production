<?php
namespace mobile\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use mobile\models\Activities;
use common\models\Category;
use mobile\models\Backgroundimage;
use yii\web\UploadedFile;

/**
 * Activity controller
 */
class ActivityController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if ($this->enableCsrfValidation && Yii::$app->getErrorHandler()->exception === null && !Yii::$app->getRequest()->validateCsrfToken()) {
                throw new BadRequestHttpException(Yii::t('yii', 'Unable to verify your data submission.'));
            }
        $request = Yii::$app->request->get();
         $model = $this->findModel($request['activity_id']);
         if(!$model)throw new NotFoundHttpException('活动不存在.');
         if($model->online=='2')throw new NotFoundHttpException('该活动已经下线！');
         if(date('ymd',strtotime($model->endtime))< date('ymd',time()))throw new NotFoundHttpException('该活动已过期！');
            return true;
        }

        return false;

    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $cate = Category::getCategory();
        $request = Yii::$app->request;
        $model = $this->findModel($request->get('activity_id'));      
        $data = Yii::$app->cache->get('activity_info'); 
        if(Yii::$app->request->isPost){
            $category_id =  $request->post('category_id');
            if(!$category_id)return ['code'=>'1','message'=>'请选择海报类型'];
            Yii::$app->cache->set('activity_info',['category_id'=>$category_id]);

        }
        
        return $this->render('index',
            [
                'cate'=>$cate,
                'data'=>$data,
                'model'=>$model
            ]);
    }

    /*第二步海报尺寸选择*/
    public function actionPostersize()
    {
        $request = Yii::$app->request;
        $model = $this->findModel($request->get('activity_id'));
         $data = Yii::$app->cache->get('activity_info'); 
        if(Yii::$app->request->isPost){
            $size_id =  $request->post('size_id');
            if(!$size_id)return ['code'=>'1','message'=>'请选择海报尺寸'];
            Yii::$app->cache->set('activity_info',['size_id'=>$category_id]);

        }
        return $this->render('size',['data'=>$data,'model'=>$model]);
    }

    /*第三步海报背景图选择*/
    public function actionPosterbackgroundimg()
    {
        $request = Yii::$app->request;
        $model = $this->findModel($request->get('activity_id'));
        $data = Yii::$app->cache->get('activity_info');
        if($data['size_id']){
            $bgimg = Backgroundimage::find()->where(['status_is'=>'1','attach_size'=>$data['size_id']])->asArray()->all();
        } 
        if(Yii::$app->request->isPost){
            $background_id =  $request->post('background_id');
            if(!$background_id)return ['code'=>'1','message'=>'请选择海报背景图'];
            Yii::$app->cache->set('activity_info',['background_id'=>$background_id]);

        }
         return $this->render('backgroundimg',['data'=>$data,'model'=>$model,'bglist'=>$bgimg]);
    }

    /*第三步上传新的海报图片*/
    public function actionUploadbg()
    {
        $model = new Backgroundimage();
        $attach_file = $model->uploadPic('user_upload_background');
        
    }

    /*第四步上传活动主图*/
    public function actionPostermainimg()
    {
        
    }
    
    /**
     * Finds the Activities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
   protected function findModel($id)
    {
        if (($model = Activities::findOne($id)) !== null) {
            return $model;
        }

        
    }


}
