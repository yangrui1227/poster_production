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
   <?php $form = ActiveForm::begin(['action'=>$post_url,'options' => ['enctype' => 'multipart/form-data','class'=>'am-form am-form-horizontal']]); ?>
      <fieldset>
            
      <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">代理人姓名：</label>
          <div class="am-u-sm-8 am-form-label">
          <input type="text" id="name"   name="name" placeholder="请填入代理人姓名" required />
          </div>
        </div>
        
        <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">代理人工号：</label>
           <div class="am-u-sm-8 am-form-label">
          <input type="text"  id="worknumber"  name="worknumber" placeholder="请填入代理人工号" required />
           </div>
        </div>
        <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">代理人手机号：</label>
           <div class="am-u-sm-8 am-form-label">
          <input type="text" id="phone" name="phone"  placeholder="请填入代理人手机号" required >
           </div>
        </div>
        <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">代理人微信号：</label>
           <div class="am-u-sm-8 am-form-label">
            <input type="text" id="wechat"  class="js-pattern-mobile" name="wechat" placeholder="请填入代理人微信号" >
           </div>
        </div>
        <hr>
     <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">活动主题：</label>
            <div class="am-u-sm-8 am-form-label">
          <input type="text" class="" id="zhuti" name="zhuti"  placeholder="输入活动主题" required>
             </div>
        </div>
        
         <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">活动时间：</label>
          <div class="am-u-sm-8 am-form-label">
          <input type="text" class="am-form-field" name="start_time" id="start_time"  placeholder="点击获取活动时间" data-am-datepicker required>               
           </div>       
        </div>
        
        
           <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">活动地址：</label>
            <div class="am-u-sm-8 am-form-label">
          <input type="text" class="" id="address" name="address"  placeholder="输入活动地址" required>
             </div>
           </div>
           
             <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">活动价格：</label>
            <div class="am-u-sm-8 am-form-label">
          <input type="text" class="" id="price" name="price"  placeholder="请输入活动价格" required>
             </div>
           </div>
           
              <div class="am-form-group">
          <label class="am-u-sm-4 am-form-label">成团人数：</label>
            <div class="am-u-sm-8 am-form-label">
          <input type="text" class="" id="number" name="number"  placeholder="成团人数" required>
             </div>
           </div>
        

        <div class="am-form-group">
          <label for="doc-vld-ta-1"  class="am-u-sm-4 am-form-label">活动简介：</label>
         <div class="am-u-sm-8 am-form-label"> <textarea id="brief" name="brief"></textarea> </div>
        </div>
        
         <?php if($upimg){?>       
        <div class=" am-container">
         <img src="<?=$upimg->save_path;?>" class="am-img-responsive"><hr>

        </div>
        <?php }?>
        
         <div class="am-form-group am-form-file">
        <button type="button" class="am-btn am-btn-default am-btn-sm">
          <i class="am-icon-cloud-upload"></i> 更换活动主题图片</button>
        <input type="file"  id="uploadfiles-save_path" name="UploadFiles[save_path]" multiple>
      </div>
      
        <button type="submit" class="am-btn am-btn-secondary am-u-md-centered">预览海报</button>
      </fieldset>
   <?php ActiveForm::end(); ?>
  </div>

<script src="/statics/themes/default/views/js/amazeui.min.js"></script> 


