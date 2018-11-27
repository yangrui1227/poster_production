<?php

namespace backend\models;

use Yii;
use common\libs\Tree;
use yii\web\User;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $name 名称
 * @property int $pid 上级id
 * @property int $display 0隐藏1显示
 * @property int $sort 排序
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
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['display'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '名称'),
            'pid' => Yii::t('app', '上级id'),
            'display' => Yii::t('app', '0隐藏1显示'),
            'sort' => Yii::t('app', '排序'),
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

    public static function getCategoryname($id){
        $result = static::findOne($id);
        return $result->name;
    }
}
