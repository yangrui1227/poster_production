<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%articles}}".
 *
 * @property string $id
 * @property string $title 标题
 * @property string $title_second 副标题
 * @property string $title_alias 别名 
 * @property string $images 图片 
 * @property string $author 作者
 * @property string $template 模板
 * @property int $catalog_id 分类
 * @property string $intro 摘要
 * @property string $seo_title SEO标题
 * @property string $seo_description SEO描述
 * @property string $seo_keywords SEO关键字
 * @property string $content 内容
 * @property string $copy_from 来源
 * @property string $copy_url 来源url
 * @property string $redirect_url 跳转URL
 * @property string $tags tags
 * @property string $view_count 查看次数
 * @property string $commend 推荐
 * @property string $top_line 头条
 * @property string $last_update_time 最后更新时间
 * @property string $sort_desc 排序
 * @property string $status_is 状态
 * @property string $create_time 录入时间
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%articles}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
            ['catalog_id', 'compare', 'compareValue' => 0, 'operator' => '>'],
            [['title', 'content','catalog_id'], 'required'],
            [['catalog_id', 'view_count', 'last_update_time', 'sort_desc', 'create_time'], 'integer'],
            [['intro', 'seo_description', 'content', 'commend', 'top_line', 'status_is'], 'string'],
            [['title', 'title_second', 'seo_title', 'seo_keywords', 'copy_url', 'redirect_url', 'tags'], 'string', 'max' => 255],
            [['copy_url', 'redirect_url',],'url','message'=>'格式错误'],
            [['title_alias'], 'string', 'max' => 50],
            [['author', 'copy_from','images'], 'string', 'max' => 100],
            [['template'], 'string', 'max' => 60],
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
            'title_second' => '副标题',
            'title_alias' => '别名 ',
            'images' => '图片 ',
            'author' => '作者',
            'template' => '模板',
            'catalog_id' => '分类',
            'intro' => '摘要',
            'seo_title' => 'SEO标题',
            'seo_description' => 'SEO描述',
            'seo_keywords' => 'SEO关键字',
            'content' => '内容',
            'copy_from' => '来源',
            'copy_url' => '来源url',
            'redirect_url' => '跳转URL',
            'tags' => '标签',
            'view_count' => '查看次数',
            'commend' => '推荐',
            'top_line' => '头条',
            'last_update_time' => '最后更新时间',
            'sort_desc' => '排序',
            'status_is' => '状态',
            'create_time' => '录入时间',
        ];
    }
}
