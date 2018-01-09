<{include file="public/header.tpl"}>
<{nocache}>
<script src="<{$res}>/js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="<{$res}>/css/user_index.css">
	<script>
		//互动操作
		$(function(){
			$(".search_ope").mouseover(function(){
				$(this).next('.ope_box').show();
			}).mouseout(function(){
				$(this).next('.ope_box').hide();
			});
			$(".ope_box").mouseover(function(){
				$(this).show();
			}).mouseout(function(){
				$(this).hide();
			})
		})
		//打招呼	
		$(function(){
			$("a.say_hello").click(function(){
				if(check_login()){
					window.scrollTo(0,0);
					$('.hello_window_back').show();
					$('.hello_window_box_back').show();
					var dst_uid=$(this).parent('li').siblings('input[name=dst_id]').val();
					$("#hello_btn").click(function(){
						var content=$(':radio:checked').val();
						$.ajax({
							type:'post',
							url:'<{$app}>/user/hello',
							data:'dst_id='+dst_uid+'&content='+content,
							success:function(data){
								if(data=='1'){
									alert('已向对方打招呼');
								}
							}
						})					
					})
				}			
			})				
		})
		//发送短信(赋值)
		$(function(){
			$('a.send_sms').click(function(){
				if(check_login()){
					$('.sms_window_back').show();
					$('.sms_window_box_back').show();
					$("input[name=f_uid]").val($(this).parent('li').siblings('input[name=dst_id]').val());
					$("input[name=f_name]").val($(this).parent('li').siblings('input[name=dst_name]').val());
				}
			})
		})
	</script>
	<div id="main">
		<div id="user_list">
			<ul class="user_ul">
				<{section loop=$user_list name='ul'}>
				<li>
					<a href="<{$root}>/space.php/index/index/uid/<{$user_list[ul].id}>">
						<img src="<{$public}>/uploads/user/s_<{$user_list[ul].face_path}>" />
					</a>
					<p>
						<a href="<{$root}>/space.php/index/index/uid/<{$user_list[ul].id}>" class="search_user_name"><{$user_list[ul].name}></a>
					</p>
					<p><{$user_list[ul].level}> 积分:<{$user_list[ul].grade_num}></p>
					<a class="search_ope" href="javascript:void(0)">互动</a>
					<ul class="ope_box">
						<li><a href="<{$root}>/space.php/index/index/uid/<{$user_list[ul].id}>">去串个门</a></li>
						<li><a href="javascript:void(0)" class="say_hello">打个招呼</a></li>
						<li><a href="javascript:void(0)" class="send_sms">发送消息</a></li>
						<li><a href="<{$root}>/space.php/profile/index/uid/<{$user_list[ul].id}>">查看资料</a></li>
						<input type="hidden" name="dst_id" value="<{$user_list[ul].id}>" />
						<input type="hidden" name="dst_name" value="<{$user_list[ul].name}>" />
					</ul>
				</li>	
				<{sectionelse}>
					<p style="padding:10px;">无此用户</p>
				<{/section}>
 			</ul>
			<div class="clear"></div>
		</div>
		<p style="margin-top:5px"><{$fpage}></p>
	</div>
<{include file="public/hello_box.tpl"}>
<{include file="public/sms_window.tpl"}>
<{/nocache}>
<{include file="public/footer.tpl"}>