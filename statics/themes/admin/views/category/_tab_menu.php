<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '栏目管理',
            'url' => ['category/index'],
        ],
        [
            'label' => '添加栏目',
            'url' => ['category/create'],
            'visible' => Yii::$app->user->can('category/create')
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);