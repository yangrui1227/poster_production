<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_second')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marking')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intro')->textarea(['rows' => 6]) ?>

 <?= $form->field($model,'content')->widget('common\widgets\ueditor\Ueditor',['options'=>['initialFrameHeight' => 300,]]); ?>
    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    

    <?= $form->field($model, 'status_is')->dropDownList([ 'Y' => '是', 'N' => '否', ], ['prompt' => '']) ?>

    

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
