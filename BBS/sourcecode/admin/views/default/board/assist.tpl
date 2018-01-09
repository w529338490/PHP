<script type="text/javascript">
	var address='<{$url}>';
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> 内容管理 >> <font class=\"Cf60\">分区/版块</font>");
	}
	
	
	function add_board(obj,pid){
		var html='<tr><td>　　||--　<input type="hidden" name="parent_id" value="'+pid+'" /><input type="text" name="name" /></td><td width=20%><input type="text" name="master" /></td><td width=30%>　　【<a href="javascript:void(0)" onclick="addition(this);">确定</a>】【<a href="javascript:void(0)" onclick="cancel(this)">取消</a>】</td></tr>';
		$(html).insertAfter($(obj).parents('tr'));
	}
	
	function cancel(obj){
		$(obj).parents('tr').remove();
	}
	
	function addition(obj){
		var input=$(obj).parents('tr')[0].getElementsByTagName("input");
		$.ajax({
			url:"<{$url}>/add",
			dataType:"json",
			data:{parent_id:$(input).eq(0).val(),name:$(input).eq(1).val(),master:$(input).eq(2).val()},
			success: function (data){
				if(data){
					$('.info').removeClass('error').removeClass('notice').removeClass('error').addClass('success').html('添加成功！');
					
					var html='<tr><td>　　||--　<a href="<{$root}>/index.php/subject/index/bid/'+data.id+'" target="_black">'+data.name+'</a></td>';
					html+='<td width="20%"><a href="<{$root}>/space.php/index/index/uid/'+data.master+'" target="_black">　　'+data.masterName+'</a></td>';
					html+='<td width="30%">　　【<a href="javascript:void(0)" onclick="modify(this,\''+data.id+'\',\''+data.name+'\',\''+data.masterName+'\')">修改</a>】【<a href="<{$root}>/admin.php/board/del/id/'+data.id+'">删除版块</a>】</td></tr>';
					
					$(obj).parents('tr').replaceWith(html);
				}else{
					$('.info').removeClass('success').removeClass('notice').removeClass('error').addClass('error').html('添加失败！');
				}
			}
		
		});
		
	}
	
	var origin;
	function modify(obj,id,name,masterName){
		var html='<tr>';
		
		html+='<td><input type="hidden" name="id" value="'+id+'" />　　||--　<input type="text" name="name" value="'+name+'"/></td>';
		//html+='';
		html+='<td width=20%><input type="text" name="masterName" value="'+masterName+'" /></td>';
		html+='<td width=30%>　　【<a href="javascript:void(0)" onclick="mod(this);">确定</a>】';
			html+='【<a href="javascript:void(0)" onclick="modify_cancel(this)">取消</a>】</td></tr>';
	
		origin=$(obj).parents('tr').html();
		$(obj).parents('tr').replaceWith(html);
	}
	
	
	function mod(obj){
		var input=$(obj).parents('tr')[0].getElementsByTagName("input");
		$.ajax({
			url:"<{$url}>/mod",
			data:{id:$(input).eq(0).val(),name:$(input).eq(1).val(),master:$(input).eq(2).val()},
			success: function (data){
				if(data=='true'){
					    window.location.reload();
				}else{
					alert(data);
					$('.info').removeClass('success').removeClass('notice').removeClass('error').addClass('error').html('修改失败！');
				}
			}
		});
	}
	
	function modify_cancel(obj){
		$(obj).parents('tr').replaceWith('<tr>'+origin+'</tr>');
	}
	function add_area_html(){
		var html='<tr><td><input type="text" name="name" /></td>';
		html+='<td width=20%>&nbsp;</td>'
		html+='<td width=30%>【<a href="javascript:void(0);" onclick="add_area(this);">确定</a>】</td></tr>';
		$("tbody").append(html);
	}
	
	function add_area(obj){
		var name=$(obj).parents('tr').children('td').eq(0).children('input').val();
		$.ajax({
			url:"<{$url}>/add",
			data:{name:name,parent_id:0},
			dataType:'json',
			success: function (data){
				if(data){
					var html='<tr><td>'+data.name+'</td><td width=20%>版主</td>';
					html+='<td width=30%>【<a href="javascript:void(0);" onclick="add_board(this,'+data.id+')">添加版块</a>】【<a href="javascript:void(0);" onclick="mod_area(this,'+data.id+')">修改</a>】【<a href="<{$url}>/del/id/'+data.id+'" onclick="if(confirm(\'确认删除？\')){return true;}else{return false;}">删除</a>】</td></tr>';
					$(obj).parents('tr').replaceWith(html);
					$('.info').removeClass('success').removeClass('notice').removeClass('error').addClass('success').html('添加分区成功！');
				}
			}
		});
	}
	function mod_area(obj,id,name){
		origin=$(obj).parents('tr').html();
		var html='<tr><td><input type="hidden" name="id" value="'+id+'" /><input type="text" name="name" value="'+name+'" /></td>';
		html+='<td width=20%>&nbsp;</td>'
		html+='<td width=30%>【<a href="javascript:void(0);" onclick="modify_area(this);">确定</a>】';
		html+='【<a href="javascript:void(0)" onclick="modify_cancel(this)">取消</a>】</td></tr>';
		$(obj).parents('tr').replaceWith(html);
	}
	
	function modify_area(obj){
		var input=$(obj).parents('tr')[0].getElementsByTagName("input");
		$.ajax({
			url:"<{$url}>/mod",
			data:{id:$(input).eq(0).val(),name:$(input).eq(1).val()},
			success: function (data){
				if(data=='true'){
					    window.location.reload();
				}else{
					alert(data);
					$('.info').removeClass('success').removeClass('notice').removeClass('error').addClass('error').html('修改失败！');
				}
			}
		});
	}
</script>