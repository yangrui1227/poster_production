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
<button type="button" class="am-btn am-btn-primary am-btn-block" style="font-size:28px">生成链接</button>

</div>
<br>

<div style="clear:both"></div>



<ul data-am-widget="pagination"
      class="am-pagination am-pagination-select" >
  <li class="am-pagination-prev "><a class="infolist2"  href="<?= Url::to(['posterbackgroundimg','activity_id'=>$model->id,'category_id'=>$category_id,'size_id'=>$size_id])?>">上一步</a></li>

  <li class="am-pagination-next "><a class="infolist2"   href="javascript:;">生成链接发给小a</a> </li>

</ul>

<div class="makeurl" style="display: block;">
  <textarea id="url"><?=$send_url;?></textarea> 
  <button type="button" class="am-btn am-btn-default  am-btn-block copybtn" data-clipboard-action="copy" data-clipboard-target="#url">复制</button>
</div>


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


