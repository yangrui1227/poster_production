<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Activities;
use backend\models\Category;
use backend\models\Backgroundimage;
use backend\models\UploadFiles;

/* @var $this yii\web\View */
/* @var $model backend\models\ActivityPoster */

$this->title = Activities::getname($model->activity_id);
$this->params['breadcrumbs'][] ="内容管理";
$this->params['breadcrumbs'][] = ['label' => '海报制作管理', 'url' => ['index']];
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
<div class="activity-poster-view">
    <p>
      <?= Html::a('返回', ['index', ], ['class' => 'btn btn-success']) ?>  
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            [
                'attribute' => 'category_size',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->category_size=='1' ?"4:3" :"16:9";
                },
                'filter'=>''
            ],
           [
                'attribute' => 'background_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->background_id){
                      return '<img src="'.Backgroundimage::findimage($data->background_id).'" width="50" height="50" class="view-img"/>';  
                    }
                    
                },
                'filter'=>''
            ],
            [
                'attribute' => 'background_image',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->background_image){
                      return '<img src="'.UploadFiles::findimage($data->background_image).'" width="50" height="50" class="view-img"/>';  
                    }
                    
                },
                'filter'=>''
            ],
             [
                'attribute' => 'activity_image',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->activity_image){
                      return '<img src="'.UploadFiles::findimage($data->activity_image).'" width="50" height="50" class="view-img"/>';  
                    }
                    
                },
                'filter'=>''
            ],

            'name',
            'worknumber',
            'phone',
            'wechat',
            
             [
                'attribute' => 'poster_image',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->poster_image){
                      return '<img src=".'.$data->poster_image.'" width="50" height="50" class="view-img"/>';  
                    }
                    
                },
                'filter'=>''
            ],
           
        ],
    ]) ?>
<?php if($model->category_id==1){?>
<?= 
DetailView::widget([
        'model' => $model_params,
        'attributes' => [         
            'name',
            'start_time',
            'address',
            'price',
            'number',
            'brief',
        ],
    ]);

?>
<?php }?>

<?php if($model->category_id==2){?>
<?= 
DetailView::widget([
        'model' => $model_params,
        'attributes' => [         
            'name',
            'start_time',
            'address',
            'lecturer',
            'brief',
        ],
    ]);

?>
<?php }?>
<?php if($model->category_id==3){?>
<?= 
DetailView::widget([
        'model' => $model_params,
        'attributes' => [         
            'uname',
            'brief',
        ],
    ]);

?>
<?php }?>
</div>
<!-- 弹出框 -->
<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">

        </div>
    </div>
</div>