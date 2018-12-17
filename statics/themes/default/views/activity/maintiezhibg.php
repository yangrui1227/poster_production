<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use mobile\models\UploadFiles;
$this->title = $model->title;
$this->metaTags[]="<meta name='description' content='$model->content'/>";
?>
<style>
.big-img{ width:48%;
    height: 113px;
    display: table-cell;
    vertical-align: middle;
    text-align: center; overflow:hidden}
.big-img img{max-width:100%;max-height:190px;
    vertical-align: middle;
    margin: 0 auto;}	 
.am-gallery-default .am-gallery-title {
     margin-top: 0px;

}
.am-form input{ border:none}
</style>
<body>

<div class="am-g">
<button type="button" class="am-btn am-btn-primary am-btn-block" style="font-size:28px">上传照片</button>

</div>
<br>

<div style="clear:both"></div>

  <?php if($new_background_id){?>
<div class="am-container action-pic">
 <img src="<?=UploadFiles::findimage($new_background_id);?>" class="am-img-responsive">
 </div>
<?php } ?>
<?php $post_url = Url::to(['maintiezhibg','activity_id'=>$activity_id,'method'=>$method,'category_id'=>$category_id,'activity_image'=>$activity_image]);?>
<?php $form = ActiveForm::begin(['action'=>'','options' => ['enctype' => 'multipart/form-data',]]); ?>
<div class="am-container">
<div class="am-form-group am-form-file">
  <button type="button" class="am-btn am-btn-default am-btn-sm">
    <i class="am-icon-cloud-upload"></i> 小a要上传的图片</button>
  <input type="file" id="uploadfiles-save_path" name="UploadFiles[save_path]" multiple>
</div>
<button type="submit" class="am-btn am-btn-default  am-btn-block">提交</button>
</div>
<?php ActiveForm::end(); ?>




<ul data-am-widget="pagination"
      class="am-pagination am-pagination-select" >
<!--  <li class="am-pagination-prev "><a class="infolist2"  href="rytz1.html">上一步</a></li>-->
   <li class="am-pagination-next "><a class="infolist2" id="nextaction" href="javascript:;">下一步</a> </li> 
</ul>
<script type="text/javascript">
$("#nextaction").on('click',function(){

   var new_background_id = '<?=$new_background_id;?>';
   if(new_background_id==''){
    alert("请上传背景图片");
    return false;
   }

 window.location.href ='<?= Url::to(['maintiezhiform','activity_id'=>$activity_id,'category_id'=>$category_id,'new_background_id'=>$new_background_id,'activity_image'=>$activity_image])?>';

});


</script>
