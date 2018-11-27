<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ActivitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '活动管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activities-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
             [
                'attribute'=>'starttime',
                'filter'=>''
            ],
             [
                'attribute'=>'endtime',
                'filter'=>''
            ],
            [
                'attribute' => 'online',
                'format' => 'raw',
                'value' => function($data) {
                   return Html::tag('span', $data->getStatus(), ['class' => 'label label-sm '.$data->getStatusStyle()]);
                },
                //在搜索条件（过滤条件）中使用下拉框来搜索
                'filter' =>  \backend\models\Activities::$statusTexts,
                
            ],
             [
                'attribute'=>'addtime',
                'filter'=>''
            ],

            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
