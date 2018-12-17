<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = $model->title;
$this->metaTags[]="<meta name='description' content='$model->content'/>";
?>
<style>
.am-u-sm-4{ padding:10px 0 0 10px}
.makeurl{
  border: 1px solid #e6e6e6;
  width: 80%;
  text-align: center;
  margin: 0 auto;
}
.makeurl textarea{ width: 100%; }
</style>
<div class="am-g">
<button type="button" class="am-btn am-btn-primary am-btn-block" style="font-size:28px">活动主题</button>

</div>



<div class="am-g  am-intro-bd am-container">
  
    <form  method='post'  action='' class="am-form am-form-horizontal">
      <fieldset>
           
        
         <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">创会说时间：</label>
          <div class="am-u-sm-8 am-form-label">
          <input type="text" class="am-form-field" id="start_time"  name="start_time" placeholder="点击获取创会说时间" data-am-datepicker required>               
           </div>       
        </div>
         <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">创说会名称：</label>
            <div class="am-u-sm-8 am-form-label">
          <input type="text" class="" id="name" name="name"  placeholder="输入创说会名称" required>
             </div>
           </div> 
        
           <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">活动地址：</label>
            <div class="am-u-sm-8 am-form-label">
          <input type="text" class="" id="address" name="address"  placeholder="输入活动地址" required>
             </div>
           </div>
           
             <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">讲师名称：</label>
            <div class="am-u-sm-8 am-form-label">
          <input type="text" class="" id="lecturer" name="lecturer"  placeholder="请输入讲师名称" required>
             </div>
           </div>
           

        <div class="am-form-group">
          <label for="doc-vld-ta-1"  class="am-u-sm-4 am-form-label">讲师介绍：</label>
         <div class="am-u-sm-8 am-form-label"> <textarea  name="gContent" id="brief" name="brief"></textarea> </div>
        </div>
        
        
        <button class="am-btn am-btn-secondary am-u-md-centered" type="button" id="makenewurl"  href="javascript:;">生成链接发给小a</button>
      </fieldset>
    </form>
  </div>


<script src="/statics/themes/default/views/js/amazeui.min.js"></script> 

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
  var name = $("#name").val();
  var start_time = $("#start_time").val();
  var address = $("#address").val();
  var lecturer = $("#lecturer").val();
  var brief = $("#brief").val();
   if(!name || !start_time || !address || !lecturer || !brief ){
    alert('请完善信息');return false;
   }
    $.ajax({
    type: "POST",
    url:'<?=Url::to(['getchuangshuourl'])?>',
    data:{activity_id:activity_id,category_id:category_id,size_id:size_id,background_id:background_id,new_background_id:new_background_id,activity_image:activity_image,name:name,start_time:start_time,address:address,lecturer:lecturer,brief:brief},
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
