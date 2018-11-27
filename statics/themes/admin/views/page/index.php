<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '单页管理';
$this->params['breadcrumbs'][] = '栏目管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            //'title_second',
            //'title_alias',
            'marking',
            //'intro:ntext',
            //'content:ntext',
            //'seo_title',
            //'seo_keywords',
            //'seo_description:ntext',
            
            
            
            [
                'attribute' => 'status_is',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data->status_is=='Y') ?'是':'否';
                },
                //在搜索条件（过滤条件）中使用下拉框来搜索
                'filter' => ['Y'=>'是','N'=>'否'],
                
            ],
            [
                'attribute'=>'sort_order',
                'filter'=>'',
            ],
            [
                'attribute'=>'view_count',
                'filter'=>'',
            ],
            [
                'attribute' => 'create_time',
                'format' => 'raw',
                'value' => function($data) {
                    return date('Y-m-d H:i:s',$data->create_time);
                },
                'filter'=>'',
            ],

            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
        ],
    ]); ?>
</div>
