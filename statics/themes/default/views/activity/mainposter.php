<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use mobile\models\Backgroundimage;
use mobile\models\UploadFiles;
$this->title = $model->title;
$this->metaTags[]="<meta name='description' content='$model->content'/>";
?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="stylesheet" href="/statics/themes/default/views/css/amazeui.min.css">
<link rel="stylesheet" href="/statics/themes/default/views/css/app.css">
<script type="text/javascript" src="/statics/themes/default/views/js/jquery.min.js"></script>
<link rel="stylesheet" href="/statics/themes/default/views/css/loading.css">
<?php $this->head() ?>
</head>

<body>
  <?php 
if($poster->background_id){
  $bgimg = Backgroundimage::findimage($poster->background_id);
} else{ 
$bgimg = $bgimg = UploadFiles::findimage($poster->background_image);
}
?>
<div id="loading">
    <img src="/statics/images/loading.gif" width="33" alt="">
</div>


<!-- 图片显示区域 -->
<div id="thimg"></div>
<!-- 图片显示区域 -->

<div id="activity-show">
<!--4:3比例-->
<div class="am-g action-images-big" style="background-image: url(<?php if($bgimg){echo $bgimg;}else{?>/statics/themes/default/views/images/hd-bg.png <?php }?>); padding-bottom:50px">
   <div class="action-bg">
      <h1 class="zhuti"><?=$huodong->name;?></h1>
      
         <div class="am-u-sm-6">
          <?php if($poster->activity_image){?>
          <img src="<?=UploadFiles::findimage($poster->activity_image);?>" style="width:100%">
        <?php } ?>
        </div>
         <div class="am-u-sm-6">
             
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>人数：</span><?=$huodong->number;?></div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>人均：</span><?=$huodong->price;?></div>
               <div class="am-u-md-12 am-u-sm-12 ztys"><span>时间：</span><?=$huodong->start_time;?></div>
               <div class="am-u-md-12 am-u-sm-12 ztys"><span>地址：</span><?=$huodong->address;?></div>
               <div class="am-u-md-12 am-u-sm-12 ztys"><span>活动详情：</span><p><?=$huodong->brief;?></p></div>
               
         </div>
         <div style="clear:both; padding-top:20px"></div>
         <div class="am-u-sm-9">
                <div class="am-u-md-6 am-u-sm-6 ztys"><span>代理人：</span><?=$poster->name;?></div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>手机号：</span><?=$poster->phone;?></div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>工号：</span><?=$poster->worknumber;?></div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>微信号：</span><?=$poster->wechat;?></div>
         </div>
         <div class="am-u-sm-3"><img src="/statics/themes/default/views/images/weima.png" class="am-img-responsive"></div>
          <div style="clear:both; padding-bottom:20px"></div>
         
    </div>  


</div>


<!--16:9比例-->

<div class="am-g action-images am-show-sm-only" style="background-image: url(<?php if($bgimg){echo $bgimg;}else{?>/statics/themes/default/views/images/hds-bg.png <?php }?>)" >
  <div class="am-container action-bg">
      <h1 class="zhuti"><?=$huodong->name;?></h1>
       <div class="am-u-md-4 am-u-sm-6 ztys"><i class="man"></i><?=$huodong->number;?></div>
       <div class="am-u-md-4 am-u-sm-6 ztys"><i class="money"></i><?=$huodong->price;?></div>
       <div class="am-u-md-4 am-u-sm-12 ztys"><i class="time"></i><?=$huodong->start_time;?></div>
       <div class="am-u-md-12 am-u-sm-12 ztys"><i class="map"></i><?=$huodong->address;?></div>
       
       <div style="clear:both"></div>
        <?php if($poster->activity_image){?>
         <div class="am-container action-pic">
            <img src="<?=UploadFiles::findimage($poster->activity_image);?>" class="am-img-responsive">
          </div>
           <?php } ?>
       <div class="am-container action-text">
            <div class="title"><span>活动简介</span></div>
            <p><?=$huodong->brief;?></p>
       </div>
       
  </div>
  

<!--透明背景以外-->
 <div class="am-container man-xx">
     <div class="am-u-md-6 am-u-sm-7 ">
        <uL>
          <li><span>工    号：</span><?=$poster->worknumber;?></li>
          <li><span>代理人：</span><?=$poster->name;?></li>
          <li><span>手机号：</span><?=$poster->phone;?></li>
          <li><span>微信号：</span><?=$poster->wechat;?></li>
        </uL>
     </div>
     <div class="am-u-md-6 am-u-sm-5 am-text-center">
     <img src="/statics/themes/default/views/images/weima.png" class="am-img-responsive">
     <p style="color:#333">扫描下载App</p>
     </div>
 </div>
  
</div>

</div>


<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default " style="filter:alpha(Opacity=70);opacity: 0.7;">
  <ul class="am-navbar-nav am-cf am-avg-sm-4 bottom"  style="background-color:#000">
    <li  data-am-navbar-share><a href="###">转发</a></li>
    <li> <a href="javascript:;" id="takeScreenshot">保存海报到本地</a> </li>
  </ul>
</div>

<input type="hidden" id="poster_id" value="<?=$poster_id?>">
<input type="hidden" id="url" value="<?=Url::to(['saveimg']);?>">
<script src="/statics/themes/default/views/js/amazeui.min.js"></script> 
<script type="text/javascript" src="/statics/js/html2canvas.min.js"></script>
<script type="text/javascript" src="/statics/js/makeposter.js"></script>
</body>
</html>
