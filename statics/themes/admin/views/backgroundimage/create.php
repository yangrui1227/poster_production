<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Link */
$this->title = "添加";
$this->params['breadcrumbs'][] = '栏目管理';
$this->params['breadcrumbs'][] = ['label' => '背景图片', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
