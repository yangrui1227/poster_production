<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
         <?= Html::a('返回', ['index', ], ['class' => 'btn btn-success']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::tag('span', $data->getStatus(), ['class' => 'label label-sm '.$data->getStatusStyle()]);
                }
            ],
            [
                'attribute'=>'created_at',
                'format' => 'raw',
                'value' => function ($data) {
                    return date('Y-m-d H:i:s',$data->created_at);
                }
            ],
            [
                'attribute'=>'updated_at',
                'format' => 'raw',
                'value' => function ($data) {
                     return date('Y-m-d H:i:s',$data->updated_at);
                }
            ],
            
        ],
    ]) ?>

</div>
