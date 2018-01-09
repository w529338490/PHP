<?php /* Smarty version 2.6.18, created on 2012-02-02 17:36:11
         compiled from album/update.html */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	
			<p id="page-intro">Free Blog</p>
			<!--如果想要这个右边头部导航菜单打开注释即可
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/right_header_menu.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			-->	
			<div class="clear"></div> <!-- End .clear -->	
			
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					
					<h3>添加用户组</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">添加用户组</a></li> <!-- href must be unique and match the id of target div -->
						
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">	
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->			
				<div class="notification attention png_bg">
				<a href="#" class="close"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_grey_small.png" title="关闭友情提醒" alt="关闭" /></a>
				<div>
					友情提醒：带*号的都为必填项 
				</div>
				</div>
					<form action="<?php echo $this->_tpl_vars['url']; ?>
/exe_update" method="post">
						<table>	
							<tbody>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>相册分类<font color="red">*</font></td>
									<td><?php echo $this->_tpl_vars['select']; ?>
</td>
									<td >&nbsp</td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>相册名称<font color="red">*</font></td>
									<td><input type="text" name="album_title" value="<?php echo $this->_tpl_vars['title']; ?>
">(不能以特殊符号开头)</td>
									<td >&nbsp</td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>相册描述<font color="red">*</font></td>
									<td width="300"><textarea name="album_description" ><?php echo $this->_tpl_vars['description']; ?>
</textarea></td>
									<td width="400"></td>
								</tr>
								
								<tr >
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>
										<div class="bulk-actions align-left" >
											<input type="hidden" name="yid" value="<?php echo $this->_tpl_vars['id']; ?>
">
											<input class="button" type="submit" value="确定">
											&nbsp&nbsp&nbsp
											<input class="button" type="reset" value="重置"/>
										</div>
										<div class="clear"></div>
									</td>
								</tr>
							</tbody>
							
						</table>
						</form>
					</div> <!-- End #tab1 -->
					  
					
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->
			
			
			<!--
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/content_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			-->
			
			<div class="clear"></div>
			
			<!-- 自定义消息提示框，需要就打开
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/notic_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			 -->
			
			<!--页面底部-->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>










