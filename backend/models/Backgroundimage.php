<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "{{%backgroundimage}}".
 *
 * @property string $id
 * @property string $site_name 名称
 * @property string $sort_order 排序
 * @property string $attach_file 链接图片
 * @property string $status_is 显示状态
 * @property string $create_time 录入时间
 */
class Backgroundimage extends \yii\db\ActiveRecord
{
     public $imageFile;

    const STATUS_DELETED = '0';
    const STATUS_ACTIVE = '1';

    const ATTACH_SIZE_W = '1';
    const ATTACH_SIZE_H = '2';

     public static $statusTexts = [     
        self::STATUS_ACTIVE => '是',
        self::STATUS_DELETED => '否',
    ];

    public static $statussizeTexts = [     
        self::ATTACH_SIZE_W => '4:3',
        self::ATTACH_SIZE_H => '16:9',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%backgroundimage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_name','status_is','attach_size'], 'required'],
            [['sort_order', 'create_time','attach_size'], 'integer'],
            ['status_is', 'default', 'value' => self::STATUS_ACTIVE],
            ['attach_size', 'default', 'value' => self::ATTACH_SIZE_H],
            [['site_name', 'attach_file'], 'string', 'max' => 100],
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
            'sort_order' => '排序',
            'attach_file' => '图片',
            'attach_size'=> '尺寸',
            'status_is' => '显示状态',
            'create_time' => '录入时间',
        ];
    }

    /**
     * 获取状态
     */
    public function getStatus() {
        return self::$statusTexts[$this->status_is];
    }

     public function getsizeStatus() {
        return self::$statussizeTexts[$this->attach_size];
    } 
    /**
     * 获取状态
     */
    public function getStatusTexts() {
        return self::$statusTexts;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status_is' => self::STATUS_ACTIVE]);
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
            $model = new self();
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
 
     public static function findimage($id)
    {
        $result = static::findOne(['id' => $id]);
        if($result){
            return $result->attach_file;
        }
    }
}
