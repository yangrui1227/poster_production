<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '日志设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('返回', ['index'], [
            'class' => 'btn btn-primary',
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'type',
                'value' => function ($data) {
                    return $data->getTypeDescription($data->type);
                }
            ],
            'controller',
            'action',
            'url',
            'index',
            'params',
            'created_ip',
           [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return date('Y-m-d H:i:s',$data->created_at);
                }
            ],
        ],
    ]) ?>

</div>
