<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>
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
<div class="menu-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'pid')->dropDownList([0 => '一级栏目']+$treeArr, ['encode' => false]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'images')->fileInput(['maxlength' => true]) ?>
    <?php if($model->images){?>
    <img src="<?=$model->images?>" class="view-img" style="cursor: pointer;"  width="50" height="50" />
    <?php }?>
    <?= $form->field($model, 'display')->radioList($model->getDisplays()) ?>

    <?= $form->field($model, 'sort')->textInput()->hint('数值越小排序越前') ?>
    <?= $form->field($model, 'seo_title')->textInput()->hint('为空则使用SEO参数设置中设置的title构成方式') ?>
    <?= $form->field($model, 'seo_keywords')->textInput()->hint('多个关键词请用","隔开') ?>
     <?= $form->field($model, 'seo_description')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
