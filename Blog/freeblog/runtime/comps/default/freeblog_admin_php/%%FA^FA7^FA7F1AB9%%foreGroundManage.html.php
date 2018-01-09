<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:56
         compiled from WebManage/foreGroundManage.html */ ?>
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
					<h3>前台管理</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">前台管理</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				<div style='display:none;position:absolute;top:121%;left:50%;' id='locks'>
					<?php echo $this->_tpl_vars['buttons']; ?>

				</div> 
				<div class="content-box-content " >
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<table>
							<tbody>
								<tr><td colspan='3'><b style='font-size:20px;'>安全密码修改</b></td></tr>
								<form action='<?php echo $this->_tpl_vars['url']; ?>
/chOfPwd' method='post'>
									<tr><td>原密码：</td><td><input type='password' name='foreGround_OldOfPwd' style='width:400px;' onblur='vifyPwds()' id='oldPwd'><div id="vifyA" style='display:none;width:400px;background-color:#fffbcc'></div></td></tr>
									<tr><td>新密码：</td><td><input type='password' name='foreGround_NewOfPwdA' style='width:400px;' id='newPwdA' onblur='vifyPwdsType()'><div id="vifyC" style='display:none;width:400px;background-color:#fffbcc'></div></td></tr>
									<tr><td>再输一次：</td><td><input type='password' name='foreGround_NewOfPwdB' style='width:400px;' id='newPwdB' onblur='vifyNewPwds()'><div id="vifyB" style='display:none;width:400px;background-color:#fffbcc'></div></td></tr>
									<tr>
										<td colspan='3'><input type='submit' value='提交修改' class='button'/></td>
									</tr>
									<script>
										var oldPwds=document.getElementById('oldPwd');
										var newPwdA=document.getElementById('newPwdA');
										var newPwdB=document.getElementById('newPwdB');
										var vifyA=document.getElementById('vifyA');
										var vifyC=document.getElementById('vifyC');
										//检查旧密码是否和设置的吻合
										function vifyPwds(){
											Ajax().post("<?php echo $this->_tpl_vars['url']; ?>
/vifyPwd","oldPwds="+oldPwds.value,function(data){
												//alert(data);
												if(data == '1'){
													vifyA.style.display='block';
													vifyA.style.background='#95ad7c';
													vifyA.innerText='原安全密码输入正确';
												}else{
													vifyA.style.display='block';
													vifyA.style.background='#fffbcc';
													vifyA.innerText='原安全密码输入错误';
													//防止用户输错再次将值清空
													oldPwds.value='';
												}
											})
										}
										//检查输入密码的类型
										function vifyPwdsType(){
												var preg=/\d+/;
												if(preg.exec(newPwdA.value)){
													vifyC.style.display='block';
													vifyC.style.background='#95ad7c';
													vifyC.innerText='安全密码类型匹配';		
												}else{											
													vifyC.style.display='block';
													vifyC.style.background='#fffbcc';
													vifyC.innerText='安全密码必须是数字';
												}
										}
										
										//检查两次输入的新密码是否相同
										function vifyNewPwds(){
											var vifyB=document.getElementById('vifyB');
											if(newPwdA.value != newPwdB.value){
												vifyB.style.display='block';
												vifyB.style.background='#fffbcc';
												vifyB.innerText='两次输入的密码不同';
											}else{
												vifyB.style.display='block';
												vifyB.style.background='#95ad7c';
												vifyB.innerText='两次输入的密码相同';
											}
										}
									</script>
								</form>
						</table>
						<table>
							<tbody>
								<form action="<?php echo $this->_tpl_vars['url']; ?>
/saveDataBack" method='post'>
									<tr><td colspan='3'><hr /></td></tr>
									<tr><td colspan='3'><b style='font-size:20px;'>数据管理</b></td></tr>
									<tr>
										<?php if ($this->_tpl_vars['data']['saveuploaddata'] == '1'): ?>
											<td>
												是：<input type='radio' name='saveUploadData' value='1' checked='checked'/>&nbsp;&nbsp;&nbsp;&nbsp;
												否：<input type='radio' name='saveUploadData' value='0'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<input type='submit' value='确认修改' class='button'/>
												
											</td>
										<?php else: ?>
											<td>
												是：<input type='radio' name='saveUploadData' value='1'/>&nbsp;&nbsp;&nbsp;&nbsp;
												否：<input type='radio' name='saveUploadData' value='0' checked='checked'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<input type='submit' value='确认修改' class='button'/>										
											</td>
										<?php endif; ?>
										<td>
											<?php if ($this->_tpl_vars['data']['saveuploaddata'] == '1'): ?>
												<b>当前状态：</b>&nbsp;&nbsp;<image src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/tick_circle.png" />
											<?php else: ?>
												<b>当前状态：</b>&nbsp;&nbsp;<image src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_circle.png" />
											<?php endif; ?>
										</td>
									</tr>
								</form>
								<form action='<?php echo $this->_tpl_vars['url']; ?>
/saveOper' method='post'>
									<tr><td colspan='3'><hr /></td></tr>
									<tr><td colspan='3'><b style='font-size:20px;'>保留记录</b>&nbsp;&nbsp;<a href='../dataManage/operSet'>详细设置</a></td></tr>
									<tr>
										<?php if ($this->_tpl_vars['data']['operatenotes'] == '1'): ?>
											<td>
												是：<input type='radio' name='operateNotes' value='1' checked='checked'/>&nbsp;&nbsp;&nbsp;&nbsp;
												否：<input type='radio' name='operateNotes' value='0' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<input type='submit' value='确认修改' class='button'/>
												
											</td>
										<?php else: ?>
											<td>
												是：<input type='radio' name='operateNotes' value='1'/>&nbsp;&nbsp;&nbsp;&nbsp;
												否：<input type='radio' name='operateNotes' value='0' checked='checked'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<input type='submit' value='确认修改' class='button'/>										
											</td>
										<?php endif; ?>
										<td>
											<?php if ($this->_tpl_vars['data']['operatenotes'] == '1'): ?>
												<b>当前状态：</b>&nbsp;&nbsp;<image src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/tick_circle.png" />
											<?php else: ?>
												<b>当前状态：</b>&nbsp;&nbsp;<image src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_circle.png" />
											<?php endif; ?>
										</td>
									</tr>
								</form>
							<!--	<form action='<?php echo $this->_tpl_vars['url']; ?>
/changeWebState' method='post'>-->
									<tr><td colspan='3'><hr /></td></tr>
									<tr><td colspan='3'><b style='font-size:20px;'>网站状态</b></tr>
									<tr>
										<?php if ($this->_tpl_vars['data']['webstate'] == '1'): ?>
											<td id='stateB'>
												开启：<input type='radio' name='webState' value='1' checked='checked'/>&nbsp;&nbsp;&nbsp;&nbsp;
												关闭：<input type='radio' name='webState' value='0' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<button class='button' onclick='checkPwd()'>网站关闭</button>
												
											</td>
										<?php else: ?>
											<td id='stateB'>
												开启：<input type='radio' name='webState' value='1' />&nbsp;&nbsp;&nbsp;&nbsp;
												关闭：<input type='radio' name='webState' value='0' checked='checked'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<button class='button' onclick='checkPwd()'>网站开启</button>
											</td>
										<?php endif; ?>
										<td id='stateA'>
											<?php if ($this->_tpl_vars['data']['webstate'] == '1'): ?>
												<b>当前状态：</b>&nbsp;&nbsp;<image src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/tick_circle.png" />
											<?php else: ?>
												<b>当前状态：</b>&nbsp;&nbsp;<image src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_circle.png" />
											<?php endif; ?>
										</td>
									</tr>
								<!--</form>-->
								<script>
									var lockss=document.getElementById('locks');
								//显示或隐藏密码框
									function checkPwd(){
										if(lockss.style.display =='none'){
											lockss.style.display='block';
										}else{
											lockss.style.display='none';
										}
									}
									
									var pwd='';
									var vv=document.getElementById('pwdName');
									//每次获得点击的表单值组成一个字符串
									function checkPwds(value){
										//每次点击都给隐藏表单赋值
										vv.value+=value;
									}
									
									var stateA=document.getElementById('stateA');
									var stateB=document.getElementById('stateB');
									//用AJAX传递值如果安全密码相同那么将进行更改
									function vifyPwd(){
										var inputPwd=vv.value;
										Ajax().post("<?php echo $this->_tpl_vars['url']; ?>
/changeWebState","pwdNum="+inputPwd,function(data){	
											//隐藏密码框
											lockss.style.display='none';
											//alert(data);
											if(data !='2'){
												if(data !='1'){
													//更改状态
													stateA.innerHTML="<b>当前状态：</b>&nbsp;&nbsp;<image src='<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_circle.png' />"
													//更改按钮
													stateB.innerHTML="开启：<input type='radio' name='webState' value='1' />&nbsp;&nbsp;&nbsp;&nbsp;关闭：<input type='radio' name='webState' value='0' checked='checked'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class='button' onclick='checkPwd()'>网站开启</button>";
													alert('关闭，操作成功');
												}else{
													//更改状态
													stateA.innerHTML="<b>当前状态：</b>&nbsp;&nbsp;<image src='<?php echo $this->_tpl_vars['res']; ?>
/images/icons/tick_circle.png' />"
													//更改按钮
													stateB.innerHTML="开启：<input type='radio' name='webState' value='1' checked='checked'/>&nbsp;&nbsp;&nbsp;&nbsp;关闭：<input type='radio' name='webState' value='0' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class='button' onclick='checkPwd()'>网站关闭</button>";
													alert('开启，操作成功');
												}
											}else{
												alert('安全密码不匹配，请重试');
											}
										});
										//更改完成后将value的值清空，以备下次查询
										vv.value='';
									}
								</script>
							</tbody>
						</table>
						<table>
							<tbody>
								<tr><td colspan='3'><b style='font-size:20px;'>标题管理</b></td></tr>
								<form action="<?php echo $this->_tpl_vars['url']; ?>
/udpateForeGround" method='post'>
									<tr><td width='200'>网站标题:</td><td><input type='text' name='foreGround_title' value='<?php echo $this->_tpl_vars['data']['foreground_title']; ?>
' style='width:500px;' id='title'><td></tr>
									<tr>
										<td colspan='3'><input type='submit'value='提交修改' class='button' /></td>
									</tr>
								</form>	
								<form action="<?php echo $this->_tpl_vars['url']; ?>
/udpateForeGround" method='post'>
									<tr><td>副标题:</td><td><input type='text' name='foreGround_subtitle' value='<?php echo $this->_tpl_vars['data']['foreground_subtitle']; ?>
' style='width:500px;' id='subtitle'><td></tr>
									<tr>
										<td colspan='3'><input type='submit'value='提交修改' class='button' /></td>
									</tr>
								</form>	
								<form action="<?php echo $this->_tpl_vars['url']; ?>
/udpateForeGround" method='post'>
									<tr><td>管理员Email:</td><td><input type='text' name='foreGround_email' value='<?php echo $this->_tpl_vars['data']['foreground_email']; ?>
' style='width:500px;' id='email'><td></tr>
									<tr>
										<td colspan='3'><input type='submit'value='提交修改' class='button' /></td>
									</tr>
								</form>	
							</tbody>
						</table>
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