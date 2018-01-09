$(function(){
	$('.all').click(function(){
		$('input:checkbox').attr('checked',true);
	});

	

	$('.nall').click(function(){
		$('input:checkbox').attr('checked',false);
	});
	/*
	$('input').hover(
		function(){
		$(this).css('border-color','#0099cc').css('background-color','#F5F9FD');
	},function(){
		$(this).css('border-color','#ccc').css('background-color','#FFF');
	});
	*/
	$('.fos:first').focus();
	$('.fos').focus(function(){
		$(this).css('border-color','#0099cc').css('background-color','#F5F9FD');
	}).blur(function(){
		$(this).css('border-color','#333').css('background-color','#FFF');
	});
});