<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Activities */

$this->title = $model->title;
$this->params['breadcrumbs'][]="内容管理";
$this->params['breadcrumbs'][] = ['label' => '活动管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activities-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('返回', ['index'], ['class' => 'btn btn-success']) ?>
       
    </p>
<p>扫码转发<img src="<?=\yii\helpers\Url::to(['qrcode','id' => $model->id])?>" /></p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'starttime',
            'endtime',
            'content:ntext',
             [
                'attribute' => 'online',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data->getStatus());
                }
            ],
            'addtime',
            'updatetime',
        ],
    ]) ?>

</div>
