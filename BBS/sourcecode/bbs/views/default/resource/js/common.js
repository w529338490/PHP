$(function(){
	//每隔100毫秒,检测用户的滚动条是不是往下拉了,如果拉了,则显示"回到顶部"的字样
	setTimeout(check_top,100);
	function check_top(){
		if($(document).scrollTop()>150){
			var left=($(document).width()-$('#main').width())/2;
			$('#return_top').show().css({'left':$(document).width()-(left-2)+'px',top:($(window).height()-100)+'px'});;
		}else{
			$('#return_top').hide();
		}
		setTimeout(check_top,100);
	}
})
