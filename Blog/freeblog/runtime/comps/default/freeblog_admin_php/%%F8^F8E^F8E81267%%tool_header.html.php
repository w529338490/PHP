<?php /* Smarty version 2.6.18, created on 2012-02-02 17:22:47
         compiled from public/tool_header.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
		<title> Free Blog </title>
		<meta name="Keywords" content="">
		<meta name="Description" content="">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<!--                       CSS                       -->
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['res']; ?>
/css/reset.css" type="text/css" media="screen" />
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['res']; ?>
/css/main_style.css" type="text/css" media="screen" />
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['res']; ?>
/css/invalid.css" type="text/css" media="screen" />	
		
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['res']; ?>
/css/blue.css" type="text/css" media="screen" />
		
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['res']; ?>
/css/red.css" type="text/css" media="screen" />  
	 
		-->
		<!-- Internet Explorer Fixes Stylesheet -->
		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="<?php echo $this->_tpl_vars['res']; ?>
/css/ie.css" type="text/css" media="screen" />
		<![endif]-->
		<!--tool_css-->
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['res']; ?>
/css/tool/demos.css" type="text/css" media="screen" />	
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/tool/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/tool/ui.core.js"></script>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/tool/ui.sortable.js"></script>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/tool/ajax3.0.js"></script>
		<!--                       Javascripts                       -->
  
		<!-- jQuery -->
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/simpla.jquery.configuration.js"></script>
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/ajax3.0.js"></script>
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.wysiwyg.js"></script>
		<!-- jQuery Datepicker Plugin -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.datePicker.js"></script>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.date.js"></script>
		<!--                       CSS                       -->
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['res']; ?>
/css/tool/demos.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['res']; ?>
/css/tool/ui.all.css" type="text/css" media="screen" />	
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/tool/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/tool/ui.core.js"></script>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/tool/ui.sortable.js"></script>
		<style type="text/css">
	.column { width: 170px; float: left; padding-bottom: 100px; }
	.portlet { margin: 0 1em 1em 0; }
	.portlet-header { margin: 0.3em; padding-bottom: 4px; padding-left: 0.2em; }
	.portlet-header .ui-icon { float: right; }
	.portlet-content { padding: 0.4em; }
	.ui-sortable-placeholder { border: 1px dotted black; visibility: visible !important; height: 50px !important; }
	.ui-sortable-placeholder * { visibility: hidden; }
	</style>
	<script type="text/javascript">
	$(function() {
		$(".column").sortable({
			connectWith: '.column'
		});
		$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
			.find(".portlet-header")
				.addClass("ui-widget-header ui-corner-all")
				.prepend('<span class="ui-icon ui-icon-plusthick"></span>')
				.end()
			.find(".portlet-content");
		$(".portlet-header .ui-icon").click(function() {
			$(this).toggleClass("ui-icon-minusthick");
			$(this).parents(".portlet:first").find(".portlet-content").toggle();
		});
		$(".column").disableSelection();
	});
	</script>
	</head>
	<body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		<div id="main-content"> <!-- Main Content Section with everything -->
			<noscript> <!-- 当用户关闭掉javascript的时候提示 -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					Download From <a href="http://www.exet.tk">exet.tk</a></div>
				</div>
			</noscript>
			<!-- Page Head -->
			<h2><?php echo $this->_tpl_vars['session']['user_username']; ?>
您好</h2>
			<div style="height:20px;;float:right;border-bottom:1px solid gray"><a href="<?php echo $this->_tpl_vars['root']; ?>
" target="__ablank">首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['app']; ?>
/login/logout">退出</a></div><br/>



			