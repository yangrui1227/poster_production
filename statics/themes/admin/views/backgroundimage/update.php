<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Link */

$this->title = '更新';
$this->params['breadcrumbs'][] = '栏目管理';
$this->params['breadcrumbs'][] = ['label' => '背景图片', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="link-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
