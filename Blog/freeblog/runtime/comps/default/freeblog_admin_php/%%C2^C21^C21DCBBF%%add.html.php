<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:23
         compiled from user/add.html */ ?>
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
/insert" method="post" enctype="multipart/form-data"  id="frm">
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
											<option value="<?php echo $this->_tpl_vars['grp'][$this->_sections['gls']['index']]['gid']; ?>
"><?php echo $this->_tpl_vars['grp'][$this->_sections['gls']['index']]['group_name']; ?>
</option>
										<?php endfor; endif; ?>
									</select>
								</td>
							</tr>
							<tr>
								<td><b>用户名</b></td><td><input type="text" name="user_username"  id="ck_name" onfocus="ck_ns()" onblur="ck_n()"><div id="cname" style="display:none;width:150px"></div></td>
							</tr>
							<tr>
								<td><b>密码</b></td><td><input type="password" name="user_password" id="ck_pass" onfocus="ck_ps()" onblur="ck_p()"><div id="cpass" style="display:none;width:150px"></div></td>
							</tr>
							<tr>
								<td><b>重复密码</b></td><td><input type="password" name="user_repassword" id="ck_repass" onfocus="ck_reps()" onblur="ck_re()"><div id="crepass" style="display:none;width:150px" ></div></td>
							</tr>
							<tr>
								<td><b>邮箱</b></td><td><input type="text" name="user_email" id="ck_email" onfocus="ck_es()" onblur="ck_e()"><div id="cemail" style="display:none;width:150px"></div></td>
							</tr>
							<tr>
								<td><b>性别</b></td><td><input type="radio" name="user_sex" value="1">男<input type="radio" name="user_sex" value="0">女<input type="radio" name="user_sex" value="2" checked>保密</td>
							</tr>
							<tr>
								<td>&nbsp;</td><td><button  class="button"  onsubmit="actions()" id="subs" onclick="actions()">提交</button>&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="reset" value="重置" class="button" ></td>
							</tr>
						</table>
						</form>	
						<script>
							var frm=document.getElementById('frm');
							var subs=document.getElementById('subs');
							var ck_name=document.getElementById('ck_name');
							var cname=document.getElementById('cname');
							
							var ck_pass=document.getElementById('ck_pass');
							var cpass=document.getElementById('cpass');
							
							var ck_repass=document.getElementById('ck_repass');
							var crepass=document.getElementById('crepass');
							var zz=/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+\.[a-zA-Z0-9_-]+/;//邮箱验证
							var ck_email=document.getElementById('ck_email');
							var cemail=document.getElementById('cemail');
							var nflag=false;
							var pflag=false;
							var repflag=false;
							var eflag=false;
							function ck_ns(){
								cname.style.display="block";
								if(ck_name.value.length<1){
									cname.style.background="#fffbcc";
									cname.innerHTML="用户名不能为空";
								}else{
									cname.style.background="#fffbcc";
									cname.innerHTML="验证通过";
									nflag=true;
								}
							}
							function ck_n(){
								if(ck_name.value.length<1){
									cname.style.background="#fffbcc";
									cname.innerHTML="用户名不能为空";
								}else{
									cname.style.background="#fffbcc";
									cname.innerHTML="验证通过";
									nflag=true;
								}
							}
							
							function ck_ps(){
								cpass.style.display="block";
								if(ck_pass.value.length<6){
									cpass.style.background="#fffbcc";
									cpass.innerHTML="密码需为6位数以上";
								}else{
									cpass.style.background="#fffbcc";
									cpass.innerHTML="验证通过";
									pflag=true;
								}
							}
							function ck_p(){
								if(ck_pass.value.length<6){
									cpass.style.background="#fffbcc";
									cpass.innerHTML="密码长度不够";
								}else{
									cpass.style.background="#fffbcc";
									cpass.innerHTML="验证通过";
									pflag=true;
								}
								
							}

							function ck_reps(){
								crepass.style.display="block";
								if(ck_repass.value.length<1){
									crepass.style.background="#fffbcc";
									crepass.innerHTML="请输入重复密码";
								}else{
								if(ck_repass.value!=ck_pass.value){
									crepass.style.background="#fffbcc";
									crepass.innerHTML="两次密码不一致";
								}else{
									crepass.style.background="#fffbcc";
									crepass.innerHTML="验证通过";
									repflag=true;
								}
								}
							}
							function ck_re(){
								if(ck_repass.value.length<1){
									crepass.style.background="#fffbcc";
									crepass.innerHTML="请输入重复密码";
								}else{
								if(ck_repass.value!=ck_pass.value){
									crepass.style.background="#fffbcc";
									crepass.innerHTML="两次密码不一致";
								}else{
									crepass.style.background="#fffbcc";
									crepass.innerHTML="验证通过";
									repflag=true;
								}
								}
							}
							
							function ck_es(){
								cemail.style.display="block";
								if(ck_email.value.length<1){
									cemail.style.background="#fffbcc";
									cemail.innerHTML="邮箱不能为空";
									eflag=true;
									
								}else{
									if(!zz.exec(ck_email.value)){
										cemail.style.background="#fffbcc";
										cemail.innerHTML="邮箱地址不合法";
									}else{
										cemail.style.background="#fffbcc";
										cemail.innerHTML="验证通过";
										eflag=true;
									}
								}
							}
							function ck_e(){
								if(!zz.exec(ck_email.value)){
									cemail.style.background="#fffbcc";
									cemail.innerHTML="邮箱地址不合法";
								}else{
									cemail.style.background="#fffbcc";
									cemail.innerHTML="验证通过";
									eflag=true;
								}
								
							}
							function actions(){
								if(nflag==true && pflag==true && repflag==true && eflag==true){
									frm.submit();
								}else{
									ck_ns();
									ck_ps();
									ck_reps();
									ck_es();
								}
								//frm.submit();
								
								
							}
						</script>
					</div> 		
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->		
			<div class="clear"></div>
			<!--页面底部-->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>





