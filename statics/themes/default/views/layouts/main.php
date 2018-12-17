<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\web\AssetBundle as AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

//$this->registerCssFile('/statics/themes/default/views/css/site.css', ['depends'=>'yii\bootstrap\BootstrapAsset']);
?>
<?php $this->beginPage() ?>
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
.am-container{ margin:10px 0 10px 0;}
.am-container a{ display:block; padding:30px 0; font-size:20px}
</style>
<body>    
<?php $this->beginBody() ?>
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>

    </div>

<footer data-am-widget="footer" class="am-footer am-footer-default" data-am-footer="{  }">
  
  <div class="am-footer-miscs ">
    <p>由
      <a href="javascript:;" title="青青科技" target="_blank">青青科技</a>提供技术支持</p>
    <p><?=Yii::$app->params['basic']['copyright'];?></p>
    <p><?=Yii::$app->params['basic']['icp'];?></p>
  </div>
</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
