<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm  extends Model
{
     public $images;
    
     public function rules()
    {
        return [
            [['images'], 'file','skipOnEmpty'=>false,'extensions'=>'png,jpg,jpeg,gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'images' => '图片',

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
     @imgname 上传字段名
     */
    public  function uploadPic($dirname)
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
         
            $model = new UploadForm();
            
            if ($this->images) {
                $back = $this->images->saveAs($path .$file_name.  '.' . $this->images->extension);
                if($back)
                    $file_img = $path .$file_name. '.' . $this->images->extension;
            }
        }
        return $file_img;
    }
 
    
}
