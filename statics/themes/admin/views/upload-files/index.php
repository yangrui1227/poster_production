<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UploadFilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '附件管理';
$this->params['breadcrumbs'][]="扩展管理";
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
<div class="upload-files-index">

    <h1><?= Html::encode($this->title) ?></h1>

 <?php Pjax::begin(); ?>
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
                'attribute' => 'save_path',
                'format' => 'raw',
                'value' => function($data) {
                    return '<img src="'.$data->save_path.'" width="50" height="50" class="view-img"/>';
                },
                //在搜索条件（过滤条件）中使用下拉框来搜索
                'filter' =>'',
                
            ],
            [
                'attribute' => 'create_time',
                'format' => 'raw',
                'value' => function($data) {
                    return date('Y-m-d H:i:s',$data->create_time);
                },
                'filter'=>''
            ],
            

            ['class' => 'yii\grid\ActionColumn','header'=>'操作','template' => '{delete}',],
        ],
    ]); ?>
     <?php Pjax::end(); ?>
</div>
<!-- 弹出框 -->
<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">

        </div>
    </div>
</div>