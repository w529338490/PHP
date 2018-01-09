<{include file='public/header.tpl'}>
<script>var $url='<{$url}>';var face_dir="<{$public}>/uploads/user/s_";</script>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<style>
	input[type='text'],input[type='password']
		width:97%;
		background:none;
		padding:3px;
	}
	.m_over{
		background:#fff !important;
	}
	.m_click{
		color:#f60;
	}

</style>
<script type="text/javascript">
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>'>首页</a> >> <font class=\"Cf60\">等级管理</font>");
	}
</script>
<div id="data">
	<div class="notice_album success PL60">修改成功！</div>
	<form action="<{$url}>/modify" method="post" onsubmit="return filter_invariant()"/> 
    <table width="99%" border="0" align="center"  cellpadding="5" cellspacing="1">
		<thead>
			<tr>
				<th width=50>删？</th>
				<th>等级名称</th>
				<th>最小值</th>
				<th>最大值</th>
			</tr>
		</thead>
        <tbody>
			<{section name="ls" loop=$data }>
			<tr>
				<td><input type="checkbox" name="check[<{$data[ls].id}>]" value="<{$data[ls].id}>" /></td>
				<td><input type="text" value="<{$data[ls].name}>" name="name[<{$data[ls].id}>]" /></td>
				<td><input type="text" value="<{$data[ls].mini}>" name="mini[<{$data[ls].id}>]" /></td>
				<td><{$data[ls].maxi}></td>
			</tr>
			<{/section}>
        </tbody>
        <tfoot>
			<tr>
				<td colspan=4>
					<a href="javascript:void(0);" onclick="check_all()" >全选</a>
					<a href="javascript:void(0);" onclick="check_cancel()" >全不选</a>
					<a href="javascript:void(0);" onclick="check_versa()" >反选</a>
				
					
					<a href="javascript:void(0);" onclick="del_checked()" >删除选中</a>
					<a href="javascript:void(0);" style="color:#FF6600" onclick="add_level();">+添加等级</a>
					<input type="submit" name="submit" value="提交" />
				</td>
			</tr>
        </tfoot>
    </table>
	</form>
</div>

<script type="text/javascript">partition();mouse();</script>
<script>
	
	
	$("tbody td").mouseover(function(){
		$(":text").removeClass('m_over');
		$(this).children(":text").addClass('m_over').select();
	});
	
	/**
	  * 添加等级
	  */
	function add_level(){
		var html="<tr><td>&nbsp;</td><td><input type=\"text\" name=\"add_name[]\" /></td><td><input type=\"text\" name=\"add_mini[]\" /></td><td>&nbsp;</td></tr>";
		$("table tbody").append(html);
		//alert('添加等级');
	}
	
	/**
	  * 过滤掉没有改变的值
	  */
	function filter_invariant(){
		for(var i=0;i<$("input").length;i++){
			if($("input").eq(i).val()==document.getElementsByTagName("input")[i].defaultValue){
				$("input").eq(i).attr('name','');
			}
		}
	}
	
	/**
	  * 删除选中
	  */
	function del_checked(){
		if($("input:checked").length>0){
			if(confirm("确认删除选中？")){
				var ids='';
				for(var i=0;i<$("input:checked").length;i++){
					if($("input:checked").eq(i).val()!='check_all'){
						ids+=$("input:checked").eq(i).val()+",";
					}
				}
				ids=ids.substring(0,ids.length-1);
				$.ajax({
					url:"<{$url}>/del/id/"+ids,
					success:function(data){
						if(data=='true'){
							for(var i=0;i<$("input:checked").length;i++){
								if($("input:checked").eq(i).val()!='check_all'){
									ids+=$("input:checked").eq(i).val()+",";
								}
							}
							$("input:checked").parent().parent().remove();
							$(".info").removeClass('error').removeClass('notice').addClass('success').html('删除成功！');
						}else{
							$(".info").removeClass('success').removeClass('notice').addClass('error').html('删除失败！');
						}
					}
				});
			}
		}else{
			$(".info").removeClass('success').removeClass('notice').addClass('error').html('请选择操作对象！');
		}
	}
</script>
<{include file='public/footer.tpl'}>
