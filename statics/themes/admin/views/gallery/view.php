<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = $model->title;
$this->params['breadcrumbs'][]="扩展管理";
$this->params['breadcrumbs'][] = ['label' => '图集', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .view-img{ margin-right: 10px; }
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

<div class="gallery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'thumb',
                'format' => 'raw',
                'value' => function($data) {
                    return '<img src="/'.$data->thumb.'" width="100" height="100" style="display:block;" class="view-img"/>';
                },             
            ],
            
            'describe',
            'content:ntext',
            [
                'attribute' => '图集',
                'format' => 'raw',
                'value' => function($data) {
                   $modelitem = $data->getgalleryitem();
                   foreach ($modelitem as $key => $value) {
                     $img .=  '<img src="'.$value["files"].'" width="100" height="100" class="view-img" />';

                   }
                    return $img;
                },
            ],
            'addtime',
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