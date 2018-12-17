<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%activity_poster}}".
 *
 * @property int $id ID
 * @property int $activity_id 所属活动
 * @property int $category_id 海报类型
 * @property int $category_size 海报尺寸 （4:3 16:9）
 * @property int $background_id 系统海报背景图
 * @property string $background_image 作者海报背景图
 * @property string $activity_image 活动主图
 * @property string $name 代理人
 * @property string $worknumber 工号
 * @property string $phone 手机号
 * @property string $wechat 微信号
 * @property string $addtime 添加时间
 * @property int $status 状态
 * @property string $poster_image 海报生成图片
 *
 * @property ActivityPoster1[] $activityPoster1s
 */
class ActivityPoster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activity_poster}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id', 'category_id', 'category_size', 'background_id', 'status'], 'integer'],
            [['addtime'], 'safe'],
            [['background_image'], 'string', 'max' => 200],
            [['activity_image', 'poster_image'], 'string', 'max' => 255],
            [['name', 'worknumber', 'wechat'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => '所属活动',
            'category_id' => '海报类型',
            'category_size' => '海报尺寸 （4:3 16:9）',
            'background_id' => '系统海报背景图',
            'background_image' => '作者海报背景图',
            'activity_image' => '活动主图',
            'name' => '代理人',
            'worknumber' => '工号',
            'phone' => '手机号',
            'wechat' => '微信号',
            'addtime' => '添加时间',
            'status' => '状态',
            'poster_image' => '海报生成图片',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id,]);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityPoster1s()
    {
        return $this->hasMany(ActivityPoster1::className(), ['poster_id' => 'id']);
    }
}
