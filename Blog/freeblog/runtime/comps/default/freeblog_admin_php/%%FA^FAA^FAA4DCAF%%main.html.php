<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:19
         compiled from index/main.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<p id="page-intro">Free Blog</p>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>FreeBlog系统简介</h3>			
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">FreeBlog系统简介</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>			
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->			
				<div class="content-box-content " >	
						<table >
						<tr >
							<td >个人信息：</td><td ><?php echo $this->_tpl_vars['group']['user_username']; ?>
</td>
						</tr>
						<tr>
							<td>评论总数</td><td><?php echo $this->_tpl_vars['review']; ?>
条</td>
						</tr>
						<tr>
							<td>会员总数</td><td><?php echo $this->_tpl_vars['user_num']; ?>
名</td>
						</tr>
						<tr>
							<td>FreeBlog当前版本</td><td>Bete 1.0</td>
						</tr>
						<tr>
							<td>程序开发</td><td>卫聪 | 闫海静</td>
						</tr>
						<tr>
							<td>致谢</td><td>所有支持和帮助freeblog的朋友</td>
						</tr>
						<tr>
							<td>官方主页</td><td><a href="#">www.freeblog.com</a></td>
						</tr>
						<tr>
							<td>反馈和建议</td><td><a href="#">email我们</a></td>
						</tr>
						<tr>
							<td>Apache版本</td><td><?php echo $this->_tpl_vars['apache']; ?>
</td>
						</tr>
						<tr>
							<td>php版本</td><td><?php echo $this->_tpl_vars['PHP_version']; ?>
</td>
						</tr>
						<tr>
							<td>mysql版本</td><td>5.0.51a </td>
						</tr>
						<tr>
							<td>服务器允许上传文件大小</td><td>10M</td>
						</tr>
					</table>		
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->		
			<div class="clear"></div>
		
			<!--页面底部-->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>










