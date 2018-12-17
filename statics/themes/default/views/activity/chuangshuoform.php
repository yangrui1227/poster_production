<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = $model->title;
$this->metaTags[]="<meta name='description' content='$model->content'/>";
?>
<style>
.am-u-sm-4{ padding:10px 0 0 10px}
</style>
<div class="am-g">
<button type="button" class="am-btn am-btn-primary am-btn-block" style="font-size:28px">活动主题</button>

</div>



<div class="am-g  am-intro-bd am-container">
  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'am-form am-form-horizontal']]); ?>

      <fieldset>
        
          <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">代理人姓名：</label>
            <div class="am-u-sm-8 am-form-label">
          <input type="text" class="" id="name" name="name" placeholder="输入代理人姓名" required>
             </div>
           </div>
           
             <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">代理人工号：</label>
            <div class="am-u-sm-8 am-form-label">
          <input type="text" class="" id="worknumber" name="worknumber"  placeholder="请输入代理人工号" required>
             </div>
           </div>
           
           
             <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">代理人手机号：</label>
            <div class="am-u-sm-8 am-form-label">
          <input type="text" class="" id="phone" name="phone"  placeholder="输入代理人手机号" required>
             </div>
           </div>
           
             <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">代理人微信号：</label>
            <div class="am-u-sm-8 am-form-label">
          <input type="text" class="" id="wechat" name="wechat"  placeholder="请输入代理人微信号" required>
             </div>
           </div>
         <hr>
   
        <button class="am-btn am-btn-secondary am-u-md-centered" type="submit" >预览海报</button>
      </fieldset>
    <?php ActiveForm::end(); ?>
  </div>


<script src="/statics/themes/default/views/js/amazeui.min.js"></script> 

