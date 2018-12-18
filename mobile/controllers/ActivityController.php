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
use common\models\UploadForm;
use mobile\models\Config;
use mobile\models\UploadFiles;
use mobile\models\ActivityPoster;
use mobile\models\ActivityPoster1;
use mobile\models\ActivityPoster2;
use mobile\models\ActivityPoster3;
use yii\web\Response;

/**
 * Activity controller
 */
class ActivityController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['geturl', ],
                'rules' => [
                    [
                        'actions' => ['geturl'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'geturl' => ['post'],
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
    * @param  $action
    * @return [type]
    */
    public function beforeAction($action) {  
        $currentaction = $action->id;  
        $novalidactions = ['saveimg','deletesaveimg','getchuangshuourl','makerongyulink','maketiezhilink'];  
        if(in_array($currentaction,$novalidactions)) {  
            $action->controller->enableCsrfValidation = false;  
        }  
        parent::beforeAction($action);  
        return true;  
    } 

   
    /*活动的状态的判断*/
    protected  function GetActivityStatus()
    {
         if(Yii::$app->params['basic']['close']=='1')return ['code'=>'1','msg'=>Yii::$app->params['basic']['close_reason']];  
        $request = Yii::$app->request->get();
         $model = $this->findModel($request['activity_id']);
         if(!$model)return ['code'=>'1','msg'=>'该活动不存在了。'];
         if($model->online=='2')return ['code'=>'1','msg'=>'该活动已经下线！'];
         if(date('ymd',strtotime($model->endtime))< date('ymd',time()))return ['code'=>'1','msg'=>'该活动已过期！'];
         return true;
        }
    

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {  
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
       /*海报类型*/
        $cate = Category::getCategory();
        $request = Yii::$app->request;
        $model = $this->findModel($request->get('activity_id'));      
        return $this->render('index',
            [
                'cate'=>$cate,
                'model'=>$model
            ]);
    }

    /*第二步海报尺寸选择*/
    public function actionPostersize()
    {
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $request = Yii::$app->request;
        $model = $this->findModel($request->get('activity_id'));
        $category_id =  $request->get('category_id');
        if(!$category_id)return $this->msgerror('请选择海报类型');

        return $this->render('size',[
            'category_id'=>$category_id,
            'model'=>$model
        ]);
    }

    /*第三步海报背景图选择*/
    public function actionPosterbackgroundimg()
    {

         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);

        $request = Yii::$app->request;

         $category_id =  $request->get('category_id');
        if(!$category_id)return $this->msgerror('请选择海报类型');

         $size_id =  $request->get('size_id');
        if(!$size_id)return $this->msgerror('请选择海报尺寸');

        $model = $this->findModel($request->get('activity_id'));

        if($size_id){
        $bgimg = Backgroundimage::find()->where(['status_is'=>'1','attach_size'=>$size_id])->asArray()->all();
        } 
        /*判断模板*/
        $template =  Activities::$TEMPLATE_BACKGROUND[$category_id];
        /*判断模板*/
       
       $upload_files = new UploadFiles();
         return $this->render($template,[
            'category_id'=>$category_id,
            'size_id'=>$size_id,
            'model'=>$model,
            'bglist'=>$bgimg,
            'upload_files'=>$upload_files
        ]);
    }

    /*第三步上传新的海报图片*/
    public function actionUploadbg()
    {
        $UploadFiles = new UploadFiles();
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);

        $request = Yii::$app->request;

         $category_id =  $request->get('category_id');
        if(!$category_id)return $this->msgerror('请选择海报类型');

         $size_id =  $request->get('size_id');
        if(!$size_id)return $this->msgerror('请选择海报尺寸');

        $attach_file = $UploadFiles->uploadPic('upload_files');
        
         /*判断模板*/
        $template =  Activities::$TEMPLATE_FORM[$category_id];
        /*判断模板*/

        if($attach_file){
           $UploadFiles->save_path = $attach_file;
            $UploadFiles->create_time = time();
            if($UploadFiles->save()){

                return $this->redirect([$template,'activity_id'=>$request->get('activity_id'),'category_id'=>$category_id,'size_id'=>$size_id, 'new_background_id' => $UploadFiles->id]);
            } else{
               return $this->msgerror('海报背景图片上传失败'); 
            }  
        }
       return $this->msgerror('海报背景图片上传失败');

    }

    /*第四步活动主图页面*/
    public function actionPostermainimg()
    {
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);

        $request = Yii::$app->request;

         $category_id =  $request->get('category_id');
        if(!$category_id)return $this->msgerror('请选择海报类型');

         $size_id =  $request->get('size_id');
        if(!$size_id)return $this->msgerror('请选择海报尺寸');

        $background_id =  $request->get('background_id');
        $new_background_id =  $request->get('new_background_id');

        if(!$background_id && !$new_background_id)return $this->msgerror('请选择背景图片或者上传新背景图片');
         $model = $this->findModel($request->get('activity_id'));
          /*判断模板*/
          $template =  Activities::$TEMPLATE_FORM[$category_id];
           /*判断模板*/

        /*上传活动主图*/
         $UploadFiles = new UploadFiles();
        if (Yii::$app->request->isPost) {
            $attach_file = $UploadFiles->uploadPic('upload_files');  
            if($attach_file){
               $UploadFiles->save_path = $attach_file;
                $UploadFiles->create_time = time();
                if($UploadFiles->save()){
                    $upimg = $UploadFiles->findOne($UploadFiles->id);
                    

                    return $this->redirect([$template,
                        'activity_id'=>$model->id,
                        'category_id'=>$category_id,
                        'size_id'=>$size_id, 
                        'background_id'=>$background_id,
                        'new_background_id' => $new_background_id,
                        'activity_image'=>$UploadFiles->id
                    ]);
                } else{
                   return $this->msgerror('活动主图上传失败'); 
                }  
            }
        }
         $activity_image =  $request->get('activity_image');
        if($activity_image){

            $upimg = $UploadFiles->findOne($activity_image);
        }

        
      
         return $this->render('postermainimg',[
            'category_id'=>$category_id,
            'size_id'=>$size_id,
            'model'=>$model,
            'upimg'=>$upimg,
            'background_id'=>$background_id,
            'new_background_id' => $new_background_id,
            'activity_image'=>$activity_image,
        ]);

    }

    /*主拓活动生成活动链接*/
    public function actionGeturl()
    {
        $request = Yii::$app->request;
        $activity_id = $request->post('activity_id');//活动id
        $category_id = $request->post('category_id');//海报类型
        $size_id = $request->post('size_id');//海报尺寸
        $background_id = $request->post('background_id');//选择海报背景
        $new_background_id = $request->post('new_background_id');//上传海报背景
        $activity_image = $request->post('activity_image');//活动主图
        $send_url = Activities::send_url($activity_id,$category_id,$size_id,$background_id,$new_background_id,$activity_image);
       return $send_url;exit();

    }
    

    /*第四步主拓活动的信息页面*/
    public function actionMainextensionfrom(){
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $request = Yii::$app->request;
        if(!$request->get('method'))return $this->msgerror('链接失效'); 
            $params = json_decode(base64_decode($request->get('method')));
            //print_r($params);die;
             $category_id =  $params->category_id;
            if(!$category_id)return $this->msgerror('请选择海报类型');

             $size_id =  $params->size_id;
            if(!$size_id)return $this->msgerror('请选择海报尺寸');

            $background_id =  $params->background_id;
            $new_background_id =  $params->new_background_id;

            if(!$background_id && !$new_background_id)return $this->msgerror('请选择背景图片或者上传新背景图片');
            $activity_image = $params->activity_image;
            if(!$activity_image)return $this->msgerror('请上传活动主图');
             $model = $this->findModel($request->get('activity_id'));
             if($activity_image){
                 $UploadFiles = new UploadFiles();
                 $upimg = $UploadFiles->findOne($activity_image);
              }

              /*提交表单*/
              $UploadFiles = new UploadFiles();
                if (Yii::$app->request->isPost) {
                    $result = Yii::$app->request->post();
                    if(!$result['name'])return $this->msgerror('请填写代理人姓名');
                    if(!$result['worknumber'])return $this->msgerror('请填写代理人工号'); 
                    if(!$result['phone'])return $this->msgerror('请填写代理人手机号'); 
                    if(!$result['wechat'])return $this->msgerror('请填写代理人微信'); 
                    if(!$result['zhuti'])return $this->msgerror('请填写活动主题'); 
                    if(!$result['start_time'])return $this->msgerror('请填写活动时间'); 
                    if(!$result['address'])return $this->msgerror('请填写活动地址'); 
                    if(!$result['price'])return $this->msgerror('请填写活动价格'); 
                    if(!$result['number'])return $this->msgerror('请填写成团人数'); 
                    if(!$result['brief'])return $this->msgerror('请填写活动简介');  
                    $attach_file = $UploadFiles->uploadPic('upload_files');  
                    if($attach_file){
                       $UploadFiles->save_path = $attach_file;
                        $UploadFiles->create_time = time();
                        if($UploadFiles->save()){
                           $activity_image =  $UploadFiles->id;   
                        } else{
                           return $this->msgerror('活动主图上传失败'); 
                        }  
                    }
                    $result['activity_id'] = $model->id;
                    $result['category_id'] = $category_id;
                    $result['size_id'] = $size_id;
                    $result['background_id'] = $background_id;
                    $result['new_background_id'] = $new_background_id;
                    $result['activity_image'] = $activity_image;
                    $cookies = Yii::$app->response->cookies;
                    $cache_key ="ACTIVITY_CACHE_1";
                    
                    // 在要发送的响应中添加一个新的 cookie
                    $cookies->add(new \yii\web\Cookie([
                        'name' => $cache_key,
                        'value' => $result,
                    ]));
                   return $this->redirect(['mainshow','activity_id'=>$model->id,]); 
                }
              /*提交表单*/

              return $this->render('mainextensionfrom',[
                'category_id'=>$category_id,
                'size_id'=>$size_id,
                'model'=>$model,
                'background_id'=>$background_id,
                'new_background_id' => $new_background_id,
                'activity_image'=>$activity_image,
                'upimg'=>$upimg
             ]);      
    }

    /*主拓活动的预览*/
    public function actionMainshow()
    {
        $this->layout = false;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $cookies = Yii::$app->request->cookies;
       $cache_key ="ACTIVITY_CACHE_1";
       $data = $cookies[$cache_key]->value;

        $UploadFiles = new UploadFiles();
        $Backgroundimage = new Backgroundimage();
        $background =  $Backgroundimage->findOne($data['background_id']);
        $zhutu =  $UploadFiles->findOne($data['activity_image']);
        $model = $this->findModel($data['activity_id']);
        $new_background =  $UploadFiles->findOne($data['new_background_id']);
        return $this->render('mainshow',[
                'data'=>$data,
                'background'=>$background,
                'zhutu'=>$zhutu,
                'model'=>$model,
                'new_background'=>$new_background
             ]);      
    }

    /*主拓活动的生成海报*/
    public function actionSaveposter()
    {
        $this->layout = false;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
       $cookies = Yii::$app->request->cookies;
       $cache_key ="ACTIVITY_CACHE_1";
       $data = $cookies[$cache_key]->value;
       if(!$data)return $this->msgerror("缺少参数，不能生成海报！");
      // print_r($data);die;
        try {
          $ActivityPoster = new ActivityPoster();
          $ActivityPoster1 = new ActivityPoster1();
          $ActivityPoster->activity_id = $data['activity_id'];
          $ActivityPoster->category_id = $data['category_id'];
          $ActivityPoster->category_size = $data['size_id'];
          $ActivityPoster->background_id = $data['background_id'];
          $ActivityPoster->background_image = $data['new_background_id'];
          $ActivityPoster->activity_image = $data['activity_image'];
          $ActivityPoster->name = $data['name'];
          $ActivityPoster->worknumber = $data['worknumber'];
          $ActivityPoster->phone = $data['phone'];
          $ActivityPoster->wechat = $data['wechat'];
          $ActivityPoster->addtime = date('Y-m-d H:i:s',time());
          if($ActivityPoster->save()){
            $ActivityPoster1->poster_id = $ActivityPoster->id;
            $ActivityPoster1->name = $data['zhuti'];
            $ActivityPoster1->start_time = $data['start_time'];
            $ActivityPoster1->address = $data['address'];
            $ActivityPoster1->price = $data['price'];
            $ActivityPoster1->number = $data['number'];
            $ActivityPoster1->brief = $data['brief'];
            $ActivityPoster1->addtime = date('Y-m-d H:i:s',time());
            $ActivityPoster1->save();
          }
          $cookies = Yii::$app->response->cookies;
          $cookies->remove($cache_key);
          return $this->redirect(['mainposter','activity_id'=>$data['activity_id'],'poster_id'=>$ActivityPoster->id,]); 
        } catch (Exception $e) {
            return $this->msgerror("系统错误");
            die;
        }

    }

    /*主拓活动生成海报预览活动*/
    public function actionMainposter()
    {
       $this->layout = false;
        $request = Yii::$app->request;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $poster_id = Yii::$app->request->get('poster_id');
        $poster = ActivityPoster::findOne($poster_id);
        $huodong = ActivityPoster1::find()->where(['poster_id'=>$poster_id])->one();
        $model = $this->findModel($request->get('activity_id'));
         return $this->render('mainposter',[
                'poster'=>$poster,
                'huodong'=>$huodong,
                'poster_id'=>$poster_id,
                'model'=>$model
             ]); 
    }

    /*创说会的大A表单*/
    public function actionPosterchuangshuoform()
    {
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $request = Yii::$app->request;
          $category_id =  $request->get('category_id');
        if(!$category_id)return $this->msgerror('请选择海报类型');

         $size_id =  $request->get('size_id');
        if(!$size_id)return $this->msgerror('请选择海报尺寸');

        $background_id =  $request->get('background_id');
        $new_background_id =  $request->get('new_background_id');

        if(!$background_id && !$new_background_id)return $this->msgerror('请选择背景图片或者上传新背景图片');
         $activity_image = $request->get('activity_image');
         if(!$activity_image)return $this->msgerror('请上传活动主图');

         $model = $this->findModel($request->get('activity_id'));

         return $this->render('posterchuangshuoform',[
                'category_id'=>$category_id,
                'size_id'=>$size_id,
                'background_id'=>$background_id,
                'new_background_id'=>$new_background_id,
                'activity_image'=>$activity_image,
                'model'=>$model
             ]); 
    }

     /*创说会生成活动链接*/
    public function actionGetchuangshuourl()
    {
        $request = Yii::$app->request;
        $activity_id = $request->post('activity_id');//活动id
        $category_id = $request->post('category_id');//海报类型
        $size_id = $request->post('size_id');//海报尺寸
        $background_id = $request->post('background_id');//选择海报背景
        $new_background_id = $request->post('new_background_id');//上传海报背景
        $activity_image = $request->post('activity_image');//活动主图
        $name = $request->post('name');//创说会名称
        $start_time = $request->post('start_time');//创说会时间
        $address = $request->post('address');//创说会地址
        $lecturer = $request->post('lecturer');//创说会讲师
        $brief = $request->post('brief');//创说会简介
        $send_url = Activities::send_chuangshuo_url($activity_id,$category_id,$size_id,$background_id,$new_background_id,$activity_image,$name,$start_time,$address,$lecturer,$brief);
       return $send_url;exit();

    }

    /*创说会小A打开地址*/
    public function actionChuangshuoform()
    {
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $request = Yii::$app->request;
        if(!$request->get('method'))return $this->msgerror('链接失效'); 
            $params = json_decode(base64_decode($request->get('method')));
            //print_r($params);die;
             $category_id =  $params->category_id;
            if(!$category_id)return $this->msgerror('请选择海报类型');

             $size_id =  $params->size_id;
            if(!$size_id)return $this->msgerror('请选择海报尺寸');

            $background_id =  $params->background_id;
            $new_background_id =  $params->new_background_id;

            if(!$background_id && !$new_background_id)return $this->msgerror('请选择背景图片或者上传新背景图片');
            $activity_image = $params->activity_image;
            if(!$activity_image)return $this->msgerror('请上传活动主图');

            $model = $this->findModel($request->get('activity_id'));
             /*提交表单*/
              //$UploadFiles = new UploadFiles();
                if (Yii::$app->request->isPost) {
                    $result = Yii::$app->request->post();
                    if(!$result['name'])return $this->msgerror('请填写代理人姓名');
                    if(!$result['worknumber'])return $this->msgerror('请填写代理人工号'); 
                    if(!$result['phone'])return $this->msgerror('请填写代理人手机号'); 
                    if(!$result['wechat'])return $this->msgerror('请填写代理人微信'); 
                    //$attach_file = $UploadFiles->uploadPic('upload_files');  
                    /*if($attach_file){
                       $UploadFiles->save_path = $attach_file;
                        $UploadFiles->create_time = time();
                        if($UploadFiles->save()){
                           $activity_image =  $UploadFiles->id;   
                        } else{
                           return $this->msgerror('活动主图上传失败'); 
                        }  
                    }*/
                    $result['activity_id'] = $model->id;
                    $result['category_id'] = $category_id;
                    $result['size_id'] = $size_id;
                    $result['background_id'] = $background_id;
                    $result['new_background_id'] = $new_background_id;
                    $result['activity_image'] = $activity_image;
                   $result['chuangshuoname'] = $params->name;
                   $result['start_time'] = $params->start_time;
                   $result['address'] =  $params->address;
                   $result['lecturer'] =  $params->lecturer;
                   $result['brief'] =  $params->brief;
                    $cookies = Yii::$app->response->cookies;
                    $cache_key ="ACTIVITY_CACHE_2";

                    
                    // 在要发送的响应中添加一个新的 cookie
                    $cookies->add(new \yii\web\Cookie([
                        'name' => $cache_key,
                        'value' => $result,
                    ]));
                   return $this->redirect(['chuangshuoshow','activity_id'=>$model->id,]); 
                }
              /*提交表单*/
            return $this->render('chuangshuoform',[
                'category_id'=>$category_id,
                'size_id'=>$size_id,
                'background_id'=>$background_id,
                'new_background_id'=>$new_background_id,
                'activity_image'=>$activity_image,
                'model'=>$model
             ]);  
    }

    /*创说会的预览海报*/
    public function actionChuangshuoshow()
    {
         $this->layout = false;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $cookies = Yii::$app->request->cookies;
       $cache_key ="ACTIVITY_CACHE_2";
       $data = $cookies[$cache_key]->value;

        $UploadFiles = new UploadFiles();
        $Backgroundimage = new Backgroundimage();
        $background =  $Backgroundimage->findOne($data['background_id']);
        $zhutu =  $UploadFiles->findOne($data['activity_image']);
        $model = $this->findModel($data['activity_id']);
        $new_background =  $UploadFiles->findOne($data['new_background_id']);
        return $this->render('chuangshuoshow',[
                'data'=>$data,
                'background'=>$background,
                'zhutu'=>$zhutu,
                'model'=>$model,
                'new_background'=>$new_background
             ]);    
    }

    /*创说会的生成海报*/
    public function actionSavechuangshuoposter()
    {
        $this->layout = false;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
       $cookies = Yii::$app->request->cookies;
       $cache_key ="ACTIVITY_CACHE_2";
       $data = $cookies[$cache_key]->value;
       if(!$data)return $this->msgerror("缺少参数，不能生成海报！");
      // print_r($data);die;
        try {
          $ActivityPoster = new ActivityPoster();
          $ActivityPoster2 = new ActivityPoster2();
          $ActivityPoster->activity_id = $data['activity_id'];
          $ActivityPoster->category_id = $data['category_id'];
          $ActivityPoster->category_size = $data['size_id'];
          $ActivityPoster->background_id = $data['background_id'];
          $ActivityPoster->background_image = $data['new_background_id'];
          $ActivityPoster->activity_image = $data['activity_image'];
          $ActivityPoster->name = $data['name'];
          $ActivityPoster->worknumber = $data['worknumber'];
          $ActivityPoster->phone = $data['phone'];
          $ActivityPoster->wechat = $data['wechat'];
          $ActivityPoster->addtime = date('Y-m-d H:i:s',time());
          if($ActivityPoster->save()){
            $ActivityPoster2->poster_id = $ActivityPoster->id;
            $ActivityPoster2->name = $data['chuangshuoname'];
            $ActivityPoster2->start_time = $data['start_time'];
            $ActivityPoster2->address = $data['address'];
            $ActivityPoster2->lecturer = $data['lecturer'];
            $ActivityPoster2->brief = $data['brief'];
            $ActivityPoster2->addtime = date('Y-m-d H:i:s',time());
            $ActivityPoster2->save();
          }
          $cookies = Yii::$app->response->cookies;
          $cookies->remove($cache_key);
          return $this->redirect(['mainchuangshuoposter','activity_id'=>$data['activity_id'],'poster_id'=>$ActivityPoster->id,]); 
        } catch (Exception $e) {
            return $this->msgerror("系统错误");
            die;
        }

    }
    /*创说会生成海报预览*/
     public function actionMainchuangshuoposter()
    {
       $this->layout = false;
        $request = Yii::$app->request;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $poster_id = Yii::$app->request->get('poster_id');
        $poster = ActivityPoster::findOne($poster_id);
        $huodong = ActivityPoster2::find()->where(['poster_id'=>$poster_id])->one();
        //print_r($huodong);die;
        $model = $this->findModel($request->get('activity_id'));
         return $this->render('mainchuangshuoposter',[
                'poster'=>$poster,
                'huodong'=>$huodong,
                'poster_id'=>$poster_id,
                'model'=>$model
             ]); 
    }



    /*个人荣誉的生成活动链接*/
    public function actionMakerongyulink()
    {
        $request = Yii::$app->request;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
         $category_id =  $request->get('category_id');
        if(!$category_id)return $this->msgerror('请选择海报类型');

         $size_id =  $request->get('size_id');
        if(!$size_id)return $this->msgerror('请选择海报尺寸');

        $background_id =  $request->get('background_id');
        $new_background_id =  $request->get('new_background_id');

        if(!$background_id && !$new_background_id)return $this->msgerror('请选择背景图片或者上传新背景图片');
        $activity_id =$request->get('activity_id');
         $model = $this->findModel($activity_id);
         $send_url = Activities::send_rongyu_url($activity_id,$category_id,$size_id,$background_id,$new_background_id);


         return $this->render('makerongyulink',[
                'category_id'=>$category_id,
                'size_id'=>$size_id,
                'background_id'=>$background_id,
                'new_background_id'=>$new_background_id,
                'model'=>$model,
                'send_url'=>$send_url
             ]); 

    }

    /*个人荣誉的表单页面*/
    public function actionMainrongyufrom()
    {
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $request = Yii::$app->request;
        if(!$request->get('method'))return $this->msgerror('链接失效'); 
            $params = json_decode(base64_decode($request->get('method')));
            //print_r($params);die;
             $category_id =  $params->category_id;
            if(!$category_id)return $this->msgerror('请选择海报类型');

             $size_id =  $params->size_id;
            if(!$size_id)return $this->msgerror('请选择海报尺寸');

            $background_id =  $params->background_id;
            $new_background_id =  $params->new_background_id;

            if(!$background_id && !$new_background_id)return $this->msgerror('请选择背景图片或者上传新背景图片');
 
            $model = $this->findModel($request->get('activity_id'));
             /*提交表单*/
              $UploadFiles = new UploadFiles();
                if (Yii::$app->request->isPost) {
                    $result = Yii::$app->request->post();

                    if(!$result['name'])return $this->msgerror('请填写姓名');
                    if(!$result['worknumber'])return $this->msgerror('请填写代理人工号'); 
                    if(!$result['phone'])return $this->msgerror('请填写代理人手机号'); 
                    if(!$result['wechat'])return $this->msgerror('请填写代理人微信');
                    if(!$result['brief'])return $this->msgerror('请填写获奖信息');  
                    $attach_file = $UploadFiles->uploadPic('upload_files');  
                    if($attach_file){
                       $UploadFiles->save_path = $attach_file;
                        $UploadFiles->create_time = time();
                        if($UploadFiles->save()){
                           $activity_image =  $UploadFiles->id;   
                        } else{
                           return $this->msgerror('主图上传失败'); 
                        }  
                    }
                    $result['activity_id'] = $model->id;
                    $result['category_id'] = $category_id;
                    $result['size_id'] = $size_id;
                    $result['background_id'] = $background_id;
                    $result['new_background_id'] = $new_background_id;
                    $result['activity_image'] = $activity_image;
                    $cookies = Yii::$app->response->cookies;
                    $cache_key ="ACTIVITY_CACHE_3";
                   
                    // 在要发送的响应中添加一个新的 cookie
                    $cookies->add(new \yii\web\Cookie([
                        'name' => $cache_key,
                        'value' => $result,
                    ]));
                   return $this->redirect(['rongyushow','activity_id'=>$model->id,]); 
                }
              /*提交表单*/
            return $this->render('rongyuform',[
                'category_id'=>$category_id,
                'size_id'=>$size_id,
                'background_id'=>$background_id,
                'new_background_id'=>$new_background_id,
                'activity_image'=>$activity_image,
                'model'=>$model
             ]);  
    }

    /*个人荣誉海报预览*/
    public function actionRongyushow()
    {
        $this->layout = false;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $cookies = Yii::$app->request->cookies;
       $cache_key ="ACTIVITY_CACHE_3";
       $data = $cookies[$cache_key]->value;

        $UploadFiles = new UploadFiles();
        $Backgroundimage = new Backgroundimage();
        $background =  $Backgroundimage->findOne($data['background_id']);
        $zhutu =  $UploadFiles->findOne($data['activity_image']);
        $model = $this->findModel($data['activity_id']);
        $new_background =  $UploadFiles->findOne($data['new_background_id']);
        return $this->render('rongyushow',[
                'data'=>$data,
                'background'=>$background,
                'zhutu'=>$zhutu,
                'model'=>$model,
                'new_background'=>$new_background
             ]);    
    }

    /*个人荣誉的生成海报*/
    public function actionSaverongyuposter()
    {
        $this->layout = false;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
       $cookies = Yii::$app->request->cookies;
       $cache_key ="ACTIVITY_CACHE_3";
       $data = $cookies[$cache_key]->value;
       if(!$data)return $this->msgerror("缺少参数，不能生成海报！");
      // print_r($data);die;
        try {
          $ActivityPoster = new ActivityPoster();
          $ActivityPoster3 = new ActivityPoster3();
          $ActivityPoster->activity_id = $data['activity_id'];
          $ActivityPoster->category_id = $data['category_id'];
          $ActivityPoster->category_size = $data['size_id'];
          $ActivityPoster->background_id = $data['background_id'];
          $ActivityPoster->background_image = $data['new_background_id'];
          $ActivityPoster->activity_image = $data['activity_image'];
          $ActivityPoster->worknumber = $data['worknumber'];
          $ActivityPoster->phone = $data['phone'];
          $ActivityPoster->wechat = $data['wechat'];
          $ActivityPoster->addtime = date('Y-m-d H:i:s',time());
          if($ActivityPoster->save()){
            $ActivityPoster3->poster_id = $ActivityPoster->id;
             $ActivityPoster3->uname = $data['name'];
            $ActivityPoster3->brief = $data['brief'];
            $ActivityPoster3->addtime = date('Y-m-d H:i:s',time());
            $ActivityPoster3->save();
          }
          $cookies = Yii::$app->response->cookies;
          $cookies->remove($cache_key);
          return $this->redirect(['mainrongyuposter','activity_id'=>$data['activity_id'],'poster_id'=>$ActivityPoster->id,]); 
        } catch (Exception $e) {
            return $this->msgerror("系统错误");
            die;
        }

    }
    /*个人荣誉的生成海报预览*/
     public function actionMainrongyuposter()
    {
       $this->layout = false;
        $request = Yii::$app->request;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $poster_id = Yii::$app->request->get('poster_id');
        $poster = ActivityPoster::findOne($poster_id);
        $huodong = ActivityPoster3::find()->where(['poster_id'=>$poster_id])->one();
        //print_r($huodong);die;
        $model = $this->findModel($request->get('activity_id'));
         return $this->render('mainrongyuposter',[
                'poster'=>$poster,
                'huodong'=>$huodong,
                'poster_id'=>$poster_id,
                'model'=>$model
             ]); 
    }

    /*荣誉贴纸页面*/
    public function actionPostertiezhi()
    {

         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
       $request = Yii::$app->request;
        $model = $this->findModel($request->get('activity_id'));
        $category_id =  $request->get('category_id');
        if(!$category_id)return $this->msgerror('请选择海报类型');
        /*上传浮层图片*/
         $UploadFiles = new UploadFiles();
        if (Yii::$app->request->isPost) {
            $attach_file = $UploadFiles->uploadPic('upload_files');  
            if($attach_file){
               $UploadFiles->save_path = $attach_file;
                $UploadFiles->create_time = time();
                if($UploadFiles->save()){
                    $upimg = $UploadFiles->findOne($UploadFiles->id);
                    

                    return $this->redirect([$template,
                        'activity_id'=>$model->id,
                        'category_id'=>$category_id,
                        'activity_image'=>$UploadFiles->id,
                         'model'=>$model
                    ]);
                } else{
                   return $this->msgerror('浮层图片上传失败'); 
                }  
            }
        }
        /*上传浮层图片*/
         $activity_image =  $request->get('activity_image');
        if($activity_image){
            $upimg = $UploadFiles->findOne($activity_image);
        }
        return $this->render('postertiezhi',[
            'category_id'=>$category_id,
            'upimg'=>$upimg,
            'activity_image'=>$activity_image,
            'model'=>$model
        ]);
    }

    /*荣誉贴纸的生成活动链接*/
    public function actionMaketiezhilink()
    {
        $request = Yii::$app->request;
         $category_id =  $request->post('category_id');
         $activity_image =  $request->post('activity_image');
         $activity_id =$request->post('activity_id');
         $model = $this->findModel($activity_id);
         $send_url = Activities::send_tiezhi_url($activity_id,$category_id,$activity_image);
         return $send_url;exit();        

    }

    /*荣誉贴纸小A上传背景图页面*/
    public function actionMaintiezhibg()
    {
        /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $request = Yii::$app->request;
        if(!$request->get('method'))return $this->msgerror('链接失效'); 
            $params = json_decode(base64_decode($request->get('method')));
            //print_r($params);die;
             $category_id =  $params->category_id;
            if(!$category_id)return $this->msgerror('请选择海报类型');

             $activity_image =  $params->activity_image;
            if(!$activity_image)return $this->msgerror('请上传浮层图片');

 
         $model = $this->findModel($request->get('activity_id'));
           /*上传背景图片*/
         $UploadFiles = new UploadFiles();
        if (Yii::$app->request->isPost) {
            $attach_file = $UploadFiles->uploadPic('upload_files');  
            
            if($attach_file){
               $UploadFiles->save_path = $attach_file;
                $UploadFiles->create_time = time();
                if($UploadFiles->save()){
                    $new_background_id = $UploadFiles->findOne($UploadFiles->id);
                    
                    return $this->redirect(['maintiezhibg',
                        'activity_id'=>$model->id,
                        'method'=>$request->get('method'),
                        //'category_id'=>$category_id,
                        //'activity_image'=>$activity_image,
                        'new_background_id'=>$UploadFiles->id
                    ]);
                } else{
                   return $this->msgerror('背景图片上传失败'); 
                }  
            }else{
                   return $this->msgerror('背景图片上传失败'); 
                } 
        }
        if($request->get('new_background_id')){
            $new_background_id = $request->get('new_background_id');
        }
        /*上传背景图片*/  
         return $this->render('maintiezhibg',[
            'category_id'=>$category_id,
            'activity_image'=>$activity_image,
            'model'=>$model,
            'activity_id'=>$model->id,
            'new_background_id'=>$new_background_id,
            'method'=>$request->get('method')
        ]);
    }

    /*荣誉贴纸代理人信息页面*/
    public function actionMaintiezhiform()
    {
        /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $request = Yii::$app->request;
         $category_id =  $request->get('category_id');
         if(!$category_id)return $this->msgerror('请选择海报类型');

         $activity_image =  $request->get('activity_image');
        if(!$activity_image)return $this->msgerror('请上传浮层图片');
        $new_background_id =  $request->get('new_background_id');
 
         $model = $this->findModel($request->get('activity_id'));
         /*提交表单*/
        if (Yii::$app->request->isPost) {
            $result = Yii::$app->request->post();

            //if(!$result['name'])return $this->msgerror('请填写姓名');
            if(!$result['worknumber'])return $this->msgerror('请填写代理人工号'); 
            if(!$result['phone'])return $this->msgerror('请填写代理人手机号'); 
            if(!$result['wechat'])return $this->msgerror('请填写代理人微信');
            $result['activity_id'] = $model->id;
            $result['category_id'] = $category_id;
            $result['new_background_id'] = $new_background_id;
            $result['activity_image'] = $activity_image;
            $cookies = Yii::$app->response->cookies;
            $cache_key ="ACTIVITY_CACHE_4";
           
            // 在要发送的响应中添加一个新的 cookie
            $cookies->add(new \yii\web\Cookie([
                'name' => $cache_key,
                'value' => $result,
            ]));
           return $this->redirect(['tiezhishow','activity_id'=>$model->id,]); 
        }
      /*提交表单*/
         return $this->render('maintiezhiform',[
            'category_id'=>$category_id,
            'activity_image'=>$activity_image,
            'new_background_id'=>$new_background_id,
            'model'=>$model
        ]);
    }

    /*荣誉贴纸的海报预览*/
    public function actionTiezhishow()
    {
        $this->layout = false;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $cookies = Yii::$app->request->cookies;
       $cache_key ="ACTIVITY_CACHE_4";
       $data = $cookies[$cache_key]->value;

       if(!$data)return $this->msgerror("缺少参数，不能生成海报！");
        $UploadFiles = new UploadFiles();
        $model = $this->findModel($data['activity_id']);
        $new_background =  $UploadFiles->findOne($data['new_background_id']);
        $activity_image =  $UploadFiles->findOne($data['activity_image']);
        return $this->render('tiezhishow',[
                'data'=>$data,
                'model'=>$model,
                'activity_image'=>$activity_image,
                'new_background'=>$new_background
             ]);    
    }

     /*荣誉贴纸的生成海报*/
    public function actionSavetiezhiposter()
    {
        $this->layout = false;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
       $cookies = Yii::$app->request->cookies;
       $cache_key ="ACTIVITY_CACHE_4";
       $data = $cookies[$cache_key]->value;
       if(!$data)return $this->msgerror("缺少参数，不能生成海报！");
      // print_r($data);die;
        try {
          $ActivityPoster = new ActivityPoster();
         
          $ActivityPoster->activity_id = $data['activity_id'];
          $ActivityPoster->category_id = $data['category_id'];
          /*$ActivityPoster->category_size = $data['size_id'];
          $ActivityPoster->background_id = $data['background_id'];*/
          $ActivityPoster->background_image = $data['new_background_id'];
          $ActivityPoster->activity_image = $data['activity_image'];
         // $ActivityPoster->name = $data['name'];
          $ActivityPoster->worknumber = $data['worknumber'];
          $ActivityPoster->phone = $data['phone'];
          $ActivityPoster->wechat = $data['wechat'];
          $ActivityPoster->addtime = date('Y-m-d H:i:s',time());
          $ActivityPoster->save();
            
          $cookies = Yii::$app->response->cookies;
          $cookies->remove($cache_key);
          return $this->redirect(['maintiezhiposter','activity_id'=>$data['activity_id'],'poster_id'=>$ActivityPoster->id,]); 
        } catch (Exception $e) {
            return $this->msgerror("系统错误");
            die;
        }

    }
    /*荣誉贴纸的生成海报预览*/
     public function actionMaintiezhiposter()
    {
       $this->layout = false;
        $request = Yii::$app->request;
         /*活动状态信息*/   
        $activity_status =$this->GetActivityStatus();
       if($activity_status['code'])return $this->msgerror($activity_status['msg']);
        $poster_id = Yii::$app->request->get('poster_id');
        $poster = ActivityPoster::findOne($poster_id);
       
        $model = $this->findModel($request->get('activity_id'));
         return $this->render('maintiezhiposter',[
                'poster'=>$poster,
                'poster_id'=>$poster_id,
                'model'=>$model
             ]); 
    }

    /*保存图片*/
    public function actionSaveimg()
    {
      $poster_id = Yii::$app->request->post('poster_id');
      $poster = ActivityPoster::findOne($poster_id);
      $weburl = Yii::$app->params['basic']['url'];
      $base64_string = Yii::$app->request->post('img');
      $url = '/upload/saveimg/'.time().rand(1000,9999).".png";
      $base64_string= explode(',', $base64_string); //截取data:image/png;base64, 这个逗号后的字符
      $data= base64_decode($base64_string[1]);//对截取后的字符使用base64_decode进行解码
      //file_put_contents('./'.$url, $data); //写入文件并保存
      $newFile = fopen("./".$url,"w+"); //打开文件准备写入
      fwrite($newFile,$data); //写入二进制流到文件
      fclose($newFile); //关闭文件
      Yii::$app->response->format=Response::FORMAT_JSON;
      if ( $file_content = file_get_contents("./".$url) ) {
        //  能打开
        if($poster->poster_image)ActivityPoster::Deletesaveimg($poster->poster_image);
        $poster->poster_image = $url;
        $poster->save(false);
          return ['code'=>'0','message'=>$url];
        } else {
        // 不能打开
         return ['code'=>'1','message'=>$url];
        }
      
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
