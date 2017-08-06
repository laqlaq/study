$(function(){
   var nowIdx = 0;
    var timer;
   $('#tab li').on('click', function(){
       $(this).addClass('selected').siblings().removeClass('selected');
       $('#main .content').eq($(this).index()).show().siblings().hide();
   });


   run();
   $('#container').hover(function(){
       clearInterval(timer);
   },function(){
       run();
   });

   function run(){
       timer = setInterval(function(){
           nowIdx++;
           nowIdx = nowIdx % 6;
           $('#tab li').eq(nowIdx).trigger('click');
       },1000);
   }



});