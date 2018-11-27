<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "{{%link}}".
 *
 * @property string $id
 * @property string $site_name 名称
 * @property string $site_url 链接地址
 * @property string $sort_order 排序
 * @property string $click_count 点击次数
 * @property string $link_type 链接类型
 * @property string $attach_file 链接图片
 * @property string $status_is 显示状态
 * @property string $create_time 录入时间
 */
class Link extends \yii\db\ActiveRecord
{
     public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%link}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_name', 'site_url', 'status_is','sort_order',], 'required'],
            [['sort_order', 'click_count', 'create_time'], 'integer'],
            [['link_type', 'status_is'], 'string'],
            [['site_name', 'attach_file'], 'string', 'max' => 100],
            [['site_url'], 'string', 'max' => 255],
             [['attach_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_name' => '名称',
            'site_url' => '链接地址',
            'sort_order' => '排序',
            'click_count' => '点击次数',
            'link_type' => '链接类型',
            'attach_file' => '链接图片',
            'status_is' => '显示状态',
            'create_time' => '录入时间',
        ];
    }

    
    /**
     * 递归：生成目录
     */
    public static function createDir($str)
    {
        $arr = explode('/', $str);
        if(!empty($arr))
        {
            $path = '';
            foreach($arr as $k=>$v)
            {
                $path .= $v.'/';
                if (!file_exists($path)) {
                    mkdir($path, 0777);
                    chmod($path, 0777);
                }
            }
        }
    }
    /**
     * 上传图片
     * @return string
     @dir 文件夹名称
     */
    public static function uploadPic($dirname)
    {
        //是否上传图片
        //upload
        $file_img = '';
        $file_name = md5(time());
        $path = 'upload/'.$dirname."/";
        if (!file_exists($path)) {
                self::createDir($path);
        }
        if (Yii::$app->request->isPost) {
            $model = new Link();
            $model->attach_file = UploadedFile::getInstance($model, 'attach_file');
    //print_r($model->attach_file);die;
            if ($model->attach_file) {
                $back = $model->attach_file->saveAs($path .$file_name.  '.' . $model->attach_file->extension);
                if($back)
                    $file_img = $path .$file_name. '.' . $model->attach_file->extension;
            }
        }
        return $file_img;
    }
 
    
}
