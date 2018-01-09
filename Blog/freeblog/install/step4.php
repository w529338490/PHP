<?php
//导入配置文件设置
$string=file_get_contents('../config.inc.php');
foreach($_POST as $key=>$value){
  	$pattern="/define\('$key','.*?'\);/";
	$replace="define('$key','$value');";
	$string=preg_replace($pattern,$replace,$string);
}
file_put_contents('../config.inc.php',$string);
//导入数据库
$local=$_POST['HOST'];
$users=$_POST['USER'];
$pass=$_POST['PASS'];
$conn=mysql_connect($local,$users,$pass);
mysql_set_charset('utf8');
mysql_select_db('freeblog');
$string=file_get_contents('FreeBlogSQL.sql');
$arr=explode(';',$string);
foreach($arr as $val){

	$result=mysql_query($val);

	if($result){
		$flag=true;
	}
}
if($flag){
	echo "<script>alert('恭喜您，安装FreeBlog成功！')</script>";
}else{
	echo "<script>alert('安装失败，请重新再试!')</script>";
}
//当前时间
$time=time();
$pass=md5($_POST['Mpass']);
$array=array(
"INSERT INTO free_user_group(group_name,group_description,group_muser,group_mweb,group_marticle,group_mimage,group_sendarticle,group_sendcomment,group_sendmessage) VALUES ( 'è¶…çº§ç®¡ç†å‘˜', 'è¶…çº§ç®¡ç†å‘˜ç”¨æˆ·ç»„ï¼Œè¯¥ç»„çš„ç”¨æˆ·å…·æœ‰å…¨éƒ¨çš„æƒé™', 1, 1, 1, 1, 1, 1, 1);",
"INSERT INTO free_user_group(group_name,group_description,group_muser,group_mweb,group_marticle,group_mimage,group_sendarticle,group_sendcomment,group_sendmessage) VALUES ( 'æ™®é€šä¼šå‘˜', 'æ–°æ³¨å†Œç”¨æˆ·é»˜è®¤å±žäºŽè¯¥ç»„ï¼Œåªæœ‰è¯„è®ºå’ŒçŸ­æ¶ˆæ¯çš„æƒé™', 0, 0, 0, 0, 1, 1, 1);",
"INSERT INTO free_user_group(group_name,group_description,group_muser,group_mweb,group_marticle,group_mimage,group_sendarticle,group_sendcomment,group_sendmessage) VALUES ( 'ç½‘ç¼–', 'é™¤ç”¨æˆ·ç®¡ç†ä¹‹å¤–çš„æƒé™éƒ½å…·æœ‰', 0, 0, 0, 1, 1, 1, 1);",
"INSERT INTO `free_foreground` VALUES (1, 'freeBlog', '1', 'freeBlog_admin@163.com', 'Free Blog give your more free space', 1, 1, '123456', 1);",
"INSERT INTO `free_oper` VALUES (1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);",
"INSERT INTO `free_user` VALUES (1, '{$_POST['Mname']}', '{$pass}', 1, '{$_POST['MEmail']}',{$time}, 2, '127.0.0.1', 1, 0, '0');"
);
foreach($array as $value){
	$reuslts=mysql_query($value);
}
$fp=fopen('../install.lock','w');

fclose($fp);
?>
<script>
	window.location="../index.php";
</script>
