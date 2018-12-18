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
<style>
.bgdl{ font-size:24px; color:#ff6000}
.bgdl span{ color:#FFF}
</style>
<body>
    <?php 
if($background){
$bgimg = $background->attach_file;
}else{
$bgimg = $new_background->save_path;
}
?>
<!--4:3比例-->
<div class="am-g action-images-big" style="background-image: url(<?php if($bgimg){echo $bgimg;}else{?>/statics/themes/default/views/images/yy-bg.png <?php }?> ); padding:50px">

     
       <!-- 左侧-->
         <div class="am-u-sm-5" style="margin-top:20px">
         
           <div class="am-u-md-12  am-text-right">
             <?php if($zhutu){?>
            <img src="<?=$zhutu->save_path;?>"  class="am-img-responsive" style="float:right">
            <?php }?>
          </div>
           <div class="am-u-md-12" style="margin-top:20px">
          <div style="background-image: url(/statics/themes/default/views/images/se-bg.png); padding:14px">
          <div class="am-u-md-3 am-u-sm-12 small-yy">
            <img src="/statics/themes/default/views/images/weima.png" class="am-img-responsive">
          </div>
          <div class="am-u-md-9 am-u-sm-12 bgdl small-yy" >
                <uL>
                  <li><span>代理人工号：</span><?=$data['worknumber'];?></li>
                   <li><span>代理人电话：</span><?=$data['phone'];?></li>
                    <li><span>代理人微信：</span><?=$data['wechat'];?></li>
                </uL>
              
         </div>
         <div style="clear:both"></div>
         </div>
         </div>
         </div>
         
         
        <!--右侧 -->
       
        
         <div class="am-u-sm-7" >
                 <div  style="background-image: url(/statics/themes/default/views/images/bg-tm.png);color:#FFF !important; padding-bottom:50px">
                <h1 class="zhuti" style="color:#FFF; font-style:normal; padding-bottom:10px"><?=$data['name'];?></h1>
               <!-- <div class="am-u-md-12 am-u-sm-12 ztys">喜讯</div>
               <div class="am-u-md-12 am-u-sm-12 ztys">热烈庆祝吴晋江，截止10月16日达成</div>
                <div class="am-u-md-12 am-u-sm-12 ztys" style="text-align:center; color:#fec402; padding:30px 0 40px 0">
                 <h2 style="color:#ffc600">千人项目第一名</h2>
               </div> -->
               <div class="am-u-md-12 am-u-sm-12 ztys">
               <div  style="line-height:40px; padding-top:0px; text-indent:20px">
             <?=$data['brief'];?>
                </div>
               </div>
               
                <div style="clear:both"></div>
         </div>
         </div>
         
         
        
         
  


</div>






<!--16:9比例-->
<div class="am-g manyy-images am-show-sm-only" style=" background:url(<?php if($bgimg){echo $bgimg;}else{?>/statics/themes/default/views/images/gryy-bg.png <?php }?> ) center top #000 no-repeat">
  <div class="am-container">
      <h1 class="name"><?=$data['name'];?></h1>
      
       <?php if($zhutu){?>
      <div class="am-container am-text-center">
            <img src="<?=$zhutu->save_path;?>" class="am-img-responsive" style="margin:0 auto">
          </div>
      <?php }?>
       
       <!-- <div class="am-u-md-12 am-u-sm-12 ztys">喜讯</div>
       <div class="am-u-md-12 am-u-sm-12 ztys">
       <p style="padding-left:50px">热烈庆祝吴晋江，截止10月16日达成</p></div>
       
       <div class="am-u-md-12 am-u-sm-12 ztys" style="text-align:center; color:#fec402; padding:50px 0">
         <h2>千人项目第一名</h2>
       </div> -->
       
       <div class="am-u-md-12 am-u-sm-12 ztys">
     
       <div  style="line-height:40px; padding-top:5px; font-size:22px; text-indent:60px">
<?=$data['brief'];?>
       </div></div>
       
       <div style="clear:both"></div>
         
          
       
       <div class="am-container man-ry-xx">
     <div class="am-u-md-6 am-u-sm-8 " style="padding-right: 0px;">
        <uL>
          <li><span>代理人工号：</span><?=$data['worknumber'];?></li>
          <li><span>代理人电话：</span><?=$data['phone'];?></li>
          <li><span>代理人微信：</span><?=$data['wechat'];?></li>
          
        </uL>
     </div>
     <div class=" am-u-md-6 am-u-sm-4 am-text-center" style=" padding-top:10px">
     <img src="/statics/themes/default/views/images/weima.png" width="100" class="am-img-responsive">
     
     </div>
 </div>
       
                 
       
  </div>
  

  
</div>


<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default " style="filter:alpha(Opacity=80);opacity: 0.8;">
  <ul class="am-navbar-nav am-cf am-avg-sm-4 bottom"  style="background-color:#000">
    <li> <a href="<?=Url::to(['saverongyuposter','activity_id'=>$model->id]);?>">生成海报</a> </li>
    
  </ul>
</div>



</body>
</html>
