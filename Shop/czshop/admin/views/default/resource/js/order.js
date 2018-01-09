$(function(){
	$('select').change(function(){
		$.post(url+'/query',{id:sid,statu:$(this).val()},function(data){
			return data;
		});
	});

	$('#user').click(function(){
		$('.uinfo').show();
	});

	$('img').click(function(){
		$('.uinfo').hide();
	});
});