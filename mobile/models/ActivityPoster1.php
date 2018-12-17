<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%activity_poster_1}}".
 *
 * @property int $id
 * @property int $poster_id
 * @property string $name 活动主题
 * @property string $start_time 活动时间
 * @property string $address 活动地址
 * @property string $price 活动价格
 * @property string $number 活动人数
 * @property string $brief 活动简介
 * @property string $addtime 添加时间
 *
 * @property ActivityPoster $poster
 */
class ActivityPoster1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activity_poster_1}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['poster_id'], 'integer'],
            [['start_time', 'addtime'], 'safe'],
            [['name', 'address'], 'string', 'max' => 50],
            [['price', 'number'], 'string', 'max' => 20],
            [['brief'], 'string', 'max' => 200],
            [['poster_id'], 'exist', 'skipOnError' => true, 'targetClass' => ActivityPoster::className(), 'targetAttribute' => ['poster_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'poster_id' => 'Poster ID',
            'name' => '活动主题',
            'start_time' => '活动时间',
            'address' => '活动地址',
            'price' => '活动价格',
            'number' => '活动人数',
            'brief' => '活动简介',
            'addtime' => '添加时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoster()
    {
        return $this->hasOne(ActivityPoster::className(), ['id' => 'poster_id']);
    }
}
