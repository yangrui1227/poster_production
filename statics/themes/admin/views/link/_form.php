<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Link */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="link-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'site_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort_order')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'attach_file')->fileInput(['maxlength' => true]) ?>
    <?php if($model->attach_file){?>
    <img src="<?=$model->attach_file?>"  width="50" height="50" />
    <?php }?>

    <?= $form->field($model, 'status_is')->dropDownList([ 'Y' => '是', 'N' => '否', ], ['prompt' => '']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
