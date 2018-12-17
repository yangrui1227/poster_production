<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = $model->title;
$this->metaTags[]="<meta name='description' content='$model->content'/>";
?>
<div class="am-g">
<button type="button" class="am-btn am-btn-primary am-btn-block" style="font-size:28px">请选择海报生成类型</button>

</div>
<br>

<?php foreach($cate as $v){?>
<?php if($v['id']=='1'){?>
<div class="am-container am-text-center">
   <a type="button" class="am-btn am-btn-warning am-btn-block" href="<?= Url::to(['postersize','activity_id'=>$model->id,'category_id'=>$v['id']]); ?>"><i class="am-icon-taxi"></i> <?= $v['name'];?></a>
</div>
<?php }else if($v['id']=='2'){?>
<div class="am-container">
   <a type="button" class="am-btn am-btn-success am-btn-block" href="<?= Url::to(['postersize','activity_id'=>$model->id,'category_id'=>$v['id']]); ?>"><i class="am-icon-cog"></i> <?= $v['name'];?></a>
</div>
<?php }else if($v['id']=='3'){?>
<div class="am-container">
   <a type="button" class="am-btn am-btn-danger am-btn-block" href="<?= Url::to(['postersize','activity_id'=>$model->id,'category_id'=>$v['id']]); ?>"><i class="am-icon-trophy"></i> <?= $v['name'];?></a>
</div>
<?php }else if($v['id']=='4'){?>
<div class="am-container">
   <a type="button" class="am-btn am-btn-secondary am-btn-block" href="<?= Url::to(['postertiezhi','activity_id'=>$model->id,'category_id'=>$v['id']]); ?>"><i class="am-icon-file"></i> <?= $v['name'];?></a>
</div>
<?php }}?>
