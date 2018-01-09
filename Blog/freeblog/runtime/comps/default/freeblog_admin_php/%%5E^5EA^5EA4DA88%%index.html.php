<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:35
         compiled from group/index.html */ ?>

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
					
					<h3>用户组列表</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">用户组列表</a></li> <!-- href must be unique and match the id of target div -->
						
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">	
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<table>
						<thead>
							<tr>
							<th width="85">用户组名称</th>
							<th>用户组描述</th>
							<th>用户权限</th>
							<th>操作</th>
							</tr>
						</thead>
							<?php unset($this->_sections['ls']);
$this->_sections['ls']['name'] = 'ls';
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['groupinfo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<tr >
								<td ><?php echo $this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['group_name']; ?>
</td>
								<td width="270"><?php echo $this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['group_description']; ?>
</td>
								<td width="568">
								用户管理
								<?php if ($this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['group_muser'] == 1): ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/tick_circle.png">
								<?php else: ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_circle.png">
								<?php endif; ?>
								网站编辑
								<?php if ($this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['group_mweb'] == 1): ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/tick_circle.png">
								<?php else: ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_circle.png">
								<?php endif; ?>
								文章管理
								<?php if ($this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['group_marticle'] == 1): ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/tick_circle.png">
								<?php else: ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_circle.png">
								<?php endif; ?>
								
								图片管理
								<?php if ($this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['group_mimage'] == 1): ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/tick_circle.png">
								<?php else: ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_circle.png">
								<?php endif; ?>
								
								发表文章
								<?php if ($this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['group_sendarticle'] == 1): ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/tick_circle.png">
								<?php else: ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_circle.png">
								<?php endif; ?>

								发表评论
								<?php if ($this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['group_sendcomment'] == 1): ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/tick_circle.png">
								<?php else: ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_circle.png">
								<?php endif; ?>
								发站内信
								<?php if ($this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['group_sendmessage'] == 1): ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/tick_circle.png">
								<?php else: ?>
									<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_circle.png">
								<?php endif; ?>
								</td>
								<td width="70"><a href="<?php echo $this->_tpl_vars['app']; ?>
/group/update/gid/<?php echo $this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['gid']; ?>
">修改</a>&nbsp;|&nbsp;
								<?php if ($this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['gid'] != 1 && $this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['gid'] != 2): ?>
								<a href="<?php echo $this->_tpl_vars['app']; ?>
/group/del/gid/<?php echo $this->_tpl_vars['groupinfo'][$this->_sections['ls']['index']]['gid']; ?>
">删除</a></td>
								<?php endif; ?>
							</tr>
							<?php endfor; endif; ?>
						</table>
						
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










