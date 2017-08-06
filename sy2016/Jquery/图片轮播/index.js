$(function(){
    var $bigImg = $('#big-img');
    var $bigImgs = $('#big-img img');
    var $bigImgWidth = $bigImgs.first().outerWidth();
    var $smallImg = $('#small-img');
    var $smallImgs = $('img', $smallImg);
    var $prev = $('#prev');
    var $next = $('#next');
    var distance = 0;
    var nowIdx = 0;
    var $bg = $('.bg');
    var $bg1 = $('.bg1');
    var $bg2 = $('.bg2');
    var $bg3 = $('.bg3');
    resizeHandler();
    $(window).on('resize', function(){
        resizeHandler();
    });
    $next.on('click', function(){
        nowIdx++;
        if(nowIdx == $bigImgs.length){
            nowIdx = 0;
        }
        changeImg();
    });

    $prev.on('click', function(){
        nowIdx--;
        if(nowIdx == -1){
            nowIdx = $bigImgs.length - 1;
        }
        changeImg();
    });

    $smallImgs.on('click', function(){
        nowIdx = $(this).index();
        changeImg();
    });


    function changeImg(){
        var leftVal = -nowIdx * ($bigImgWidth + 2 * distance);
        $bigImg.stop().animate({
            left : leftVal
        });
        $smallImgs.eq(nowIdx).addClass('selected').siblings().removeClass('selected');
        $bg1.stop().animate({
            left : leftVal / 8
        });
        $bg2.stop().animate({
            left : leftVal / 4
        });
        $bg3.stop().animate({
            left : leftVal / 2
        });
    }





    function resizeHandler(){
        distance = ($('body').width() - $bigImgWidth) / 2;
        if(distance < 0){
            distance = 0;
        }
        $bg.width($(window).width() * $bigImgs.length);
        $bigImg.width($(window).width() * $bigImgs.length);
        $bigImgs.css({
            marginLeft : distance,
            marginRight : distance
        });
        $smallImg.css({
            marginLeft : distance + 85
        });
        $prev.css({
            left : distance + 10
        });
        $next.css({
            left : distance + $bigImgWidth - 40
        });
    }
});