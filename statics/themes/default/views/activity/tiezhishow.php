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
if($new_background){
$bgimg = $new_background->save_path;
}
?>

<!--4:3比例-->
<!-- <div class="am-g action-images-big" style="background-image: url(/statics/themes/default/views/images/yy-bg.png); padding-bottom:50px">
   <div class="">
     
      
         <div class="am-u-sm-6"><img src="/statics/themes/default/views/picture/zp.png" style="width:100%"></div>
         <div class="am-u-sm-6">
                 <h1 class="zhuti">创说会名称</h1>
               <div class="am-u-md-6 am-u-sm-6 ztys"><i class="time"></i><span>时&ensp;&ensp;间：</span>2018.10.10</div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><i class="map"></i><span>地&ensp;&ensp;址：</span>广东惠州惠城区</div>
               <div class="am-u-md-12 am-u-sm-12 ztys"><i class="man"></i><span>讲师名称：</span>张黎明</div>
               <div class="am-u-md-12 am-u-sm-12 ztys"><i class="jianjie"></i><span>讲师介绍：</span>
               
               </div>
               
               
         </div>
         <div style="clear:both; padding-top:20px"></div>
         <div class="am-u-sm-9">
                <div class="am-u-md-6 am-u-sm-6 ztys"><span>代理人：</span>栏里</div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>手机号：</span>17876545532</div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>工号：</span>100元</div>
               <div class="am-u-md-6 am-u-sm-6 ztys"><span>微信号：</span>sddfsw</div>
         </div>
         <div class="am-u-sm-3"><img src="/statics/themes/default/views/images/weima.png" class="am-img-responsive"></div>
          <div style="clear:both; padding-bottom:20px"></div>
         
    </div>  


</div> -->






<!--16:9比例-->
<div class="am-g manyy-images " style=" background:url(<?php if($bgimg){echo $bgimg;}else{?>/statics/themes/default/views/images/gryy-bg.png <?php }?> ) center top #000 no-repeat">
  <div class="am-container">
      <h1 class="name"><?=$data['name'];?></h1>
      
      <?php if($activity_image){?>
      <div class="am-container am-text-center">
            <img src="<?=$activity_image->save_path;?>" class="am-img-responsive" style="margin:0 auto">
          </div>
      <?php } ?>
    
       
       <div style="clear:both"></div>
         
          
       
       <div class="am-container man-ry-xx">
     <div class="am-u-md-7 am-u-sm-12 ">
        <uL>
          <li><span>代理人工号：</span><?=$data['worknumber'];?></li>
          <li><span>代理人电话：</span><?=$data['phone'];?></li>
          <li><span>代理人微信：</span><?=$data['wechat'];?></li>
          
        </uL>
     </div>
     <div class="am-u-md-5  am-u-sm-12 am-text-center" style="padding-top:10px">
     <img src="/statics/themes/default/views/images/weima.png">
     
     </div>
 </div>
             
  </div> 
</div>



<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default " style="filter:alpha(Opacity=80);opacity: 0.8;">
  <ul class="am-navbar-nav am-cf am-avg-sm-4 bottom"  style="background-color:#000">
    <li> <a href="<?=Url::to(['savetiezhiposter','activity_id'=>$model->id]);?>">生成海报</a> </li>
    
  </ul>
</div>


</body>
</html>
