<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FreeBlog安装程序 第2步/共3步 环境检测</title>
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<script>
function next(){
	window.location="./step3.php";
}
function prev(){
	window.location="./index.html";
}
</script>
</head>
<body id="checking">
<div id="logos">
  <div id="logos-inside">  </div>
<div id="lang-menu">
  <div id="lang-menu-inside">
   </div>
</div>
<?php
if($_POST['sure']!="yes"){
	echo "<script>alert('您没有同意许可,系统将终止执行!')</script>";
	exit;
}
?>
</div>
<form method="post">
<table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
<?php
if(extension_loaded('PDO')){
	$str= "模块开启";
}else{
	$str= "模块未开启";
}
if(extension_loaded('GD')){
	$str1= "模块开启";
}else{
	$str1= "模块未开启";
}
if(extension_loaded('zip')){
	$str2= "模块开启";
}else{
$str2= "模块未开启";
}
$FILEPATH=$_SERVER['DOCUMENT_ROOT'].'/freeblog/';
if(is_writable($FILEPATH.'/config.inc.php')){
	$str3= "可写";
}else{
	$str3= '不可写';
}
if(is_writable($FILEPATH.'/index.php')){
	$str4= "可写";
}else{
	$str4= '不可写';
}
if(is_writable($FILEPATH.'/admin.php')){
	$str5= "可写";
}else{
	$str5= '不可写';
}
if(is_writable($FILEPATH.'/template')){
	$str6= "可写";
}else{
	$str6= '不可写';
}
if(is_writable($FILEPATH.'/dataBack')){
	$str7= "可写";
}else{
	$str7= '不可写';
}					
if(is_writable($FILEPATH.'/runtime')){
	$str8= "可写";
}else{
	$str8='不可写';
}
?>
<td valign="top"><div id="wrapper">
  <h3>系统环境</h3>
	<div class="list">
        	  操作系统..........................................................................................................................<?php echo PHP_OS; ?><br />
		  Web服务器.....................................................................................................................<?php echo $_SERVER['SERVER_SOFTWARE']; ?><br />
		  PHP版本.........................................................................................................................<?php echo PHP_VERSION; ?><br />
		  PDO扩展........................................................................................................................<?php echo $str; ?><br />
		  GD库扩展.......................................................................................................................<?php echo $str1; ?><br />
		  ZIP扩展...........................................................................................................................<?php echo $str2; ?><br />
           </div>
        <h3>文件/目录权限检测</h3>
	<div class="list">          
	     config.inc.php文件......................................................................................................
	     			  <span style="color:green;"><?php echo $str3 ?></span>
             <br />
                   index.php文件..............................................................................................................
                                  <span style="color:green;"><?php echo $str4 ?></span>
             <br />
                   admin.php文件............................................................................................................
                                  <span style="color:green;"><?php echo $str5 ?></span>
             <br />
                   模板临时目录................................................................................................................
                                  <span style="color:green;"><?php echo $str6 ?></span>
             <br />
                   数据临时备份目录........................................................................................................
                                  <span style="color:green;"><?php echo $str7 ?></span>
             <br />
                   临时运行文件夹............................................................................................................
                                  <span style="color:green;"><?php echo $str8 ?></span>
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
	     <br />&nbsp;
         </div>
        </div></td>
<td width="227" valign="top" style="background:url(images/install-bg.gif) repeat-y;"><img src="images/install-step2-zh_cn.gif" alt="" /></td>
</tr>
<tr>
  <td><div id="install-btn"><input type="button" class="button" id="js-pre-step" class="button" value="上一步：欢迎页" onclick="prev()" />
      <input type="button" class="button" id="js-recheck" class="button" value="重新检查"/>
      <input type="button" class="button" id="js-submit"  class="button" value="下一步：配置系统"  onclick="next()"  /></div>
  </td>
  <td></td>
</tr>
</table>
<div id="copyright">
    <div id="copyright-inside">

      &copy; 2011 <a href="http://www.php110.com" target="_blank">兄弟连-FreeBlog</a>。保留所有权利。</div>
</div>
<input name="userinterface" id="userinterface" type="hidden" value="" />
<input name="ucapi" type="hidden" value="" />
<input name="ucfounderpw" type="hidden" value="" />
</form>
</body>
</html>
