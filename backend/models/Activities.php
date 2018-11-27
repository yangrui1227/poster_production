<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%activities}}".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $starttime 开始时间
 * @property string $endtime 结束时间
 * @property string $content 活动详情
 * @property int $online 1表示上线，2表示下线
 * @property string $addtime 添加时间
 * @property string $updatetime 编辑时间
 */
class Activities extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 2;
    const STATUS_ACTIVE = 1;

    public static $statusTexts = [
         self::STATUS_ACTIVE => '上线',
        self::STATUS_DELETED => '下线',
       
    ];

    public static $statusStyles = [
        self::STATUS_DELETED => 'label-warning',
        self::STATUS_ACTIVE => 'label-info',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activities}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'starttime', 'endtime', 'content',], 'required'],
            [['starttime', 'endtime', 'addtime', 'updatetime'], 'safe'],
            [['content'], 'string'],
             ['online', 'default', 'value' => self::STATUS_ACTIVE],
            ['online', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['title'], 'string', 'max' => 100],
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
            'starttime' => '开始时间',
            'endtime' => '结束时间',
            'content' => '活动详情',
            'online' => '活动状态',
            'addtime' => '添加时间',
            'updatetime' => '编辑时间',
        ];
    }

     /**
     * 获取状态
     */
    public function getStatus() {
        return self::$statusTexts[$this->online];
    }

    /**
     * 获取状态样式
     */
    public function getStatusStyle() {
        return self::$statusStyles[$this->online];
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
        return static::findOne(['id' => $id, 'online' => self::STATUS_ACTIVE]);
    }

     /**
     * @behaviors
     */
    public function behaviors()
    {
        
        return [
          [
              'class' => TimestampBehavior::className(),
              'createdAtAttribute' => 'addtime',
              'updatedAtAttribute' => 'updatetime',
              'value' => date('Y-m-d H:i:s',time()),
          ],
      ];
    }

}
