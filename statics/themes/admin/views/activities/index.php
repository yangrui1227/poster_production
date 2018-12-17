<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ActivitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '活动管理';
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
                'attribute'=>'qrcode',
                 'format' => 'raw',
                 'value' => function($data) {
                    return '<img src="'.Url::to(["qrcode","id" => $data->id]).'" width="50" height="50" class="view-img"/>';
                  
                },
                'filter'=>''
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
<!-- 弹出框 -->
<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">

        </div>
    </div>
</div>