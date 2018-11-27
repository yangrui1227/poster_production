<?php

namespace backend\models;

use Yii;
use yii\db\Expression;
use yii\helpers\Json;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%admin_log}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $controller
 * @property string $action
 * @property string $index
 * @property string $url
 * @property string $params
 * @property integer $created_id
 * @property integer $created_at
 */
class AdminLog extends ActiveRecord
{
    /**
     * 类型
     */
    const TYPE_CREATE = 1; // 创建
    const TYPE_UPDATE = 2; // 修改
    const TYPE_DELETE = 3; // 删除
    const TYPE_OTHER = 4;  // 其他
    const TYPE_UPLOAD = 5;  // 上传

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'created_id','created_at'], 'integer'],
            [['params'], 'string'],
            [['controller', 'action'], 'string', 'max' => 64],
            [['url', 'index','created_ip'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '日志ID',
            'type' => '类型',
            'controller' => '操作控制器',
            'action' => '操作方法',
            'index' => '数据唯一标识',
            'url' => '操作的URL',
            'params' => '请求参数',
            'created_id' => '创建管理员ID',
            'created_at' => '创建时间',
            'created_ip'=>'创建管理员IP'
        ];
    }

    /**
     * 获取类型说明
     * @param null $type
     * @return array|mixed|null
     */
    public static function getTypeDescription($type = null)
    {
        $mixReturn = [
            self::TYPE_CREATE => '创建',
            self::TYPE_CREATE => '创建',
            self::TYPE_UPDATE => '修改',
            self::TYPE_DELETE => '删除',
            self::TYPE_OTHER => '其他',
            self::TYPE_UPLOAD => '上传',
        ];

        if ($type !== null) {
            $mixReturn = isset($mixReturn[$type]) ? $mixReturn[$type] : null;
        }

        return $mixReturn;
    }

   

    /**
     * 修改操作.
     * @param obj $event
     * @return mixed
     */
    public static function afterUpdate($event)
    { 
        if(!empty($event->changedAttributes)) { 
            // 内容
            $arr['changedAttributes'] = $event->changedAttributes;
            $arr['oldAttributes'] = [];
            foreach($event->sender as $key => $value) { 
                $arr['oldAttributes'][$key] = $value; 
            } 
            $description = json_encode($arr);
           
            $log['created_ip']=Yii::$app->request->userIP;
            $log['type'] =self::TYPE_UPDATE;
            $log['params'] = $description;
            $log['controller'] = $event->sender->className();
            $log['action'] = Yii::$app->controller->action->id;
            $log['url'] = Yii::$app->request->url;
            $log['index'] = "id=".$event->sender->id;
            $log['created_id'] = Yii::$app->user->id;
            $log['created_at'] = time();
            //print_r($log);die;
            // 保存
            $data = ['type'=>$log['type'],'controller'=>$log['controller'],'action'=>$log['action'],'url'=>$log['url'],'index'=>$log['index'],'params'=>$log['params'],'created_id'=>$log['created_id'],'created_ip'=>$log['created_ip'],'created_at'=>$log['created_at']]; 
            $model = new self(); 
            $model->setAttributes($data); 
            $model->save(false); 
        } 
    } 

     /**
     * 删除操作.
     * @param obj $event
     * @return mixed
     */
    public static function afterDelete2($event)
    { 
        // 内容
        $arr = [];
        foreach($event->sender as $key => $value) { 
            $arr[$key] = $value; 
        } 
        $description = json_encode($arr);

        $log['created_ip']=Yii::$app->request->userIP;
            $log['type'] =self::TYPE_DELETE;
            $log['params'] = $description;
            $log['controller'] = $event->sender->className();
            $log['action'] = Yii::$app->controller->action->id;
            $log['url'] = Yii::$app->request->url;
            $log['index'] = "id=".$event->sender->id;
            $log['created_id'] = Yii::$app->user->id;
            $log['created_at'] = time();
           // print_r($log);die;
            // 保存
            $data = ['type'=>$log['type'],'controller'=>$log['controller'],'action'=>$log['action'],'url'=>$log['url'],'index'=>$log['index'],'params'=>$log['params'],'created_id'=>$log['created_id'],'created_ip'=>$log['created_ip'],'created_at'=>$log['created_at']]; 
            $model = new self(); 
            $model->setAttributes($data); 
            $model->save(false); 
    } 

    /**
     * 插入操作.
     * @param obj $event
     * @return mixed
     */
    public static function afterInsert($event)
    {
        if($event->sender->tableName() != self::tableName()){
            // 内容
            $arr = [];
            foreach($event->sender as $key => $value) { 
                $arr[$key] = $value; 
            } 
            $description = json_encode($arr);

            $log['created_ip']=Yii::$app->request->userIP;
            $log['type'] =self::TYPE_CREATE;
            $log['params'] = $description;
            $log['controller'] = $event->sender->className();
            $log['action'] = Yii::$app->controller->action->id;
            $log['url'] = Yii::$app->request->url;
            $log['index'] = "id=".$event->sender->id;
            $log['created_id'] = Yii::$app->user->id;
            $log['created_at'] = time();
           // print_r($log);die;
            // 保存
            $data = ['type'=>$log['type'],'controller'=>$log['controller'],'action'=>$log['action'],'url'=>$log['url'],'index'=>$log['index'],'params'=>$log['params'],'created_id'=>$log['created_id'],'created_ip'=>$log['created_ip'],'created_at'=>$log['created_at']]; 
            $model = new self();  
            $model->setAttributes($data); 
            $model->save(false); 
        }
    } 

}
