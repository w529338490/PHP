<?php /* Smarty version 2.6.18, created on 2012-02-27 09:30:29
         compiled from index/menu.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/menu_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="sidebar">
		<div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
			<h1 id="sidebar-title"><a href="#">管理员</a></h1>
		  
			<!-- Logo (221px wide) -->
			<a href="#"><img id="logo" src="<?php echo $this->_tpl_vars['res']; ?>
/images/logo.png" alt="Simpla Admin logo" /></a>
		  
<!-- 		
			<div id="profile-links">
				您好, <a href="#" title="Edit your profile">John Doe</a>, 你有 <a href="#">3 信息</a><br />
				<br />
				<a href="#" title="View the Site">View the Site</a> | <a href="<?php echo $this->_tpl_vars['app']; ?>
/user/logout" title="Sign Out">退出</a>
			</div>   -->      
			
			<ul id="main-nav">  <!-- Accordion Menu -->		
				<?php if ($this->_tpl_vars['group']['group_muser'] == 1): ?>
				<li>
					<a href="<?php echo $this->_tpl_vars['app']; ?>
/user/index" class="nav-top-item" target="main"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
						用户管理
					</a>
					<ul >
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/user/index" target="main">用户列表</a></li>
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/user/add" target="main">添加用户</a></li><!-- Add class "current" to sub menu items also -->
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/group/index" target="main">管理用户组</a></li>
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/group/add" target="main">添加用户组</a></li>					
					</ul>
				</li>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['group']['group_marticle'] == 1): ?>
				<li> 
					<a href="#" class="nav-top-item "> <!-- Add the class "current" to current menu item -->
					文章管理
					</a>
					<ul >
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/articleOther/createArticle" target='main'>发表文章</a></li>
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/articleManage/manageArticle" target='main'>管理文章</a></li> <!-- 添加 class="current" 就会有一个箭头的小图像 -->
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/categoryOther/createCategory" target='main'>添加分类</a></li>
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/categoryManage/manageCategory" target='main'>管理分类</a></li>
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/ReviewManage/viewReview" target='main'>管理评论</a></li>
					</ul>
				</li>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['group']['group_mimage'] == 1): ?>
				<li>
					<a href="#" class="nav-top-item">
						图片管理
					</a>
					<ul >
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/image/add" target='main'>添加图片</a></li>
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/image/edit" target='main'>管理图片</a></li>
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/album/index" target='main'>管理相册</a></li>
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/album/add" target='main'>添加相册</a></li>
					</ul>
				</li>	
				<?php endif; ?>
				<?php if ($this->_tpl_vars['group']['group_mweb'] == 1): ?>
				<li>
					<a href="#" class="nav-top-item">
						网站管理
					</a>
					<ul >
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/WebManage/foreGroundManage" target='main'>网站管理</a></li>
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/dataManage/viewDB" target='main'>数据管理</a></li>
						<?php if ($this->_tpl_vars['operateNotes'] == '1'): ?>
							<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/dataManage/ViewDbOper" target='main'>操作记录</a></li>
						<?php endif; ?>
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/templateManage/allTemplate" target='main'>模板管理</a></li>
					</ul>
				</li>
				<li>
					<a href="#" class="nav-top-item">
						小工具
					</a>
					<ul >
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/tool/index" target='main'>自定义侧边栏</a></li>
						
					</ul>
				</li> 
				
				<li>
					<a href="#" class="nav-top-item">
						友情链接
					</a>
					<ul >
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/flink/add" target='main'>添加链接</a></li>
						<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/flink/edit" target='main'>管理链接</a></li>
					</ul>
				</li> 
				<?php endif; ?>
				
			</ul> <!-- End #main-nav -->
			
			<!--放置信息的地方-->
			<div id="messages" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
			</div> <!-- End #messages -->
			
		</div></div> <!-- End #左边菜单 -->
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>