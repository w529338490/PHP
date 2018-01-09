<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FreeBlog安装程序 第3步/共3步 配置系统</title>
<link href="styles/general.css" rel="stylesheet" type="text/css" />
</head>
<body id="checking">
<script>
	function prev(){
	 window.location="./step2.php";
	}
</script>
<div id="logos">
  <div id="logos-inside"></div>
<div id="lang-menu">
  <div id="lang-menu-inside">
   </div>
</div>
</div>
<form action="step4.php" method='post'>

<table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
<td valign="top">
<div id="wrapper">

  <h3>数据库帐号</h3>

<table width="450" class="list">
<tr>
    <td width="90" align="left">数据库主机：</td>
    <td align="left"><input type="text" name="HOST"  value="localhost" /></td>
</tr>
<tr>
    <td width="90" align="left">用户名：</td>
    <td align="left"><input type="text" name="USER"  value="root" /></td>
</tr>
<tr>
    <td width="90" align="left">密码：</td>
    <td align="left"><input type="password" name="PASS"  value="root" /></td>
</tr>
</table>
<div id="js-monitor" style="display:none;text-align:left;position:absolute;top:45%;left:35%;width:300px;z-index:1000;border:1px solid #000;">
    <div style="background:#fff;padding-bottom:20px;">
        <img id="js-monitor-loading" src='images/loading.gif' /><br /><br />
        <strong id="js-monitor-wait-please" style='color:blue;width:65%;float:left;margin-left:3px;'></strong>
        <span id="js-monitor-view-detail" style="color:gray;cursor:pointer;;float:right;margin-right:3px;"></span>
    </div>
    <iframe id="js-monitor-notice" src="templates/notice.htm" style="display:none;"></iframe>
    <img id="js-monitor-close" src='./images/close.gif' style="position:absolute;top:10px;right:10px;cursor:pointer;" />
</div>
<h3>管理员帐号</h3>
<table width="450" class="list">
<tr>
    <td width="90" align="left">管理员：</td>
    <td align="left"><input type="text" name="Mname"  value="admin" /></td>
</tr>
<tr>
    <td width="90" align="left">登录密码：</td>
    <td align="left"><input type="text" name="Mpass"  value="admin" /><span id="js-admin-password-result"></span></td>
</tr>
<tr>
    <td width="90" align="left">邮箱：</td>
    <td align="left"><input type="text" name="MEmail"  value="admin@163.com" /><span id="js-admin-password-result"></span></td>
</tr>
</table>

</div>
</td>
<td width="227" valign="top" background="images/install-step3-zh_cn.gif">&nbsp;</td>
</tr>
<tr>
  <td><div id="install-btn"><input type="button" id="js-pre-step" onclick="prev()" class="button" value="上一步：检测系统环境" /> <input id="js-install-at-once" type="submit" class="submit" value="立即安装" /></div>
  </td><td></td>
</tr>
</table>
<div id="copyright">
    <div id="copyright-inside">

      &copy; 2011 <a href="http://www.php110.com" target="_blank">兄弟连-FreeBlog小组</a>。保留所有权利。</div>
</div>
</form>
</body>
</html>