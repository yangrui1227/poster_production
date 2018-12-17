 $(function(){  
 
    $("#takeScreenshot").click(function(){ 
        alert('正在保存中,如果失败请手动保存'); 
        create_image();
    }); 
});
function create_image() {
    var width = $("#activity-show").innerWidth(); 
    var height = $("#activity-show").height(); 
    var canvas = document.createElement("canvas"); 
    var context = canvas.getContext("2d");
    var scale = 2;
    let that = this;   
    canvas.width = width * scale+"px";
    canvas.height = height * scale+"px";               
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
     
     Download(window.html_canvas);

    });

}
/**
* 把图片文件流保存到本地
*/
function Download(path){

var newimgw = $(document.body).width();
var newimgh = $(document.body).height();
var poster_id = $("#poster_id").val();
var url = $("#url").val();
    $.ajax({
        url:url,
        data:{img:path,poster_id:poster_id },
        type:'post',
        dataType:'json',
        success:function(data){
             if(data.code=='0'){
            //alert('success');
            var filename = 'haibao_' + (new Date()).getTime() + '.png';
             var pHtml = "<img src="+data.message+" width="+newimgw+" height="+newimgh+"  id='image_down'/>";
            $('#thimg').html(pHtml);
            $("#activity-show").hide();
            saveimg(data.message,filename);
            
            } else{
                alert('fail');
            }
          
        },
             
    });
   // setTimeout(function(){ deleteimg($("#image_down").attr('src')); }, 3000);
}


function saveimg(data, filename) {
   var save_link = document.createElementNS(
    'http://www.w3.org/1999/xhtml', 'a');
    save_link.href = data;
     save_link.download = filename;
    var event = document.createEvent('MouseEvents');
  event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0,
                    false, false, false, false, 0, null);
  save_link.dispatchEvent(event);

};
