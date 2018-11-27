<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '基本配置',
            'url' => ['config/basic'],
            'visible' => Yii::$app->user->can('config/basic')
        ],
        [
            'label' => '邮箱配置',
            'url' => ['config/send-mail'],
            'visible' => Yii::$app->user->can('config/send-mail')
        ],
        [
            'label' => '附件配置',
            'url' => ['config/attachment'],
            'visible' => Yii::$app->user->can('config/attachment')
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);