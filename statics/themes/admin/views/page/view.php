<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] ="栏目管理";
$this->params['breadcrumbs'][] = ['label' => '单页管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('返回', ['index'], [
            'class' => 'btn btn-danger',
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'title_second',
            'title_alias',
            'marking',
            'intro:ntext',
            'content:ntext',
            'seo_title',
            'seo_keywords',
            'seo_description:ntext',
            'sort_order',
            'view_count',
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
                'attribute' => 'create_time',
                'format' => 'raw',
                'value' => function($data) {
                    return date('Y-m-d H:i:s',$data->create_time);
                }
            ],
        ],
    ]) ?>

</div>
