<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%activity_poster_3}}".
 *
 * @property int $id
 * @property int $poster_id
 * @property string $brief 简介
 * @property string $addtime 添加时间
 * @property string $uname 姓名
 */
class ActivityPoster3 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activity_poster_3}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['poster_id'], 'integer'],
            [['addtime'], 'safe'],
            [['brief'], 'string', 'max' => 200],
            [['uname'], 'string', 'max' => 100],
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
            'brief' => '简介',
            'addtime' => '添加时间',
            'uname' => '姓名',
        ];
    }
}
