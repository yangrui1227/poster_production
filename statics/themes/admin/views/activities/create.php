<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Activities */

$this->title = "添加";
$this->params['breadcrumbs'][] = '内容管理';
$this->params['breadcrumbs'][] = ['label' => '活动管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activities-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
