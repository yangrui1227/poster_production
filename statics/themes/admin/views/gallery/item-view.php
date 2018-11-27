<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = $model['title'];
$this->params['breadcrumbs'][]="扩展管理";
$this->params['breadcrumbs'][] = ['label' => '图集', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .li-box{ float: left; width: 300px; margin-right: 30px; }
</style>

<div class="gallery-view">
<?php $form = ActiveForm::begin(); ?>


 <?php foreach($item as $key=>$value){?>
<div class="li-box">
 <img src="<?= $value['files']?>" width="200" height="200"/>
 <?= Html::a('删除', ['item-delete', 'id' => $value['id'],'item'=>$value['item']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除图片吗?',
                'method' => 'post',
            ],
        ]) ?>  
 <?= $form->field($modelitem, 'introduce[]')->textarea(['maxlength' => true,'rows' => 3,'value'=>$value['introduce']]); ?>
<?= $form->field($modelitem, 'listorder[]')->textInput(['maxlength' => true,'value'=>$value['listorder']]) ?>
<?= $form->field($modelitem, 'id[]',['template'=>'{input}'])->hiddenInput(['maxlength' => true,'value'=>$value['id']]) ?>
</div>
<?php }?>
<div style="clear: both;"></div>
<div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>
</div>

