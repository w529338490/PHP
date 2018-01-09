<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登录</title>
<style type="text/css">
#all {margin-left:auto; margin-right:auto; text-align: center;width: 540px;}
body {text-align:center;}
#main {background:url(<{$res}>/images/login_mid.gif); height:240px; text-align:center;}
#title {height:66px;margin-top: 120px;}
#login {padding-top:32px;width: 420px; margin-left: auto; margin-right:auto;}
#btm_left {background:url(<{$res}>/images/login_btm_left.gif) no-repeat; width:21px; float:left;height:20px;}
#btm_mid {background:url(<{$res}>/images/login_btm_mid.gif); width:498px; float:left;height:20px;}
#btm_right {background:url(<{$res}>/images/login_btm_right.gif) no-repeat; width:21px; float:left;height:20px;}
</style>
<script type="text/javascript" language="javascript">
function reset_form()
{
	document.getElementById('username').value = '';
	document.getElementById('password').value = '';
	return false;
}
					 
</script>
</head>

<body>
<div id="all">
    <div id="title"><img src="<{$res}>/images/login_title.gif" /></div>
    <div id="main">
    	<form action="<{$url}>/login" method="post" id="login_form">
        <table id="login">
        	<tr>
            	<td>用户名:</td>
                <td><input type="text" name="name" id="username" size="32" style="background:url(<{$res}>/images/username_bg.gif) left no-repeat #FFF; border:1px #ccc solid;height: 20px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: 800; margin:0; padding-left: 24px;" /></td>
            </tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr>
            	<td>密&nbsp;&nbsp;码:</td>
                <td><input type="password" name="pass" id="password" size="32" style="background:url(<{$res}>/images/password_bg.gif) left no-repeat #FFF; border: 1px #ccc solid; height: 20px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: 800; margin:0; padding-left: 24px;" /></td>
            </tr>
            <tr>
            	<td>验证码:</td>
                <td align='left'>
					<input size='15' type="text" name="code" id="code" style="background:url(<{$res}>/images/password_bg.gif) left no-repeat #FFF; border: 1px #ccc solid; height: 20px;font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: 800; margin-left:35px; padding-left: 24px;" onkeyup="this.value=this.value.toUpperCase()"/>
					<img src='<{$url}>/code' style='position:relative;top:7px;cursor:pointer;' onclick='this.src=this.src+"?id="+Math.random()' />
				</td>
            </tr>		
            <tr>
            	<td></td>
            	<td style="text-align: left; padding-top: 32px;">
                	<input type="image" src="<{$res}>/images/login.gif" name="submit" onclick="javascript:document.getElementById('login_form').submit();" />&nbsp;&nbsp;&nbsp;
                    <a href="<{$root}>/index.php/index/index/" target="_top"><input type="image" src="<{$res}>/images/cancel.gif"  name="cancel" /></a>
                </td>
            </tr>
        </table>
    </div>
    <div id="btm">
        <div id="btm_left"></div>
        <div id="btm_mid"></div>
        <div id="btm_right"></div>
    </div>
</div>
</body>
</html>
