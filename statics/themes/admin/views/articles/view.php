<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Category;
/* @var $this yii\web\View */
/* @var $model common\models\Articles */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'title_second',
            'title_alias',
            'author',
            'template',
            [
                'attribute' => 'catalog_id',
                'format' => 'raw',
                'value' => function($data) {
                    return Category::getCategoryname($data->catalog_id);
                },
                
            ],
            'intro:ntext',
            'seo_title',
            'seo_description:ntext',
            'seo_keywords',
            'content:ntext',
            'copy_from',
            'copy_url:url',
            'redirect_url:url',
            'tags',
            'view_count',
            [
                'attribute' => 'commend',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data->status_is=='Y') ?'是':'否';
                },    
            ],
            [
                'attribute' => 'top_line',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data->status_is=='Y') ?'是':'否';
                },    
            ],
            [
                'attribute'=>'last_update_time',
                'value'=>function($data){
                    return date('Y-m-d H:i:s',$data->create_time);
                },

            ],
            'sort_desc',
            [
                'attribute' => 'status_is',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data->status_is=='Y') ?'显示':'隐藏';
                },    
            ],

            [
                'attribute'=>'create_time',
                'value'=>function($data){
                    return date('Y-m-d H:i:s',$data->create_time);
                },

            ],
        ],
    ]) ?>

</div>
