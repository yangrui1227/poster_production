<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Activities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'starttime')->widget(
        DatePicker::className(), [
        'pluginOptions' => [ 
        'autoclose' => true, 
        'format' => 'yyyy-mm-dd', 
        'todayHighlight' => true, 
        'todayBtn'=>false,
    ] 
    ]);?>
    <?= $form->field($model, 'endtime')->widget(
        DatePicker::className(), [
        'pluginOptions' => [ 
        'autoclose' => true, 
        'format' => 'yyyy-mm-dd', 
        'todayHighlight' => true, 
        'todayBtn'=>false,
    ] 
    ]);?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'online')->radioList($model->getStatusTexts()) ?>

   

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
