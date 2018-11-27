<?php
use yii\bootstrap\Nav;
use yii\web\User;
echo Nav::widget([
    'items' => [
        [
            'label' => '角色管理',
            'url' => ['role/index'],
            'visible' => Yii::$app->user->can('role/index')
        ],
        [
            'label' => '添加角色',
            'url' => ['role/create'],
            'visible' => Yii::$app->user->can('role/create')
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);