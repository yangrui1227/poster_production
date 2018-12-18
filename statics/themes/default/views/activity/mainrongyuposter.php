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
<style>
.bgdl{ font-size:24px; color:#ff6000}
.bgdl span{ color:#FFF}
</style>
<body>
      <?php 
if($poster->background_id){
  $bgimg = Backgroundimage::findimage($poster->background_id);
} else{ 
$bgimg = UploadFiles::findimage($poster->background_image);
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
<div class="am-g action-images-big" style="background-image: url(<?php if($bgimg){echo $bgimg;}else{?>/statics/themes/default/views/images/yy-bg.png <?php }?>); padding:50px">
     
       <!-- 左侧-->
         <div class="am-u-sm-5" style="margin-top:20px">
          <?php if($poster->activity_image){?>
           <div class="am-u-md-12  am-text-right">
            <img src="<?=UploadFiles::findimage($poster->activity_image);?>"  class="am-img-responsive" style="float:right">
          </div>
          <?php } ?>

           <div class="am-u-md-12" style="margin-top:20px">
          <div style="background-image: url(/statics/themes/default/views/images/se-bg.png); padding:14px">
          <div class="am-u-md-3 am-u-sm-12 small-yy" ><img src="/statics/themes/default/views/images/weima.png" class="am-img-responsive"></div>
          <div class="am-u-md-9 am-u-sm-12 bgdl small-yy" >
                <uL>
                  <li><span>代理人工号：</span><?=$poster->worknumber;?></li>
                   <li><span>代理人电话：</span><?=$poster->phone;?></li>
                    <li><span>代理人微信：</span><?=$poster->wechat;?></li>
                </uL>
              
         </div>
         <div style="clear:both"></div>
         </div>
         </div>
         </div>
         
         
        <!--右侧 -->
       
        
         <div class="am-u-sm-7" >
                 <div  style="background-image: url(/statics/themes/default/views/images/bg-tm.png);color:#FFF !important; padding-bottom:50px">
                <h1 class="zhuti" style="color:#FFF; font-style:normal; padding-bottom:10px"><?=$huodong['uname'];?></h1>
               <!-- <div class="am-u-md-12 am-u-sm-12 ztys">喜讯</div>
               <div class="am-u-md-12 am-u-sm-12 ztys">热烈庆祝吴晋江，截止10月16日达成</div>
                <div class="am-u-md-12 am-u-sm-12 ztys" style="text-align:center; color:#fec402; padding:30px 0 40px 0">
                 <h2 style="color:#ffc600">千人项目第一名</h2>
               </div> -->
               <div class="am-u-md-12 am-u-sm-12 ztys">
               <div  style="line-height:40px; padding-top:0px; text-indent:20px">
             <?=$huodong['brief'];?>
                </div>
               </div>
               
                <div style="clear:both"></div>
         </div>
         </div>
         
</div>
<!--4:3比例-->





<!--16:9比例-->
<div class="am-g manyy-images am-show-sm-only" style=" background:url(<?php if($bgimg){echo $bgimg;}else{?>/statics/themes/default/views/images/gryy-bg.png <?php }?>) center top #000 no-repeat">
  <div class="am-container">
      <h1 class="name"><?=$huodong['uname'];?></h1>
      <?php if($poster->activity_image){?>
      <div class="am-container am-text-center">
            <img src="<?=UploadFiles::findimage($poster->activity_image);?>" class="am-img-responsive" style="margin:0 auto">
          </div>
        <?php } ?>
       
         
       <!-- <div class="am-u-md-12 am-u-sm-12 ztys">喜讯</div>
       <div class="am-u-md-12 am-u-sm-12 ztys">
       <p style="padding-left:50px">热烈庆祝吴晋江，截止10月16日达成</p></div>
       
       <div class="am-u-md-12 am-u-sm-12 ztys" style="text-align:center; color:#fec402; padding:50px 0">
         <h2>千人项目第一名</h2>
       </div> -->
       
       <div class="am-u-md-12 am-u-sm-12 ztys">
     
       <div  style="line-height:40px; padding-top:5px; font-size:22px; text-indent:60px">
<?=$huodong['brief'];?>
       </div></div>
       
       <div style="clear:both"></div>
         
          
       
       <div class="am-container man-ry-xx">
     <div class="am-u-md-6 am-u-sm-8" style="padding-right: 0px;">
        <uL>
          <li><span>代理人工号：</span><?=$poster->worknumber;?></li>
          <li><span>代理人电话：</span><?=$poster->phone;?></li>
          <li><span>代理人微信：</span><?=$poster->wechat;?></li>
          
        </uL>
     </div>
     <div class=" am-u-md-6 am-u-sm-4 am-text-center" style=" padding-top:10px; padding-right: 0px;">
     <img src="/statics/themes/default/views/images/weima.png" width="100" class="am-img-responsive">
     
     </div>
 </div>
       
            
  </div>
  
</div>
<!--16:9比例-->
</div>


<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default " style="filter:alpha(Opacity=70);opacity: 0.7;">
  <ul class="am-navbar-nav am-cf am-avg-sm-4 bottom"  style="background-color:#000">
    <li  data-am-navbar-share><a href="###">转发</a></li>
    <li> <a  href="javascript:;" id="takeScreenshot">保存海报到本地</a> </li>
  </ul>
</div>



<input type="hidden" id="poster_id" value="<?=$poster_id?>">
<input type="hidden" id="url" value="<?=Url::to(['saveimg']);?>">
<script src="/statics/themes/default/views/js/amazeui.min.js"></script> 
<script type="text/javascript" src="/statics/js/html2canvas.min.js"></script>
<script type="text/javascript" src="/statics/js/makeposter.js"></script>


</body>
</html>
