<?php

namespace backend\models;

use Yii;

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

     public static function findimage($id)
    {
        $result = static::findOne(['id' => $id]);
        if($result){
            return $result->save_path;
        }
    }
    
}
