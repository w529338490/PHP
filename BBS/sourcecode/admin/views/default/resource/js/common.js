/**
  * [网站配置]
  * 用于更换logo
  */
function mod_logo(obj){
	var html="<input type='file' name='logo' />  <button onclick='cancel_logo(this)'>取消</button>";
	$(obj).parent().html(html);
}
function cancel_logo(obj){
	var html="<img src='"+logo_path+"' /><button onclick='mod_logo(this)'>更改</button>";
	$(obj).parent().html(html);
}

/**
  * 全选，全不选，反选
  */
function check_all(){
	$("input[type='checkbox']").attr('checked',true);
}
function check_cancel(){
	$("input[type='checkbox']").attr('checked',false);
}
function check_versa(){
	$chbox=$("input[type='checkbox']");
	for(var i=0;i<$chbox.length;i++){
		if($chbox.eq(i).attr('checked')=='checked')
			$val=false;
		else
			$val=true;
		$chbox.eq(i).attr('checked',$val);
	}
}

/**
  * 询问用户是否删除
  */
function confirm_info($url,info){
	if(info==''){
		location.href=$url;
		return true;
	}else{
		if(confirm(info)){
			location.href=$url;
			return true;
		}
	}
	return false;
}

/**
  * 删除选中
  */
function delete_checked(url){
	confirm_info(url+"/del/id/"+combination(),'确认删除？');
}

/**
  * 屏蔽选中
  */
function hidden_checked(url){
	confirm_info(url+'/hidden/id/'+combination(),'');
}

/**
  * 选中取消屏蔽
  */
function hidden_cancel(url){
	confirm_info(url+'/hidden_cancel/id/'+combination(),'');
}

/**
  * 组合ID号
  */
function combination(){
	var $check=$("input[type='checkbox']:checked");
	var str='';
	for(var i=0;i<$check.length;i++){
		str+=$check.eq(i).attr('value')+',';
	}
	str=str.substring(0,str.length-1);
	return str;
}

/**
  * 鼠标经过时的事件
  */
var old_color;
function mouse(){
	$('tbody tr').mouseover(function(){
		old_color=$(this).css('backgroundColor');
		$(this).css('backgroundColor','#e0f0e0');
	}).mouseout(function(){
		$(this).css('backgroundColor',old_color);
	});
};

/**
  * 表格隔行换色
  */
function partition(){
	$("tbody tr:odd").addClass('odd');
	$("tbody tr:even").addClass('even');
}

/**
  * 点击后去掉默认字，如果鼠标离开用户没有输入内容
  * 再把内容设置为默认的内容
  */
function default_click(){
	var obj=$(".default_click");
	$(obj).click(function(){
		if($(obj).val()==this.defaultValue){
			$(obj).val('');
		}
	}).blur(function(){
		if($(obj).val()==''){
			$(obj).val(this.defaultValue);
		}
	});
}


/**
  * 搜索时的选择版块
  */
function select_board($bid){
	$.ajax({
		url		: 	address+"/children_board/bid/"+$bid,
		dataType:	"json",
		success	:	function(data){
			$("#board").html('');
			var $html='<option value=0>请选择</option>';
			for(var i=0;i<data.length;i++){
				$html+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
			}
			//$("#board").appendTo($html);
			$($html).appendTo('#board');
		}
	});
}

/**
  * ajax 版的删除
  */
function ajax_del(obj,$url){
	$.ajax({
		url:$url,
		success:function (data){
			if(data=='true'){
				$(obj).parent().parent().remove();
				$('.info')
					.removeClass('error')
					.removeClass('success')
					.addClass('success')
					.html('删除成功！');
			}else{
				$('.info')
					.removeClass('error')
					.removeClass('success')
					.addClass('error')
					.html('删除失败！');
			}
		}
	});
}

/**
  * 根据不同的ID号加载不同的用户的资料
  */
function ajax_user(id){
	$.ajax({
		url:$url+'/get_user/id/'+id,
		dataType:'json',
		success:function(data){
			$("input[name='id']").val(data.id);
			$("input[name='name']").val(data.name);
			$("input[name='true_name']").val(data.true_name);
			
			$("input[name='sex']").eq(data.sex).attr('checked',true);
			
			
			$("input[name='email']").val(data.email);
			$("input[name='stand']").eq(3-parseInt(data.stand)).attr('checked',true);
			
			
			
			/* 设置出生城市 */
			$("select[name='birth_province'] option").eq(parseInt(data.birth_province)-1).attr('selected',true);
			get_city(data.birth_province);
			var html_city='';
			for(var i=0;i<city_list.length;i++){
				if(city_list[i].id==data.birth_city){
					html_city+="<option value='"+city_list[i].id+"' selected >"+city_list[i].name+"</option>";
				}else{
					html_city+="<option value='"+city_list[i].id+"'>"+city_list[i].name+"</option>";
				}
				
			}
			
			$(html_city).appendTo("select[name='brith_city']");
			
			/* 设置居住城市 */
			$("select[name='live_province'] option").eq(parseInt(data.live_province)-1).attr('selected',true);
			get_city(data.live_province);
			var html_city='';
			for(var i=0;i<city_list.length;i++){
				if(city_list[i].id==data.live_city){
					html_city+="<option value='"+city_list[i].id+"' selected >"+city_list[i].name+"</option>";
				}else{
					html_city+="<option value='"+city_list[i].id+"'>"+city_list[i].name+"</option>";
				}
				
			}
			
			$(html_city).appendTo("select[name='live_city']");
			
			$("input[name='live_add']").val(data.live_add);
			$("input[name='hobby']").val(data.hobby);
			$("input[name='marriage']").eq(parseInt(data.marriage)).attr('checked',true);
			$("input[name='last_time']").val(data.last_time);
			$("input[name='birthday']").val(data.birthday);
			
			$("input[name='last_ip']").val(data.last_ip);
			$("img[name='face_path']").attr('src',face_dir+data.face_path);
			$("input[name='grade_num']").val(data.grade_num);
			$("input[name='sign']").val(data.sign);
			$("input[name='state']").eq(parseInt(data.state)).attr('checked',true);
		}
	});
}
/**
  * 得到省下面的所有市。。
  * @return 所有的市列表
  */
 var city_list='';
function get_city(id){
	$.ajax({
		async:false,
		url:$url+'/get_city/id/'+id,
		dataType:'json',
		success:function(data){
			city_list=data;
		}
	});
}

/**
  * 城市改变时的Ajax的请求
  */
function change_city(obj){
	get_city($(obj).val());
	var html_city='';
	for(var i=0;i<city_list.length;i++){
		html_city+="<option value='"+city_list[i].id+"'>"+city_list[i].name+"</option>";
	}
	$(obj).next().html(html_city);	
}


/**
  * 等级的提示
  */
function level_notice(val,info){
		if(val==1){
			$(".notice_album")
			.html(info)
			.removeClass('error')
			.addClass('success')
			.fadeIn(500)
			.fadeOut(2000);
		}else{
			$(".notice_album")
			.html(info)
			.removeClass('success')
			.addClass('error')
			.fadeIn(500)
			.fadeOut(2000);
		}
	}
