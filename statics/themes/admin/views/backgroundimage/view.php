<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\Link */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '背景图片', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .view-img{ margin-right: 10px; cursor: pointer; }
    .show-img{ max-width: 800px; max-height: 800px; }
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
<div class="link-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
         <?= Html::a('返回', ['index', ], ['class' => 'btn btn-success']) ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'site_name',
            'sort_order',
            //'attach_file',
            [
                'attribute' => 'attach_file',
                'format' => 'raw',
                'value' => function($data) {
                    return '<img src="'.$data->attach_file.'" width="300" class="view-img" />';
                }
            ],
            
             [
                'attribute' => 'attach_size',
                'format' => 'raw',
                 'value' => function($data) {
                    return $data->getsizeStatus();
                },
            ],
            [
                'attribute' => 'status_is',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data->status_is=='1') ?'是':'否';
                }
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
<!-- 弹出框 -->
<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">

        </div>
    </div>
</div>