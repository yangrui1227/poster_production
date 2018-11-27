<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%gallery_item}}".
 *
 * @property string $id
 * @property string $item 图集
 * @property string $introduce 描述
 * @property string $thumb 图片
 * @property int $listorder 排序
 */
class GalleryItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%gallery_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item', 'listorder'], 'integer'],
            //[['introduce'], 'required'],
            [['introduce'], 'string'],
            [['files'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item' => '图集',
            'introduce' => '描述',
            'files' => '图片',
            'listorder' => '排序',
        ];
    }

    public static function getGalleryItem($id){
        $result =  self::find()->where(['item' => $id])->asArray()->orderby('listorder asc')->all();
        return $result;
    }

    public static function GalleryItemSave($id)
    {     
        $data= Yii::$app->request->post();
        //print_r($gallery = $data['GalleryItem']['files']);die;
        if($data['GalleryItem']['files']&& is_array($gallery = $data['GalleryItem']['files'])){                   
                foreach ($gallery  as $key => $value){
                   $modelitem = new self;
                   $modelitem->item = $id;
                   $modelitem->files = $value;
                   $modelitem->save();
                }
            return  true;   
        }
        return false;

    }

    public function getgallery()
    { 
     return $this->hasOne(Gallery::className(), ['id'=>'item']);
    }

}
