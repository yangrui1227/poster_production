<?php

namespace mobile\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%upload_files}}".
 *
 * @property string $id
 * @property string $save_path 保存路径
 * @property string $save_name 保存文件名不带路径
 * @property string $create_time 上传时间
 */
class UploadFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%upload_files}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time'], 'integer'],
            [['save_path', 'save_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'save_path' => '保存路径',
            'save_name' => '保存文件名不带路径',
            'create_time' => '上传时间',
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
            $model = new self();
            $model->save_path = UploadedFile::getInstance($model, 'save_path');
    //print_r($model->attach_file);die;
            if ($model->save_path) {
                $back = $model->save_path->saveAs($path .$file_name.  '.' . $model->save_path->extension);
                if($back)
                    $file_img = $path .$file_name. '.' . $model->save_path->extension;
            }
        }
        return $file_img;
    }

     public static function findimage($id)
    {
        $result = static::findOne(['id' => $id]);
        if($result){
            return $result->save_path;
        }
    }

}
