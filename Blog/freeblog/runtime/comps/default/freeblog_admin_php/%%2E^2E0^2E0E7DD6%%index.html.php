<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:22
         compiled from user/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'user/index.html', 93, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p id="page-intro">Free Blog</p>
			<div>
					<span><a href="<?php echo $this->_tpl_vars['url']; ?>
/index">全部用户</a> (<?php echo $this->_tpl_vars['user_total']; ?>
)&nbsp; | &nbsp;<a href="<?php echo $this->_tpl_vars['url']; ?>
/index/n/h">活跃用户</a> (<?php echo $this->_tpl_vars['online']; ?>
)&nbsp; | &nbsp;<a href="<?php echo $this->_tpl_vars['url']; ?>
/index/n/uh">不稳定用户</a> (<?php echo $this->_tpl_vars['unonline']; ?>
)&nbsp; | &nbsp;<a href="<?php echo $this->_tpl_vars['url']; ?>
/index/n/l">屏蔽的用户</a> (<span id="lock_num"><?php echo $this->_tpl_vars['lock']; ?>
</span>) &nbsp;   </span><br/><br/>
					<form action="<?php echo $this->_tpl_vars['url']; ?>
/index" method="post">
					<span>
					<select name="gid">
						<option value="0">分组查看</option>
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
							<option value="<?php echo $this->_tpl_vars['grp'][$this->_sections['gls']['index']]['gid']; ?>
" ><?php echo $this->_tpl_vars['grp'][$this->_sections['gls']['index']]['group_name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>&nbsp;&nbsp;<input type="submit" class="button" value="提交" style="height:25px;width:50px" >
					</span>&nbsp;&nbsp;&nbsp;&nbsp;
					<span>
					<input type="text"  name="search_username">
					&nbsp;&nbsp;<input type="submit" class="button" value="搜索" style="height:25px;width:50px">
					</span>
				</form>
			</div>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>用户列表</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">用户列表</a></li> <!-- href must be unique and match the id of target div -->
					</ul>
					<div class="clear"></div>	
				</div> <!-- End .content-box-header -->
				<div class="content-box-content " >	
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->	
						<table>	
							<thead>
								<tr>
								   <th>选择</th>
								   <th>用户名</th>
								   <th>邮箱</th>
								   <th>创建时间</th>
								   <th>所属用户组</th>
								   <th>IP</th>
								   <th>权限</th>
								</tr>	
							</thead>
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
			<form action="<?php echo $this->_tpl_vars['url']; ?>
/del" method="post">	
			<a href="#" onclick="alls()" class="button">全选</a>&nbsp
			<a href="#" onclick="fans()" class="button">反选</a>&nbsp
	<input type="submit" value="删除?" name="sub" class="button" style="height:25px;width:58px" onclick="return confirm('确定要删除您选中的用户吗？')">
	<script>
		function alls(){
			var cks=document.getElementsByName('num[]');
			for(i=0;i<cks.length;i++){
				cks[i].checked=true;
			}
		}	
		function fans(){
			var cks=document.getElementsByName('num[]');
			for(i=0;i<cks.length;i++){
				if(cks[i].checked==true){
					cks[i].checked=false;
				}else{
					cks[i].checked=true;
				}
			}
		}
		function unalls(){
			var cks=document.getElementsByName('num[]');
			for(i=0;i<cks.length;i++){
				cks[i].checked=false;
			}
		}
	</script>
							
										</div>
										<div class="pagination">
											<?php echo $this->_tpl_vars['fpage']; ?>

										</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>	 
							<tbody>
							<?php unset($this->_sections['uls']);
$this->_sections['uls']['name'] = 'uls';
$this->_sections['uls']['loop'] = is_array($_loop=$this->_tpl_vars['user_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['uls']['show'] = true;
$this->_sections['uls']['max'] = $this->_sections['uls']['loop'];
$this->_sections['uls']['step'] = 1;
$this->_sections['uls']['start'] = $this->_sections['uls']['step'] > 0 ? 0 : $this->_sections['uls']['loop']-1;
if ($this->_sections['uls']['show']) {
    $this->_sections['uls']['total'] = $this->_sections['uls']['loop'];
    if ($this->_sections['uls']['total'] == 0)
        $this->_sections['uls']['show'] = false;
} else
    $this->_sections['uls']['total'] = 0;
if ($this->_sections['uls']['show']):

            for ($this->_sections['uls']['index'] = $this->_sections['uls']['start'], $this->_sections['uls']['iteration'] = 1;
                 $this->_sections['uls']['iteration'] <= $this->_sections['uls']['total'];
                 $this->_sections['uls']['index'] += $this->_sections['uls']['step'], $this->_sections['uls']['iteration']++):
$this->_sections['uls']['rownum'] = $this->_sections['uls']['iteration'];
$this->_sections['uls']['index_prev'] = $this->_sections['uls']['index'] - $this->_sections['uls']['step'];
$this->_sections['uls']['index_next'] = $this->_sections['uls']['index'] + $this->_sections['uls']['step'];
$this->_sections['uls']['first']      = ($this->_sections['uls']['iteration'] == 1);
$this->_sections['uls']['last']       = ($this->_sections['uls']['iteration'] == $this->_sections['uls']['total']);
?>
								<tr>
									<td><input type="checkbox" name="num[]" value="<?php echo $this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['uid']; ?>
"/></td>
									<td><?php echo $this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['user_username']; ?>
</td>
									<td><?php echo $this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['user_email']; ?>
</a></td>
									<td><?php echo ((is_array($_tmp=$this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['user_mktime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y年-%m月-%d日 %H:%M:%S") : smarty_modifier_date_format($_tmp, "%y年-%m月-%d日 %H:%M:%S")); ?>
</td>
									<td><?php echo $this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['group_name']; ?>
</td>
									<td><?php echo $this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['user_ip']; ?>
</td>
									<td>
										<!-- 小图标 -->
										 <a href="#" title="屏蔽" onclick="show(this)" id="<?php echo $this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['uid']; ?>
">
										 <?php if ($this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['user_lock']): ?>
										 <img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/pencil2.png" alt="屏蔽"   id="lock"/>
										 <?php else: ?>
										<img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/pencil3.png" alt="屏蔽"  id="lock"/>
										 <?php endif; ?>
										 </a>
										 <a href="<?php echo $this->_tpl_vars['url']; ?>
/del/uid/<?php echo $this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['uid']; ?>
/page/<?php echo $this->_tpl_vars['page']; ?>
" title="删除"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross.png" alt="删除" onclick="return confirm('确定要删除<?php echo $this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['user_username']; ?>
用户吗？')" ></a> 
										 <a href="<?php echo $this->_tpl_vars['url']; ?>
/update/gid/<?php echo $this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['gid']; ?>
/uid/<?php echo $this->_tpl_vars['user_list'][$this->_sections['uls']['index']]['uid']; ?>
/page/<?php echo $this->_tpl_vars['page']; ?>
" title="修改"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/hammer_screwdriver.png" alt="修改" /></a>
									</td>
								</tr>
							<?php endfor; endif; ?>
							</tbody>	
						</table>
						</form>	
					</div> 
					<script>
						var lock=document.getElementById('lock');
						var lock_num=document.getElementById('lock_num');
						function show(obj){
							Ajax().get('<?php echo $this->_tpl_vars['url']; ?>
/lock/uid/'+obj.id+'',function(date){
								lock_num.innerHTML=date;
								if($(obj).find("#lock").attr('src')=='/freeblog/admin/views/default/resource/images/icons/pencil3.png'){
									$(obj).find("#lock").attr('src','/freeblog/admin/views/default/resource/images/icons/pencil2.png');
									alert('屏蔽成功,该用户将无法登录网站');
								}else{
									$(obj).find("#lock").attr('src','/freeblog/admin/views/default/resource/images/icons/pencil3.png');
									alert('解锁成功,该用户将正常登录网站');
								}
								
							})
						}
					</script>		
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->		
			<div class="clear"></div>
			<!--页面底部-->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>





