<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\Link */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-view">

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
            'site_name',
            'site_url:url',
            'sort_order',
            'click_count',
            'link_type',
            //'attach_file',
            [
                'attribute' => 'attach_file',
                'format' => 'raw',
                'value' => function($data) {
                    return '<img src="'.$data->attach_file.'" width="300" />';
                }
            ],
            [
                'attribute' => 'status_is',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data->status_is=='Y') ?'是':'否';
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
