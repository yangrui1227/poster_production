<?php

namespace common\models;

use Yii;
use common\libs\Tree;
/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id ID
 * @property string $name 栏目名称
 * @property int $pid 父级
 * @property int $display 栏目显示
 * @property string $seo_title SEO栏目标题
 * @property string $seo_keywords SEO栏目关键字
 * @property string $seo_description SEO栏目描述
 * @property string $images 栏目图片
 * @property int $sort 排序
 * @property string $addtime 添加时间
 */
class Category extends \yii\db\ActiveRecord
{

    const DISPLAY = 1;
    const HIDE = 0;

    public static $displays = [
        self::DISPLAY => '显示',
        self::HIDE => '隐藏',
    ];

    public static $displayStyles = [
        self::HIDE => 'label-warning',
        self::DISPLAY => 'label-info',
    ];

    public function __construct() {
        $this->display = self::DISPLAY;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['pid', 'name','sort'], 'required'],
            [['pid', 'display', 'sort'], 'integer'],
            [['addtime','updatetime'], 'safe'],
            [['name'], 'string', 'max' => 20],
            [['seo_title', 'seo_keywords', 'seo_description', 'images'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '栏目名称',
            'pid' => '父级',
            'display' => '栏目显示',
            'seo_title' => 'SEO栏目标题',
            'seo_keywords' => 'SEO栏目关键字',
            'seo_description' => 'SEO栏目描述',
            'images' => '栏目图片',
            'sort' => '排序',
            'addtime' => '添加时间',
            'updatetime' => '更新时间',
        ];
    }

    public function getDisplays() {
        return self::$displays;
    }

    /**
     * 获取菜单状态
     */
    public static function getDisplayText($display) {
        return self::$displays[$display];
    }

    /**
     * 获取菜单状态样式
     */
    public static function getDisplayStyle($display) {
        return self::$displayStyles[$display];
    }

    public static function getCategory() {
        $menus = static::find()->where(['display' => 1])->asArray()->all();
       // print_r($menus);
        $treeObj = new Tree($menus);
        return $treeObj->getTreeArray();
    }
}
