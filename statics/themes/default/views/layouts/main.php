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
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!--<link href="/statics/themes/default/views/css/site.css" rel="stylesheet">-->
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<script type="text/javascript">
 $(function(){  
    $("#takeScreenshot").click(function(){  
        //yulan();
        create_image();
    });  
});

function create_image() {
    var width = $("#activity-show").width(); 
    var height = $("#activity-show").height(); 
    var canvas = document.createElement("canvas"); 
    var context = canvas.getContext("2d");
    var scale = 2;
    let that = this;   
    canvas.width = width * scale;
    canvas.height = height * scale;               
    canvas.getContext("2d").scale(scale, scale);
    var opts = {
            scale: scale, 
            canvas: canvas, 
            logging: true, 
            width: width, 
            height: height 
        };
    html2canvas(document.getElementById("activity-show"),opts).then(function(canvas) {
        var context = canvas.getContext('2d');
        // 【重要】关闭抗锯齿
        context.ImageSmoothingEnabled = false;
        context.webkitImageSmoothingEnabled = false;
        context.msImageSmoothingEnabled = false;
        context.imageSmoothingEnabled = false;
    
     window.html_canvas = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
    var pHtml = "<img src="+window.html_canvas+" id='image_down'/>";
    $('#html2canvas').html(pHtml);
   // $('#activity-show').hide();
            Download(window.html_canvas) 
    });

}
/**
* 把图片文件流保存到本地
*/
function Download(path){

//var path = $("#image_down").attr('src');
    $.ajax({
        url:'<?= \yii\helpers\Url::to(['/site/saveimg']); ?>',
        data:{img:path },
        type:'post',
        dataType:'json',
        success:function(data){
            //alert(data.message);
             if(data.code=='0'){
            //alert('success');
           // var filename = 'haibao_' + (new Date()).getTime() + '.png' 
            //saveimg(data.message,filename);
            } else{
                alert('fail');
            }
          
        }
    });
}
/*function saveimg(data, filename) {
   var save_link = document.createElementNS(
    'http://www.w3.org/1999/xhtml', 'a');
    save_link.href = data;
     save_link.download = filename;
    var event = document.createEvent('MouseEvents');
  event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0,
                    false, false, false, false, 0, null);
  save_link.dispatchEvent(event);
};*/

 </script>
</body>
</html>
<?php $this->endPage() ?>
