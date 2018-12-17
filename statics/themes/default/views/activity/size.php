<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = $model->title;
$this->metaTags[]="<meta name='description' content='$model->content'/>";
?>
<style>
.am-container{ margin:5px 0 5px 0;}
.bl1{width: 180px;height: 135px; background-color:#CCC; margin:0 auto; text-align:center; line-height:120px; color:#333; font-size:28px}
.bl2{ width:180px; height:320px; background-color:#CCC; margin:0 auto; text-align:center; line-height:320px; color:#333; font-size:28px}
</style>
<div class="am-g">
<button type="button" class="am-btn am-btn-primary am-btn-block" style="font-size:28px">请选择海报尺寸</button>

</div>
<br>

<div class="am-container am-text-center">
   <a href="<?= Url::to(['posterbackgroundimg','activity_id'=>$model->id,'category_id'=>$category_id,'size_id'=>1]); ?>"><div class="bl1">4:3</div></a>
</div>

<div class="am-container">
   <a href="<?= Url::to(['posterbackgroundimg','activity_id'=>$model->id,'category_id'=>$category_id,'size_id'=>2]); ?>"><div class="bl2">16:9</div></a>
</div>

<ul data-am-widget="pagination"
      class="am-pagination am-pagination-select" >
  <li class="am-pagination-prev "><a class="infolist2"  href="<?= Url::to(['index','activity_id'=>$model->id])?>">上一步</a></li>
  <!-- <li class="am-pagination-next "><a class="infolist2"  href="zthd-bak.html">下一步</a> </li> -->
</ul>


