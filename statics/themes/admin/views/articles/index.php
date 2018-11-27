<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Category;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            //'title_second',
            //'title_alias',
            //'author',
            //'template',
            //'catalog_id',
            //'intro:ntext',
            //'seo_title',
            //'seo_description:ntext',
            //'seo_keywords',
            //'content:ntext',
            //'copy_from',
            //'copy_url:url',
            //'redirect_url:url',
            //'tags',
            //'view_count',
            //'commend',
            //'top_line',
            //'last_update_time',
            [
                'attribute' => 'catalog_id',
                'format' => 'raw',
                'value' => function($data) {
                    return Category::getCategoryname($data->catalog_id);
                },
                //在搜索条件（过滤条件）中使用下拉框来搜索
                'filter' => [$treeArr],
                
            ],
            [
                'attribute' => 'status_is',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data->status_is=='Y') ?'显示':'隐藏';
                },
                //在搜索条件（过滤条件）中使用下拉框来搜索
                'filter' => ['Y'=>'显示','N'=>'隐藏'],
                
            ],
            [
                'attribute'=>'sort_desc',
                
                'filter'=>''

            ],
            [
                'attribute'=>'create_time',
                'value'=>function($data){
                    return date('Y-m-d H:i:s',$data->create_time);
                },
                'filter'=>''

            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
