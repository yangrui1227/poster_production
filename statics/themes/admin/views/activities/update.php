<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Activities */

$this->title = '编辑: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '活动管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '编辑';

?>
<div class="activities-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
