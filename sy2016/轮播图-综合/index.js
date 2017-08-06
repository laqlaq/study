(function(){
	var oContainer = document.getElementById('container');
	var oBigImg = document.getElementById('big-img');
	var aBigPic = oBigImg.getElementsByTagName('img');
	var oSmallImg = document.getElementById('small-img');
	var aSmallPic = oSmallImg.getElementsByTagName('img');
	var oPrev = document.getElementById('prev');
	var oNext = document.getElementById('next');
	var oNumber = document.getElementById('number');
	var oCurrent = document.getElementById('current');
	var imgWidth = oSmallImg.offsetWidth / aSmallPic.length;
	var nowIdx = 0;
	var zIndex = 8;
	var timer;
	for(var i=0; i<aBigPic.length; i++){
		aBigPic[i].style.zIndex = aBigPic.length - i;
	}

	for(var i=0; i<aSmallPic.length; i++){
		aSmallPic[i].className = 'small-opacity';
	}
	aSmallPic[nowIdx].className = 'selected';

	oPrev.onmouseover = oNext.onmouseover = function(){
		animate(this, {
			opacity : 100
		});
	};

	oPrev.onmouseout = oNext.onmouseout = function(){
		animate(this, {
			opacity : 0
		});
	};

	oPrev.onclick = oNext.onclick = function(){
		if(this == oPrev){
			nowIdx--;
			if(nowIdx == -1){
				nowIdx = aBigPic.length - 1;
			}
			changeImg(nowIdx);
		}else{
			nowIdx++;
			if(nowIdx == aBigPic.length){
				nowIdx = 0;
			}
			changeImg(nowIdx);
		}
	};

	for(var i=0; i<aSmallPic.length; i++){
		aSmallPic[i].index = i;
		aSmallPic[i].onmouseover = function(){
			animate(this, {
				opacity : 100
			});
		};

		aSmallPic[i].onmouseout = function(){
			if(this.index != nowIdx){
				animate(this, {
					opacity : 30
				});
			}
		};

		aSmallPic[i].onclick = function(){
			if(this.index != nowIdx){
				changeImg(this.index);
			}
		};
	}

	run();
	oContainer.onmouseover = function(){
		clearInterval(timer);
	};
	oContainer.onmouseout = function(){
		run();
	};

	function run(){
		timer = setInterval(function(){
			oNext.onclick();
		},1000);
	}


	function changeImg(index){
		nowIdx = index;
		aBigPic[index].style.opacity = 0;
		aBigPic[index].style.filter = 'alpha(opacity=0)';
		aBigPic[index].style.zIndex = ++zIndex;
		animate(aBigPic[index], {
			opacity : 100
		});
		oPrev.style.zIndex = oNext.style.zIndex = oNumber.style.zIndex = ++zIndex;
		oCurrent.innerHTML = index + 1;
		for(var i=0; i<aSmallPic.length; i++){
			aSmallPic[i].style.opacity = 0.3;
			aSmallPic[i].style.filter = 'alpha(opacity=30)';
		}
		aSmallPic[index].style.opacity = 1;
		aSmallPic[index].style.opacity = 100;
		var iLeft = 0;
		if(index == 0 || index == 1){
			iLeft = 0;
		}else if(index == aSmallPic.length - 1 || index == aSmallPic.length - 2){
			iLeft = aSmallPic.length / 2;
		}else{
			iLeft = index - 1;
		}
		animate(oSmallImg, {
			left : -iLeft * imgWidth
		});
	}
})()