<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Activities;
use backend\models\Category;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ActivityPosterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '海报制作管理';
$this->params['breadcrumbs'][] ="内容管理";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-poster-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filter'=>''
            ],
            [
                'attribute' => 'activity_id',
                'format' => 'raw',
                'value' => function($data) {
                    return Activities::getname($data->activity_id);
                },
                'filter'=>''
            ],
             [
                'attribute' => 'category_id',
                'format' => 'raw',
                'value' => function($data) {
                    return Category::getCategoryname($data->category_id);
                },
                'filter'=>''
            ],
            'name',
            'phone',
            'worknumber',
            //'wechat',
             [
                'attribute' => 'addtime',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->addtime;
                },
                'filter'=>''
            ],
            //'poster_image',

          ['class' => 'yii\grid\ActionColumn','header'=>'操作','template' => ' {view} {delete}',],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
