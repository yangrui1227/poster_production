<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '日志管理';
$this->params['breadcrumbs'][] = ['label' => '日志设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['id' => 'grid'],
        'filterPosition' => GridView::FILTER_POS_FOOTER,
        'layout' => '{items} {pager}',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            /*[
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'id',
            ],*/
            'created_id',
            [
                'attribute' => 'type',
                'value' => function ($data) {
                    return $data->getTypeDescription($data->type);
                }
            ],
            'created_ip',
            'action',
            'url',
            'index',
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return date('Y-m-d H:i:s',$data->created_at);
                }
            ],

            [
                'class' => 'common\grid\ActionColumn',
                'header' => Yii::t('backend', 'Operate'),
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php //echo Html::a('批量删除', "javascript:void(0);", ['class' => 'btn btn-success gridview']);?>
</div>
<?php
$this->registerJs('
    $(".gridview").on("click", function () {
        var keys = $("#grid").yiiGridView("getSelectedRows");
        console.log(keys);
    });
');
?>