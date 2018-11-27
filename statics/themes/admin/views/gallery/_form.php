<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'thumb')->widget('manks\FileInput', [
    ]); ?>

    <?= $form->field($model, 'describe')->textarea(['maxlength' => true,'rows' => 6]) ?>

     <?= $form->field($model,'content')->widget('common\widgets\ueditor\Ueditor',['options'=>['initialFrameHeight' => 200,]]); ?>

   
    <?= $form->field($modelitem, 'files')->widget('manks\FileInput', [
                //多个图片上传需添加以下参数
                'clientOptions' => [
                    'pick' => [
                        'multiple' => true,
                    ],
                ],
        ]); ?>

       <?php if($modelitem_value){?>
        <div class="form-group">
        <?php foreach($modelitem_value as $value){?>
            <div style=" width: 200px; height: 200px; margin:10px; float: left;">
            <img src="<?=$value['files']?>" width="200" height="200"/>
           
           </div> 
        <?php }?> 
        
        </div>
        <div style="clear: both;"></div>
       <?php }?> 
        
    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
