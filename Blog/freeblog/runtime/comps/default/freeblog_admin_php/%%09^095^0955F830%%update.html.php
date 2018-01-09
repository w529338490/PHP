<?php /* Smarty version 2.6.18, created on 2012-02-17 11:20:52
         compiled from group/update.html */ ?>

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
									<td ><input type="hidden" value="<?php echo $this->_tpl_vars['gid']; ?>
" name="gid"></td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>用户组名<font color="red">*</font></td>
									<?php unset($this->_sections['ls']);
$this->_sections['ls']['name'] = 'ls';
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ls']['show'] = true;
$this->_sections['ls']['max'] = $this->_sections['ls']['loop'];
$this->_sections['ls']['step'] = 1;
$this->_sections['ls']['start'] = $this->_sections['ls']['step'] > 0 ? 0 : $this->_sections['ls']['loop']-1;
if ($this->_sections['ls']['show']) {
    $this->_sections['ls']['total'] = $this->_sections['ls']['loop'];
    if ($this->_sections['ls']['total'] == 0)
        $this->_sections['ls']['show'] = false;
} else
    $this->_sections['ls']['total'] = 0;
if ($this->_sections['ls']['show']):

            for ($this->_sections['ls']['index'] = $this->_sections['ls']['start'], $this->_sections['ls']['iteration'] = 1;
                 $this->_sections['ls']['iteration'] <= $this->_sections['ls']['total'];
                 $this->_sections['ls']['index'] += $this->_sections['ls']['step'], $this->_sections['ls']['iteration']++):
$this->_sections['ls']['rownum'] = $this->_sections['ls']['iteration'];
$this->_sections['ls']['index_prev'] = $this->_sections['ls']['index'] - $this->_sections['ls']['step'];
$this->_sections['ls']['index_next'] = $this->_sections['ls']['index'] + $this->_sections['ls']['step'];
$this->_sections['ls']['first']      = ($this->_sections['ls']['iteration'] == 1);
$this->_sections['ls']['last']       = ($this->_sections['ls']['iteration'] == $this->_sections['ls']['total']);
?>
									<td><input type="text" name="group_name" value="<?php echo $this->_tpl_vars['arr'][$this->_sections['ls']['index']]['group_name']; ?>
">(不能以特殊符号开头)</td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>用户组描述<font color="red">*</font></td>
									<td><textarea name="group_description"><?php echo $this->_tpl_vars['arr'][$this->_sections['ls']['index']]['group_description']; ?>
</textarea></td>
									
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>权限设置</td>
									<td>
									<?php if ($this->_tpl_vars['arr'][$this->_sections['ls']['index']]['group_muser'] == 1): ?>
									<input type="checkbox" name="group_muser"  value="1" checked>用户管理
									<?php else: ?>
									<input type="checkbox" name="group_muser" value="1" >用户管理
									<?php endif; ?>
									<?php if ($this->_tpl_vars['arr'][$this->_sections['ls']['index']]['group_mweb'] == 1): ?>
									<input type="checkbox" name="group_mweb" value="1" checked>网站编辑 
									<?php else: ?>
									<input type="checkbox" name="group_mweb" value="1">网站编辑 
									<?php endif; ?>
									<?php if ($this->_tpl_vars['arr'][$this->_sections['ls']['index']]['group_marticle'] == 1): ?>
									<input type="checkbox" name="group_marticle" value="1" checked>文章管理 
									<?php else: ?>
									<input type="checkbox" name="group_marticle" value="1">文章管理 
									<?php endif; ?>
									<?php if ($this->_tpl_vars['arr'][$this->_sections['ls']['index']]['group_mimage'] == 1): ?>
									<input type="checkbox" name="group_mimage" value="1" checked>图片管理
									<?php else: ?>
									<input type="checkbox" name="group_mimage" value="1">图片管理 
									<?php endif; ?>
									<?php if ($this->_tpl_vars['arr'][$this->_sections['ls']['index']]['group_sendarticle'] == 1): ?>
									<input type="checkbox" name="group_sendarticle" value="1" checked>发表文章 
									<?php else: ?>
									<input type="checkbox" name="group_sendarticle" value="1">发表文章 
									<?php endif; ?>
									<?php if ($this->_tpl_vars['arr'][$this->_sections['ls']['index']]['group_sendcomment'] == 1): ?>
									<input type="checkbox" name="group_sendcomment" value="1" checked>发表评论 
									<?php else: ?>
									<input type="checkbox" name="group_sendcomment" value="1">发表评论 
									<?php endif; ?>	
									<?php if ($this->_tpl_vars['arr'][$this->_sections['ls']['index']]['group_sendmessage'] == 1): ?>
									<input type="checkbox" name="group_sendmessage" value="1" checked>发站内信 
									<?php else: ?>
									<input type="checkbox" name="group_sendmessage" value="1">发站内信 
									<?php endif; ?>
									</td>
									<?php endfor; endif; ?>
								</tr>
								<tr >
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>
										<div class="bulk-actions align-left" >
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










