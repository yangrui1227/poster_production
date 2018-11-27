<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Articles */

$this->title = '编辑文章: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="articles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'treeArr' => $treeArr,
    ]) ?>

</div>
