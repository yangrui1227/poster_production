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
<button type="button" class="am-btn am-btn-primary am-btn-block" style="font-size:28px">资料填写</button>

</div>



<div class="am-g  am-intro-bd am-container">
  
     <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'am-form am-form-horizontal']]); ?>
      <fieldset>
        
        
      <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">姓名：</label>
          <div class="am-u-sm-8 am-form-label">
          <input type="text" id="name"    name="name" placeholder="请填入获奖人姓名" required />
          </div>
        </div>
        
        <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">代理人工号：</label>
          <div class="am-u-sm-8 am-form-label">
          <input type="text"  id="worknumber"   name="worknumber" placeholder="请填入代理人工号" required />
          </div>
        </div>
        
        <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">代理人电话：</label>
          <div class="am-u-sm-8 am-form-label">
          <input type="text" id="phone"   name="phone" placeholder="请填入代理人电话" required />
          </div>
        </div>
        
        <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">代理人微信：</label>
          <div class="am-u-sm-8 am-form-label">
          <input type="text" id="wechat"   name="wechat" placeholder="请填入代理人微信" required />
          </div>
        </div>
  

<div class="am-form-group am-form-file">
  <button type="button" class="am-btn am-btn-default am-btn-sm">
    <i class="am-icon-cloud-upload"></i> 选择要上传的人物图片</button>
  <input type="file" id="uploadfiles-save_path" class="form-control"  name="UploadFiles[save_path]" multiple>
</div>



        <div class="am-form-group">
          <label for="doc-vld-ta-1"  class="am-u-sm-4 am-form-label">获奖信息：</label>
         <div class="am-u-sm-8 am-form-label"> <textarea  id="brief" name="brief"></textarea> </div>
        </div>
        

        <button class="am-btn am-btn-secondary am-u-md-centered" type="submit" >提交资料</button>
      </fieldset>
     <?php ActiveForm::end(); ?>
  </div>


<script src="/statics/themes/default/views/js/amazeui.min.js"></script> 