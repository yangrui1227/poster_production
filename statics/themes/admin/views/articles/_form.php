<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">
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
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'catalog_id')->dropDownList([0 => '一级栏目']+$treeArr, ['encode' => false]) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_second')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'images')->fileInput(['maxlength' => true]) ?>
    <?php if($model->images){?>
    <img src="<?=$model->images?>" class="view-img" style="cursor: pointer;"  width="50" height="50" />
    <?php }?>
    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'template')->textInput(['maxlength' => true])->hint('留空则继承系统设置的模板') ?>

    

    <?= $form->field($model, 'intro')->textarea(['rows' => 6]) ?>

    
    <?= $form->field($model, 'copy_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'copy_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'redirect_url')->textInput(['maxlength' => true])->hint('此处若填写，则不显示内容') ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true])->hint('多个标签请用","隔开') ?>

    <?= $form->field($model, 'view_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'commend')->dropDownList([ 'N' => '否', 'Y' => '是', ]) ?>

    <?= $form->field($model, 'top_line')->dropDownList([ 'N' => '否','Y' => '是',  ]) ?>

    <?= $form->field($model, 'sort_desc')->textInput(['maxlength' => true])->hint('数值越小排序越前') ?>

    <?= $form->field($model, 'status_is')->dropDownList([ 'Y' => '显示', 'N' => '隐藏', ]) ?>
    <?= $form->field($model,'content')->widget('common\widgets\ueditor\Ueditor',['options'=>['initialFrameHeight' => 200,]]); ?>
    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => true]) ?>
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