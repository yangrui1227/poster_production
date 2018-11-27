<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ArticlesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'title_second') ?>

    <?= $form->field($model, 'title_alias') ?>

    <?= $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'template') ?>

    <?php // echo $form->field($model, 'catalog_id') ?>

    <?php // echo $form->field($model, 'intro') ?>

    <?php // echo $form->field($model, 'seo_title') ?>

    <?php // echo $form->field($model, 'seo_description') ?>

    <?php // echo $form->field($model, 'seo_keywords') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'copy_from') ?>

    <?php // echo $form->field($model, 'copy_url') ?>

    <?php // echo $form->field($model, 'redirect_url') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'view_count') ?>

    <?php // echo $form->field($model, 'commend') ?>

    <?php // echo $form->field($model, 'top_line') ?>

    <?php // echo $form->field($model, 'last_update_time') ?>

    <?php // echo $form->field($model, 'sort_desc') ?>

    <?php // echo $form->field($model, 'status_is') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
