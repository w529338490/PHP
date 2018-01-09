<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<{$res}>/css/common.css" type="text/css" />
<style>
/* 去掉 A 连接的边框线 */
a{blr:expression(this.onFocus=this.close());}
a{blr:expression(this.onFocus=this.blur());}
a:focus { -moz-outline-style: none;}
</style>
<script type='text/javascript' src='<{$public}>/js/jquery.js'></script>
<title>---无标题---</title>
</head>
<body>
<script>
	$(function(){
		$('#nav ul li:first').addClass('bg_image_onclick');
		$('#nav ul li a').click(function(){
			$(this).parent().siblings().removeClass('bg_image_onclick').end().addClass('bg_image_onclick');
		});
	});
</script>
<div id="nav">
   <ul>
		<li class='bg_image'><a href='<{$app}>/index/menu/operate/1' target='menu'>系统设置</a></li>
		<li class='bg_image'><a href='<{$app}>/index/menu/operate/2' target='menu'>内容管理</a></li>
		<li class='bg_image'><a href='<{$app}>/index/menu/operate/4' target='menu'>用户管理</a></li>
		<li class='bg_image'><a href='<{$app}>/index/menu/operate/5' target='menu'>新闻/公告</a></li>
	</ul>
</div>
</body>
</html>