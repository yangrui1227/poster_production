<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
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
.makeurl{
  border: 1px solid #e6e6e6;
  width: 80%;
  text-align: center;
  margin: 0 auto;
}
.makeurl textarea{ width: 100%; }
</style>


<div class="am-g">
<button type="button" class="am-btn am-btn-primary am-btn-block" style="font-size:28px">请选择活动主图</button>

</div>
<br>

<div style="clear:both"></div>



<div class="am-container">


<div class=" am-container">
  <?php if($upimg){?>
         <img src="<?=$upimg->save_path;?>" class="am-img-responsive"><hr>
<?php } ?>
        </div>
 <?php $form = ActiveForm::begin(['action'=>$post_url,'options' => ['enctype' => 'multipart/form-data',]]); ?>
<div class="am-form-group am-form-file">
  <button type="button" class="am-btn am-btn-default am-btn-sm">
    <i class="am-icon-cloud-upload"></i> 选择要上传的活动主题图片</button>
   <input type="file" id="uploadfiles-save_path" class="form-control" multiple name="UploadFiles[save_path]">
</div>

<button type="submit" class="am-btn am-btn-default  am-btn-block">保存</button>
<?php ActiveForm::end(); ?>
</div>



<ul data-am-widget="pagination"
      class="am-pagination am-pagination-select" >
  <li class="am-pagination-prev "><a class="infolist2"  href="<?= Url::to(['posterbackgroundimg','activity_id'=>$model->id,'category_id'=>$category_id,'size_id'=>$size_id])?>">上一步</a></li>
  <?php if($category_id==1){?>
  <li class="am-pagination-next "><a class="infolist2" id="makenewurl"  href="javascript:;">生成链接发给小a</a> </li>
<?php }?>
</ul>

<div class="makeurl" style="display: none;">
  <textarea id="url"></textarea> 
  <button type="button" class="am-btn am-btn-default  am-btn-block copybtn" data-clipboard-action="copy" data-clipboard-target="#url">复制</button>
</div>

<script type="text/javascript">

$('#makenewurl').click(function(){
  var activity_id = '<?=$model->id?>';
  var category_id = '<?=$category_id?>';
  var size_id = '<?=$size_id?>';
  var background_id = '<?=$background_id?>';
  var new_background_id = '<?=$new_background_id?>';
   var activity_image = '<?=$activity_image?>';
   if(!activity_image){
    alert('请上传活动主图');return false;
   }
    $.ajax({
    type: "POST",
    url:'<?=Url::to(['geturl'])?>',
    data:{activity_id:activity_id,category_id:category_id,size_id:size_id,background_id:background_id,new_background_id:new_background_id,activity_image:activity_image},
    success: function(data) {
      if(data){
         $(".makeurl").show();
         $("#url").val(data);
      }else{
         $(".makeurl").hide();
         $("#url").val('');
      }
     
    },
    error: function(data) {
      return false;
    },
  });

});

</script>
<!-- 复制 -->
<script src="/statics/themes/default/views/js/clipboard.min.js"></script>
<script type="text/javascript">
  var clipboard = new ClipboardJS('.copybtn');
    clipboard.on('success', function(e) {
        alert('复制成功');
    });
    clipboard.on('error', function(e) {
        alert('复制失败，尝试手动复制');
    });
</script>


