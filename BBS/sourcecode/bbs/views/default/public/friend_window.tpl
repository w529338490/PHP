<style type="text/css">
	/*盒子公共样式*/
	.f_window_back{
		display:none;
		position:absolute;
		top:0px;
		left:0px;
		width:100%;
		height:20000px;
		z-index:1;
	}
	.f_window_box_back{
		display:none;
		position:absolute;
		z-index:2;
		background:#DDDDDD;
		top:35%;
		left:35%;
		width:400px;
	}
	.f_window_title{
		margin:5px 5px 2px 5px;
		background: url("<{$res}>/images/title.png") repeat-x scroll 0 0 #EAF1F2;
		border: 1px solid #DDDDDD;
		font-weight: bold;
		height: 33px;
		line-height: 33px;
		overflow: hidden;
		padding: 0 8px;
		position: relative;		
	}
	.f_window_content{
		height:200px;
		background:white;
		margin:0px 5px 5px 5px;
	}
	.f_window_box_back .close{
		position:absolute;
		top:10px;
		right:10px;
	}
	.f_window_box_back .close a{
		display:block;
		width:20px;
		height:20px;
		background:#F8F8F8 url("<{$res}>/images/cls.gif") repeat-x 0 0;		
	}
	.f_window_box_back .close a:hover{
		display:block;
		width:20px;
		height:20px;
		background:#F8F8F8 url("<{$res}>/images/cls.gif") repeat-x 0 -20px;	
	}
	/*自定义内容样式*/
	.f_window_content table tr td,table tr th{
		padding:5px;
	}
	.f_window_content table tr th{
		text-align:right;
	}
	.f_window_content table tr td{
		text-align:left;
	}
	.f_window_content input{
		height:22px;
		width:180px;
	}
	.f_window_content #login_btn{
		background: url("<{$res}>/images/pn.png") repeat-x scroll 0 -48px transparent;
		border: 0 none;
		color: white !important;
		cursor: pointer;
		font-weight: bold;
		height: 25px;
		margin-right: 3px;
		overflow: hidden;
		padding: 0;
		vertical-align: middle;
		width: 80px;
	}
</style>
<script>
	$(function(){
		$(".close a").click(function(){
			$(".f_window_back").hide();
			$(".f_window_box_back").hide();
		})
	})
</script>
<div class="f_window_back"></div>
<div class="f_window_box_back">
	<div class="f_window_title">发送添加好友请求</div>
	<div class="close"><a href="javascript:void(0)"></a></div>
	<div class="f_window_content">
		<form action="<{$app}>/friend/add_friend" method="post">
		<input type="hidden" name="login_type" value="3">
		<table border="0" cellspacing="0" align="center" width="100%">
			<tr>
				<th>发送给:</th>
				<td><input type="text" name="f_name" /></td>
				<input type="hidden" name="f_uid" />
			</tr>
			<tr>
				<th>请求验证:</th>
				<td><textarea style="height:111px;width:273px;" name="content"></textarea></td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td><input type="submit" value="确认发送" id="login_btn" /></td>
			</tr>
		</table>
		</form>
	</div>
</div>