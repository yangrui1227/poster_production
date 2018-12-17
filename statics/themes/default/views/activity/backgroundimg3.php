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
</style>


<div class="am-g">
<button type="button" class="am-btn am-btn-primary am-btn-block" style="font-size:28px">请选择海报背景</button>

</div>
<br>

<div style="clear:both"></div>


<ul class="am-gallery am-avg-sm-2 am-gallery-default am-no-layout">
<?php if($bglist){?>
<?php foreach($bglist as $v){?>
  <li style="text-align:center"  data-am-scrollspy="{animation: 'slide-bottom', repeat: false}">
    <a href="<?= Url::to(['makerongyulink','activity_id'=>$model->id,'category_id'=>$category_id,'size_id'=>$size_id,'background_id'=>$v['id']]); ?>" class="">
  <div class="big-img">
  <img src="<?=$v['attach_file'];?>"  alt="<?=$v['site_name'];?>" data-am-pureviewed="1" >
  </div>
  </a>
  </li>
<?php } ?>      
 <?php } ?>   
</ul>
<?php $post_url =  Url::to(['uploadbg','activity_id'=>$model->id,'category_id'=>$category_id,'size_id'=>$size_id,]);?>
<?php $form = ActiveForm::begin(['action'=>$post_url,'options' => ['enctype' => 'multipart/form-data',]]); ?>
<div class="am-container">
<div class="am-form-group am-form-file">
 <button type="button" class="am-btn am-btn-default am-btn-sm">
    <i class="am-icon-cloud-upload"></i> 选择要上传的背景图片</button> 
  <input type="file" id="uploadfiles-save_path" class="form-control" multiple name="UploadFiles[save_path]">
</div>
<button type="submit" class="am-btn am-btn-default  am-btn-block">提交</button>
</div>
<?php ActiveForm::end(); ?>


<ul data-am-widget="pagination"
      class="am-pagination am-pagination-select" >
  <li class="am-pagination-prev "><a class="infolist2"  href="<?= Url::to(['postersize','activity_id'=>$model->id,'category_id'=>$category_id,'size_id'=>$size_id])?>">上一步</a></li>
 <!--  <li class="am-pagination-next "><a class="infolist2"  href="zthd-bak2.html">下一步</a> </li> -->
</ul>


