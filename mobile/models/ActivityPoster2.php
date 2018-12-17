<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%activity_poster_2}}".
 *
 * @property int $id
 * @property int $poster_id
 * @property string $name 创说会名称
 * @property string $start_time 创说会时间
 * @property string $address 创说会地址
 * @property string $lecturer 讲师名称
 * @property string $brief 讲师简介
 * @property string $addtime 添加时间
 */
class ActivityPoster2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activity_poster_2}}';
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
            [['lecturer'], 'string', 'max' => 20],
            [['brief'], 'string', 'max' => 200],
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
            'name' => '创说会名称',
            'start_time' => '创说会时间',
            'address' => '创说会地址',
            'lecturer' => '讲师名称',
            'brief' => '讲师简介',
            'addtime' => '添加时间',
        ];
    }
}
