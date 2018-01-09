<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<{nocache}>
	<title><{$title}></title>
	<meta content="<{$keywords}>" name="keywords">
	<meta content="<{$desc}>" name="description">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="<{$res}>/css/common.css" />
	<script src="<{$public}>/js/jquery.js"></script>
	<script>
	//登陆类型
	$(function(){
		$("#login_type_td").mouseover(function(){
			$(this).children("#login_type_box").show().hover();
		}).mouseout(function(){
			$(this).children("#login_type_box").hide();
		})
		$("#login_type_box ul li").click(function(){
			$("#login_type_td input[name=login_type]").val($(this).val());
			$("#login_type").text($(this).text());
			$(this).parents('#login_type_box').hide();
		})
	})	
	//搜索框的搜索类型
	$(function(){
		$('td.search_type').mouseover(function(){
			$(this).children('#search_type_box').show().hover();
		}).mouseout(function(){
			$(this).children('#search_type_box').hide();
		})
		$("#search_type_box ul li").click(function(){
			$("td.search_type > a").text($(this).text());
			$(this).parents("#search_type_box").hide();
			$(this).parent('ul').next('input[name=search_type]').val($(this).val());
		})
	})	
	//搜索检测
	$(function(){
		$('.search_btn_but').click(function(){
			if(check_login()){
				if($("input[name=keyword]").val()==''){
					alert('请输入内容');
					return false;
				}
			}else{
				return false;
			}
		})
	})
	//是否登录
	function check_login(){
		if("<{$smarty.session.home_login}>"!="1"){
			$(".login_window_back").show();
			$(".login_window_box_back").show();
			window.scrollTo(0,0);		
			return false;
		}else{
			return true;
		}
	}
	</script>
</head>
<{/nocache}>
<body>
<div id="header">
		<{nocache}>
		<div id="logo_user_login">
			<div id="logo">
				<a href="<{$root}>"><img src="<{$public}>/images/<{$logo_name}>" alt="源代码logo" title="源代码"/></a>
			</div>
			<{if $smarty.session.home_login==1}>
			<div id="user_info">
				<a href="<{$root}>/space.php"><img src="<{$public}>/uploads/user/s_<{$smarty.session.user_info.face_path}>" /></a>
				<div id="opera">
					<strong><a href="<{$root}>/space.php/index/index/uid/<{$smarty.session.user_info.id}>"><{$smarty.session.user_info.name}></a></strong> 在线
					|
					消息(<a href="<{$root}>/space.php/sms/index/uid/<{$smarty.session.user_info.id}>" style="color:red"><b><{$sms_num}></b></a>)
					|
					<a href="<{$app}>/subject/post_subj_page">快速发帖</a>
					|
					<a href="<{$app}>/login/logout">退出</a>
					<br />
					<a href="<{$root}>/space.php/index/index/uid/<{$smarty.session.user_info.id}>">我的空间</a>
					|
					积分:(<a href="<{$root}>/space.php/profile/index/uid/<{$smarty.session.user_info.id}>"><{$smarty.session.user_info.grade_num}></a>)
					|
					等级:<a href="<{$root}>/space.php/profile/index/uid/<{$smarty.session.user_info.id}>"><{$smarty.session.user_info.level}></a>
				</div>
			</div>
			<{else}>
			<div id="user_login">
			<form action="<{$root}>/index.php/login/login" method="post">
			<table cellspacing='0' border="0">
				<tr>
					<td id="login_type_td">
						<span id="login_type">用户名:</span>
						<div id="login_type_box">
							<ul>
								<li value="1">Email</li>
								<li value="2">UID</li>
								<li value="3">用户名</li>
							</ul>
						</div>
						<input type="hidden" name="login_type" value="3">
					</td>
					<td><input type="input" name="name" class="input_height" /></td>
					<td><a href="<{$app}>/register/index"><b>立即注册</b></a></td>
				</tr>
				<tr>
					<td>密码:</td>
					<td><input type="password" name="pass" class="input_height" /></td>
					<td><input type="submit" value="登陆" class="login_btn" /></td>
					
				</tr>
			</table>
			</form>
			</div>
			<{/if}>
			<div class="clear"></div>
		</div>
		<{/nocache}>
		<div id="nav">
			<ul>
				<li class="first"><a href="<{$app}>">论坛</a></li>
				<li class="first"><a href="<{$app}>/news/index">新闻</a></li>
				<li class="first"><a href="<{$app}>/notice/index">公告</a></li>
				<li class="first"><a href="<{$app}>/user">用户</a></li>
			</ul>
		</div>
		<div id="search">
		<table border="0" cellspacing="0">
			<form action="<{$app}>/search/search" method="post">
			<tr>
				<td class="search_icon"></td>
				<td class="search_input"><input type="input" name="keyword" value="<{$smarty.get.keyword}>"/></td>
				<td class="search_type">
					<a href="javascript:void(0)">
						<{if $smarty.get.search_type == 1}>
							主题
						<{elseif $smarty.get.search_type == 2}>
							用户
						<{elseif $smarty.get.search_type == 3}>
							日志
						<{else}>
							主题
						<{/if}>
					</a>
					<div id="search_type_box">
						<ul>
							<li value="1">主题</li>
							<li value="2">用户</li>
							<li value="3">日志</li>
						</ul>
						<{if $smarty.get.search_type == 1}>
							<input type="hidden" name="search_type" value="1" />
						<{elseif $smarty.get.search_type == 2}>
							<input type="hidden" name="search_type" value="2" />
						<{elseif $smarty.get.search_type == 3}>
							<input type="hidden" name="search_type" value="3" />
						<{else}>
							<input type="hidden" name="search_type" value="1" />
						<{/if}>						
					</div>
				</td>
				<td class="search_btn_td">
					<input type="submit" class="search_btn_but" value="搜索" />
				</td>
			</tr>
			</form>
		</table>
		</div>
		<div id="nav_chain">
			<a href="<{$app}>" id="root">&nbsp;</a>
			<{section loop=$nav_chain name=nav}>
				»<a href="<{$nav_chain[nav].url}>"><{$nav_chain[nav].name}></a>
			<{/section}>
		</div>
		<div id='return_top' onclick='window.scrollTo(0,0)'></div>
	</div>
<{include file="public/login_window.tpl"}>