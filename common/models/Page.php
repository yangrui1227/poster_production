<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property string $id
 * @property string $title 标题
 * @property string $title_second 副标题
 * @property string $title_alias 标签
 * @property string $marking 唯一标识
 * @property string $intro 简单描述
 * @property string $content 内容
 * @property string $seo_title SEO标题
 * @property string $seo_keywords SEO KEYWORDS
 * @property string $seo_description SEO DESCRIPTION
 * @property int $sort_order 排序
 * @property string $view_count 查看次数
 * @property string $status_is 状态
 * @property string $create_time 时间
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'title_alias', 'marking', 'content'], 'required'],
            [['intro', 'content', 'seo_description', 'status_is'], 'string'],
            [['view_count', 'create_time'], 'integer'],
            [['title', 'title_second'], 'string', 'max' => 100],
            [['title_alias', 'marking'], 'string', 'max' => 40],
            [['seo_title', 'seo_keywords'], 'string', 'max' => 255],
            [['sort_order'], 'string', 'max' => 3],
            [['marking'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'title_second' => '副标题',
            'title_alias' => '标签',
            'marking' => '唯一标识',
            'intro' => '简单描述',
            'content' => '内容',
            'seo_title' => 'SEO标题',
            'seo_keywords' => 'SEO 关键字',
            'seo_description' => 'SEO 描述',
            'sort_order' => '排序',
            'view_count' => '查看次数',
            'status_is' => '状态',
            'create_time' => '时间',
        ];
    }
}
