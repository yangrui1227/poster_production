<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Backgroundimage;
/* @var $this yii\web\View */
/* @var $model common\models\Backgroundimage */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .view-img{ margin-right: 10px; cursor: pointer; }
    .show-img{ max-width: 800px; max-height: 800px; }
</style>
<?php 
$this->registerJs("
        $('.modal').on('hidden.bs.modal', function() { 
        $(this).removeData('bs.modal'); 
        });

    // 对象绑定点击事件
    $('.view-img').on('click',function (event) {
        var imgurl = $(this).attr('src');
        var img = '<img src='+ imgurl +' class=show-img />';
        $('.modal-content').html(img);
           $('.modal').modal({
           'show':true,        
           });
        });"
    , 3);
?>
<div class="bckgroundimage-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'site_name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'sort_order')->textInput(['maxlength' => true])->hint("数值越小越靠前") ?>


    <?= $form->field($model, 'attach_file')->fileInput(['maxlength' => true])->hint("点击小图放大") ?>
    <?php if($model->attach_file){?>
    <img src="<?=$model->attach_file?>" class="view-img"  width="50" height="50" />
    <?php }?>

    <?= $form->field($model, 'attach_size')->dropDownList(Backgroundimage::$statussizeTexts) ?>

    <?= $form->field($model, 'status_is')->dropDownList(Backgroundimage::$statusTexts) ?>


    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!-- 弹出框 -->
<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">

        </div>
    </div>
</div>