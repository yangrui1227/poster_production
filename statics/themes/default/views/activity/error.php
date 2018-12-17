<?php
 
/* @var $this yii/web/View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
 
use yii\helpers\Html;

?>
 <!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>海报生成</title>
<meta name="Keywords" content="海报生成" >
<meta name="Description" content="海报生成">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="stylesheet" href="/statics/themes/default/views/css/amazeui.min.css">
<link rel="stylesheet" href="/statics/themes/default/views/css/app.css">
<script type="text/javascript" src="/statics/themes/default/views/js/jquery.min.js"></script>
</head>
<style>
.am-container{ margin:10px 0 10px 0;}
.am-container a{ display:block; padding:30px 0; font-size:20px}
.red{
    color: #F00;
}
</style>
<body>
<div>
 <div class="am-g">
<button type="button" class="am-btn am-btn-primary am-btn-block" style="font-size:28px">海报生成</button>

</div>
<br>
    <div class="alert alert-danger page-none-alert">
        <p>
        <?php if(isset($errorMessage)):?>
            <span class="glyphicon glyphicon-remove-sign text-danger"></span>
            <span class="btn-lg text-danger"><?php echo '操作出错啦！' ?></span>
            <?php echo '<p class="red">'.$errorMessage.'</p>';?>
        <?php else:?>
            <span class="glyphicon glyphicon-ok-sign text-success"></span>
            <span class="btn-lg text-success">恭喜！操作成功！</span>
        <?php endif;?>
    </p>
        
    <p>该页将在3秒后自动跳转!</p>
    <p>
        <?php if(isset($gotoUrl)):?>
            <a href="<?php echo $gotoUrl?>">立即跳转</a>
        <?php else:?>
            <a href="javascript:void(0)" onclick="history.go(-1)">返回上一页</a>
        <?php endif;?>
    </p>
    
    </div>
   <style>
   .page-none-alert{margin: 100px 0 !important;
    text-align: center !important;
    font-size: 30px !important;}
   </style>
 
</div>
 
 <script>
 
<?php if(!isset($gotoUrl)):?>
   setInterval("history.go(-1);",<?php echo $sec;?>000);
<?php else:?>
   setInterval("window.location.href='<?php echo  $gotoUrl;?>'",<?php echo $sec;?>000);
<?php endif;?>
 
</script> 
</body>
</html>