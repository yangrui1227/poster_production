<?php

namespace mobile\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
/**
 * This is the model class for table "{{%activities}}".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $starttime 开始时间
 * @property string $endtime 结束时间
 * @property string $content 活动详情
 * @property int $online 1表示上线，2表示下线
 * @property string $addtime 添加时间
 * @property string $updatetime 编辑时间
 */
class Activities extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 2;
    const STATUS_ACTIVE = 1;

    public static $statusTexts = [
         self::STATUS_ACTIVE => '上线',
        self::STATUS_DELETED => '下线',
       
    ];

    /*背景图模板*/
    public static $TEMPLATE_BACKGROUND = [
        '1'=>'backgroundimg',//主拓活动背景图模板
        '2'=>'backgroundimg',//创说会模板
        '3'=>'backgroundimg3'//个人荣誉模板
    ];

    /*背景图下一步跳转的模板*/
    public static $TEMPLATE_FORM=[
        '1'=>'postermainimg',//主拓活动背景图模板
        '2'=>'posterchuangshuoform',//创说会模板
        '3'=>'makerongyulink'//个人荣誉模板
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activities}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'starttime', 'endtime', 'content',], 'required'],
            [['starttime', 'endtime', 'addtime', 'updatetime'], 'safe'],
            [['content'], 'string'],
             ['online', 'default', 'value' => self::STATUS_ACTIVE],
            ['online', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'starttime' => '开始时间',
            'endtime' => '结束时间',
            'content' => '活动详情',
            'online' => '活动状态',
            'addtime' => '添加时间',
            'updatetime' => '编辑时间',
        ];
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'online' => self::STATUS_ACTIVE]);
    }

    /*
    *生成活动的链接
    *$activity_id 活动id
    $category_id 海报类型id
    $size_id 海报尺寸
    $background_id 系统背景图
    $new_background_id 用户上传背景图
    $activity_image 活动主图
    */
    public static function send_url($activity_id,$category_id,$size_id,$background_id,$new_background_id,$activity_image){

            $params = array('activity_id'=>$activity_id,'category_id'=>$category_id,'size_id'=>$size_id, 'background_id'=>$background_id,'new_background_id' => $new_background_id,'activity_image'=>$activity_image);
            $params = base64_encode(json_encode($params));
            $url =  Yii::$app->params['basic']['url'].Url::to(['mainextensionfrom','activity_id'=>$activity_id,'method'=>$params]);


        return $url;
    }

    /*
    *创说会生成活动的链接
    *$activity_id 活动id
    $category_id 海报类型id
    $size_id 海报尺寸
    $background_id 系统背景图
    $new_background_id 用户上传背景图
    $activity_image 活动主图
    $name 名称
    $start_time 时间
    $address 地址
    $lecturer讲师
    $brief 简介
    */
    public static function send_chuangshuo_url($activity_id,$category_id,$size_id,$background_id,$new_background_id,$activity_image,$name,$start_time,$address,$lecturer,$brief){
       
            $params = array('activity_id'=>$activity_id,'category_id'=>$category_id,'size_id'=>$size_id, 'background_id'=>$background_id,'new_background_id' => $new_background_id,'activity_image'=>$activity_image,'name'=>$name,'start_time'=>$start_time,'address'=>$address,'lecturer'=>$lecturer,'brief'=>$brief);
            $params = base64_encode(json_encode($params));
            $url =  Yii::$app->params['basic']['url'].Url::to(['chuangshuoform','activity_id'=>$activity_id,'method'=>$params]);
        return $url;
    }

    /*
    *个人荣誉生成活动的链接
    *$activity_id 活动id
    $category_id 海报类型id
    $size_id 海报尺寸
    $background_id 系统背景图
    $new_background_id 用户上传背景图
    $activity_image 活动主图
    */
    public static function send_rongyu_url($activity_id,$category_id,$size_id,$background_id,$new_background_id){
            $params = array('activity_id'=>$activity_id,'category_id'=>$category_id,'size_id'=>$size_id, 'background_id'=>$background_id,'new_background_id' => $new_background_id);
            $params = base64_encode(json_encode($params));
            $url =  Yii::$app->params['basic']['url'].Url::to(['mainrongyufrom','activity_id'=>$activity_id,'method'=>$params]);

        return $url;
    }

    /*
    *荣誉贴纸生成活动的链接
    *$activity_id 活动id
    $category_id 海报类型id
    $activity_image 浮层图片
    */
    public static function send_tiezhi_url($activity_id,$category_id,$activity_image){
            $params = array('activity_id'=>$activity_id,'category_id'=>$category_id,'activity_image'=>$activity_image);
            $params = base64_encode(json_encode($params));
            $url =  Yii::$app->params['basic']['url'].Url::to(['maintiezhibg','activity_id'=>$activity_id,'method'=>$params]);

        return $url;
    }

}
