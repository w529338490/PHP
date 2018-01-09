<?php /* Smarty version 2.6.18, created on 2012-02-02 17:34:18
         compiled from user/update.html */ ?>
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
					<h3>添加用户</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">添加用户</a></li> <!-- href must be unique and match the id of target div -->
					</ul>
					<div class="clear"></div>	
				</div> <!-- End .content-box-header -->
				<div class="content-box-content " >	
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->	
						<form action="<?php echo $this->_tpl_vars['url']; ?>
/exe_update/page/<?php echo $this->_tpl_vars['page']; ?>
" method="post" name="f">
						<table>	
							<tr>
								<td><b>所属用户组</b></td>
								<td>
									<select name="gid">
										<option value=''>选择用户组</option>
										<?php unset($this->_sections['gls']);
$this->_sections['gls']['name'] = 'gls';
$this->_sections['gls']['loop'] = is_array($_loop=$this->_tpl_vars['grp']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['gls']['show'] = true;
$this->_sections['gls']['max'] = $this->_sections['gls']['loop'];
$this->_sections['gls']['step'] = 1;
$this->_sections['gls']['start'] = $this->_sections['gls']['step'] > 0 ? 0 : $this->_sections['gls']['loop']-1;
if ($this->_sections['gls']['show']) {
    $this->_sections['gls']['total'] = $this->_sections['gls']['loop'];
    if ($this->_sections['gls']['total'] == 0)
        $this->_sections['gls']['show'] = false;
} else
    $this->_sections['gls']['total'] = 0;
if ($this->_sections['gls']['show']):

            for ($this->_sections['gls']['index'] = $this->_sections['gls']['start'], $this->_sections['gls']['iteration'] = 1;
                 $this->_sections['gls']['iteration'] <= $this->_sections['gls']['total'];
                 $this->_sections['gls']['index'] += $this->_sections['gls']['step'], $this->_sections['gls']['iteration']++):
$this->_sections['gls']['rownum'] = $this->_sections['gls']['iteration'];
$this->_sections['gls']['index_prev'] = $this->_sections['gls']['index'] - $this->_sections['gls']['step'];
$this->_sections['gls']['index_next'] = $this->_sections['gls']['index'] + $this->_sections['gls']['step'];
$this->_sections['gls']['first']      = ($this->_sections['gls']['iteration'] == 1);
$this->_sections['gls']['last']       = ($this->_sections['gls']['iteration'] == $this->_sections['gls']['total']);
?>
											<?php if ($this->_tpl_vars['grp'][$this->_sections['gls']['index']]['gid'] == $this->_tpl_vars['fgid']): ?>
											<option value="<?php echo $this->_tpl_vars['grp'][$this->_sections['gls']['index']]['gid']; ?>
" selected><?php echo $this->_tpl_vars['grp'][$this->_sections['gls']['index']]['group_name']; ?>
</option>
											<?php else: ?>
											<option value="<?php echo $this->_tpl_vars['grp'][$this->_sections['gls']['index']]['gid']; ?>
" ><?php echo $this->_tpl_vars['grp'][$this->_sections['gls']['index']]['group_name']; ?>
</option>
											<?php endif; ?>
										<?php endfor; endif; ?>
									</select>
								</td>
							</tr>
							<tr>
								<td><b>用户名</b></td><td><input type="text" name="user_username" onfocus="ckform()" value="<?php echo $this->_tpl_vars['date'][0]['user_username']; ?>
"></td>
							</tr>
							<tr>
								<td><b>密码</b></td><td><input type="password" name="user_password"></td>
							</tr>
							<tr>
								<td><b>重复密码</b></td><td><input type="password" name="user_repassword"></td>
							</tr>
							<tr>
								<td><b>邮箱</b></td><td><input type="text" name="user_email" value="<?php echo $this->_tpl_vars['date'][0]['user_email']; ?>
"></td>
							</tr>
							<tr>
								<td><b>性别</b></td>
								<td>
								<?php if ($this->_tpl_vars['date'][0]['user_sex'] == 1): ?>
									<input type="radio" name="user_sex" value="1" checked/>男
									<input type="radio" name="user_sex" value="2" />女
									<input type="radio" name="user_sex" value="3" />保密
								<?php elseif ($this->_tpl_vars['date'][0]['user_sex'] == 0): ?>
									<input type="radio" name="user_sex" value="1"/>男
									<input type="radio" name="user_sex" value="2" checked/>女
									<input type="radio" name="user_sex" value="3" />保密
								<?php elseif ($this->_tpl_vars['date'][0]['user_sex'] == 2): ?>
									<input type="radio" name="user_sex" value="1"/>男
									<input type="radio" name="user_sex" value="2"/>女
									<input type="radio" name="user_sex" value="3" checked/>保密
								<?php endif; ?>
								</td>
							</tr>
							<tr>
								<td>&nbsp;<input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['date'][0]['uid']; ?>
"></td><td><input type="submit" class="button" value="提交">&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="reset" value="重置" class="button"></td>
							</tr>
						</table>
						</form>	
						<script>
							
						
						</script>
					</div> <!-- E			
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->		
			<div class="clear"></div>
			<!--页面底部-->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>





