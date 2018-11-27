<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
$this->params['breadcrumbs'][] ="用户设置";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['id' => 'grid'],
        //'filterPosition' => GridView::FILTER_POS_FOOTER,
        'layout' => '{items} {pager}',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
           [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::tag('span', $data->getStatus(), ['class' => 'label label-sm '.$data->getStatusStyle()]);
                },
                 //在搜索条件（过滤条件）中使用下拉框来搜索
                'filter' =>  \backend\models\User::$statusTexts,
                
            ],
            [
                'attribute'=>'created_at',
                'format' => 'raw',
                'value' => function ($data) {
                    return date('Y-m-d H:i:s',$data->created_at);
                },
                'filter'=>''
            ],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
