<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%gallery}}".
 *
 * @property int $id ID
 * @property string $title 标题
 * @property string $thumb 封面图
 * @property string $describe 简介
 * @property string $content 内容
 * @property string $addtime 添加时间
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%gallery}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'thumb','content'], 'required'],
            [['content'], 'string'],
            [['addtime'], 'safe'],
            [['title', 'describe'], 'string', 'max' => 100],
            [['thumb'], 'string', 'max' => 80],
            [['title'], 'unique'],
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
            'thumb' => '封面图',
            'describe' => '简介',
            'content' => '内容',
            'addtime' => '添加时间',
        ];
    }

    public   function getgalleryitem()
    { 
      return $this->hasMany(GalleryItem::className(), ['item' => 'id'])->asArray()->all();    
    }
    
}
