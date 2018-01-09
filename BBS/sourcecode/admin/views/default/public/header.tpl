<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<{$res}>/css/common.css" type="text/css" />
<script type="text/javascript" src="<{$public}>/js/jquery.js"></script>
<title>---无标题---</title>
</head>
<body>
<div id="info_board" class="border">
	<div class="<{if $smarty.get.status eq 1}>
					success
				<{elseif $smarty.get.status eq 2}>
					error
				<{else}>
					notice
				<{/if}> info" ><{$smarty.get.mess}></div>
</div>
<div class="clear"></div>