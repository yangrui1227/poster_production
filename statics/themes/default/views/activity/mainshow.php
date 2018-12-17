<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
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
<?php $this->head() ?>
</head>
<body>
<?php 
if($background){
$bgimg = $background->attach_file;
}else{
$bgimg = $new_background->save_path;
}
?>

<!--4:3比例-->
<div class="am-g action-images-big" style="background-image: url(<?php if($bgimg){echo $bgimg;}else{?>/statics/themes/default/views/images/hd-bg.png <?php }?>); padding-bottom:50px">
   <div class="action-bg">
      <h1 class="zhuti"><?=$data['zhuti'];?></h1>
      
         <div class="am-u-sm-6">
          <?php if($zhutu){?>
          <img src="<?=$zhutu->save_path;?>" style="width:100%">
        <?php }?>
        </div>
         <div class="am-u-sm-6">
             
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>人数：</span><?=$data['number'];?></div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>人均：</span><?=$data['price'];?></div>
               <div class="am-u-md-12 am-u-sm-12 ztys"><span>时间：</span><?=$data['start_time'];?></div>
               <div class="am-u-md-12 am-u-sm-12 ztys"><span>地址：</span><?=$data['address'];?></div>
               <div class="am-u-md-12 am-u-sm-12 ztys"><span>活动详情：</span><p><?=$data['brief'];?></p></div>
               
         </div>
         <div style="clear:both; padding-top:20px"></div>
         <div class="am-u-sm-9">
                <div class="am-u-md-6 am-u-sm-6 ztys"><span>代理人：</span><?=$data['name'];?></div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>手机号：</span><?=$data['phone'];?></div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>工号：</span><?=$data['worknumber'];?></div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>微信号：</span><?=$data['wechat'];?></div>
         </div>
         <div class="am-u-sm-3"><img src="/statics/themes/default/views/images/weima.png" class="am-img-responsive"></div>
          <div style="clear:both; padding-bottom:20px"></div>
         
    </div>  


</div>






<!--16:9比例-->


<div class="am-g action-images am-show-sm-only" style="background-image: url(<?php if($bgimg){echo $bgimg;}else{?>/statics/themes/default/views/images/hds-bg.png <?php }?>)">
  <div class="am-container action-bg">
      <h1 class="zhuti"><?=$data['zhuti'];?></h1>
       <div class="am-u-md-4 am-u-sm-6 ztys"><i class="man"></i><?=$data['number'];?></div>
       <div class="am-u-md-4 am-u-sm-6 ztys"><i class="money"></i><?=$data['price'];?></div>
       <div class="am-u-md-4 am-u-sm-12 ztys"><i class="time"></i><?=$data['start_time'];?></div>
       <div class="am-u-md-12 am-u-sm-12 ztys"><i class="map"></i><?=$data['address'];?></div>
       
       <div style="clear:both"></div>
       <?php if($zhutu){?>
         <div class="am-container action-pic">
            <img src="<?=$zhutu->save_path;?>" class="am-img-responsive">
          </div>
        <?php }?>  
       <div class="am-container action-text">
            <div class="title"><span>活动简介</span></div>
            <p><?=$data['brief'];?></p>
       </div>
       
  </div>
  

<!--透明背景以外-->
 <div class="am-container man-xx">
     <div class="am-u-md-6 am-u-sm-7 ">
        <uL>
          <li><span>工    号：</span><?=$data['worknumber'];?></li>
          <li><span>代理人：</span><?=$data['name'];?></li>
          <li><span>手机号：</span><?=$data['phone'];?></li>
          <li><span>微信号：</span><?=$data['wechat'];?></li>
        </uL>
     </div>
     <div class="am-u-md-6 am-u-sm-5 am-text-center">
     <img src="/statics/themes/default/views/images/weima.png" class="am-img-responsive">
     <p style="color:#333">扫描下载App</p>
     </div>
 </div>

  
</div>



<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default " style="filter:alpha(Opacity=80);opacity: 0.8;">
  <ul class="am-navbar-nav am-cf am-avg-sm-4 bottom"  style="background-color:#000">
    <li> <a href="<?=Url::to(['saveposter','activity_id'=>$model->id]);?>">生成海报</a> </li>
    
  </ul>
</div>

</body>
</html>