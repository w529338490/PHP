<?php /* Smarty version 2.6.18, created on 2012-02-02 17:17:45
         compiled from login/index.html */ ?>
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
		
		<!--                       Javascripts                       -->
  
		<!-- jQuery -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery-1.3.2.min.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/simpla.jquery.configuration.js"></script>
		
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/facebox.js"></script>
		
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.wysiwyg.js"></script>
		
		<!-- jQuery Datepicker Plugin -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.datePicker.js"></script>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.date.js"></script>

		<!--[if IE]><script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery.bgiframe.js"></script><![endif]-->

		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="<?php echo $this->_tpl_vars['res']; ?>
/js/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
		
	</head>
	<body>
	<body id="login">
		
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<h1>用户登录</h1>
				<!-- Logo (221px width) -->
				<img id="logo" src="<?php echo $this->_tpl_vars['res']; ?>
/images/logo.png" alt="Simpla Admin logo" />
			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				
				<form action="<?php echo $this->_tpl_vars['url']; ?>
/islogin" method="post">
				
					<div class="notification information png_bg">
						<div>
							请输入用户名密码
						</div>
					</div>
					
					<p>
						<label style="margin-top:8px">用户名</label>
						<input class="text-input" type="text" name="user_username"/>
					</p>
					<div class="clear"></div>
					<p>
						<label style="margin-top:8px">密码</label>
						<input class="text-input" type="password" name="user_password"/>
					</p>
					<div class="clear"></div>
					<p>
						<label style="margin-top:8px">重复密码</label>
						<input class="text-input" type="password" name="user_repassword"/>
					</p>
					
					<div class="clear"></div>
					<p>
						<label style="margin-top:8px">验证码</label>
						<input class="text-input" type="text" name="code" style="width:50px;float:left;margin-left:20px;"/>&nbsp;&nbsp;<img src="<?php echo $this->_tpl_vars['url']; ?>
/code" onclick="this.src='<?php echo $this->_tpl_vars['url']; ?>
/code/'+Math.random()" style="margin-top:4px;">(点击换图)
					</p>

					<div class="clear"></div>
					<p id="remember-password">
						
					</p>
					<div class="clear"></div>
					<p>
					<input class="button" type="reset" value="重置" style="float:right;margin-right:80px;"/>
					<input class="button" type="submit" value="登录" style="float:left;margin-left:80px;">
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
		
  </body>
  </html>