<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Backgroundimage;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = '背景图片';
$this->params['breadcrumbs'][] = '栏目管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
.view-img{ cursor: pointer; }
    .show-img{ max-width: 800px; max-height: 800px; }
}
</style>
<?php 
$this->registerJs("
        $('.modal').on('hidden.bs.modal', function() { 
        $(this).removeData('bs.modal'); 
        });

    // 对象绑定点击事件
    $('.view-img').on('click',function (event) {
        var imgurl = $(this).attr('src');
        var img = '<img src='+ imgurl +' class=show-img />';
        $('.modal-content').html(img);
           $('.modal').modal({
           'show':true,        
           });
        });"
    , 3);
?>
<div class="link-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           /* ['class' => 'yii\grid\SerialColumn'],*/
            [
                'attribute'=>'id',
                'filter'=>''
            ],
            'site_name',
            [
                'attribute' => 'status_is',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getStatus();
                },
                //在搜索条件（过滤条件）中使用下拉框来搜索
                'filter' =>Backgroundimage::$statusTexts,
                
            ],

            [
                'attribute' => 'attach_size',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getsizeStatus();
                },
                //在搜索条件（过滤条件）中使用下拉框来搜索
                'filter' => Backgroundimage::$statussizeTexts,
                
            ],
             [
                'attribute' => 'attach_file',
                'format' => 'raw',
                'value' => function($data) {
                    return '<img src="'.$data->attach_file.'" width="50" height="50" class="view-img"/>';
                },
                //在搜索条件（过滤条件）中使用下拉框来搜索
                'filter' =>'',
                
            ],
            [
                'attribute'=>'sort_order',
                'filter'=>''
            ],
            [
                'attribute' => 'create_time',
                'format' => 'raw',
                'value' => function($data) {
                    return date('Y-m-d H:i:s',$data->create_time);
                },
                'filter'=>''
            ],

            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
        ],
    ]); ?>
</div>
<!-- 弹出框 -->
<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">

        </div>
    </div>
</div>