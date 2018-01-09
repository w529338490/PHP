<?php /* Smarty version 2.6.18, created on 2012-02-02 17:22:51
         compiled from flink/add.html */ ?>

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
					
					<h3>添加链接</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">添加链接</a></li> <!-- href must be unique and match the id of target div -->
						
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
/insert" method="post" id="frm" enctype="multipart/form-data">
						<table>	
							<tbody>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td width="350">网站名字<font color="red">*</font></td>
									<td><input type="text" name="link_name" id="link_name" onfocus="ckname()" onblur="ckn()"><div id="webname" style="display:none"><div></td>
									<td >&nbsp</td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>链接地址<font color="red">*</font></td>
									<td ><input type="text" name="link_url" id="urls" onfocus="ckus()" onblur="ckurls()"><div>例如：http://www.freeblog.com</div><div id="ck_url" style="display:none"></div></td>
									<td >&nbsp</td>
								</tr>
								
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>链接描述<font color="red">*</font></td>
									<td width="300"><textarea name="link_description" id="d" onfocus="ckd()" onblur="ckdes()"></textarea><div id="des" style="display:none"></div></td>
									<td width="400"></td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>链接远程logo图片<font color="red">*</font></td>
									<td><input type="text" name="link_image" id="link_image" onfocus="ckyc()" onblur="ckycs()">&nbsp;&nbsp;<div>远程logo图片会自动下载到本地</div><div id="ycurl" style="display:none"></div></td>
									<td >&nbsp</td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>原图尺寸保存<font color="red">*</font></td>
									<td>
									<input type="radio" name="pic_change" value="0" checked id="one" onclick="none()">原图&nbsp;&nbsp;&nbsp;
									<input type="radio" onclick="clicks()" id="two" value="1" name="pic_change">等比例缩放</input>
									<div id="size" style="display:none;margin-top:6px;">
										宽：<input type="text" name="width" size="3">
										高：<input type="text" name="height" size="3">
									</div></td>
									<td >&nbsp</td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>链接打开方式<font color="red">*</font></td>
									<td><input type="radio" name="link_target" value="_blank" checked>在新窗口打开<input type="radio" name="link_target" value="_top">在当前窗口打开</td>
									<td >&nbsp</td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>链接显示状态<font color="red">*</font></td>
									<td><input type="radio" name="disable" value="1" checked >显示<input type="radio" name="disable" value="0">不显示</td>
									<td >&nbsp</td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>联系人<font color="red">*</font></td>
									<td><input type="text" name="link_body" id="c" onfocus="ckc()" onblur="ckcn()"><div id="connect" style="display:none"></div></td>
									<td >&nbsp</td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>站长email<font color="red">*</font></td>
									<td><input type="text" name="link_body_email" id="email" onfocus="ckemail()" onblur="cke()"><div id="show_email" ></div></td>
									<td >&nbsp</td>
								</tr>
								<tr >
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>
										<div class="bulk-actions align-left" >
											<input class="button" type="button" id="subs" onclick="ation()" value="确定">
											&nbsp&nbsp&nbsp
											<input class="button" type="reset" value="重置"/>
										</div>
										<div class="clear"></div>
									</td>
									<td>&nbsp</td>
								</tr>
							</tbody>
							
						</table>
						</form>
					</div> <!-- End #tab1 -->
					  <script>
					  var frm=document.getElementById('frm');
					  var ths=document.getElementById('one');
					  var div=document.getElementById('size');
					  var two=document.getElementById('two');
						function clicks(){
							if(div.style.display=="none"){
								ths.checked=false;
								two.checked=true;
								div.style.display="block";
							}else{
								ths.checked=true;
								two.checked=false;
								ths.checked=true;
								div.style.display="none";
							}
						}
						function none(){
								two.checked=false;
								div.style.display="none";
						}
						//以下是js验证
						var flag1=false;
						var flag2=false;
						var flag3=false;
						var flag4=false;
						var flag5=false;
						var flag6=false;
						var name=document.getElementById('link_name');//链接名字
						var webname=document.getElementById('webname');
						function ckname(){
							if(name.value.length<1){
								webname.style.display="block";
								webname.style.background="#fffbcc";
								webname.style.width="155px";
								webname.innerHTML="请输入网站名";
								flag1=false;
							}else{
								webname.style.width="155px";
								webname.style.background="#fffbcc";
								webname.innerHTML='验证通过..';
								flag1=true;
							}
						}
						function ckn(){
							if(name.value.length<1){
								webname.style.display="block";
								webname.style.background="#fffbcc";
								webname.style.width="155px";
								webname.innerHTML="请输入网站名";
								flag1=false;
							}else{
								webname.style.width="155px";
								webname.style.background="#fffbcc";
								webname.innerHTML='验证通过..';	
								flag1=true;
							}
						}
						var urls=document.getElementById('urls');		//链接远程地址
						var ck_url=document.getElementById('ck_url');
						var urlzz=/http:\/\/([a-zA-Z0-9-]+\.){2,8}/;
						function ckus(){
							if(urls.value.length<1){
								ck_url.style.display="block";
								ck_url.style.background="#fffbcc";
								ck_url.style.width="155px";
								ck_url.innerHTML="请输入网站名";
								flag2=false;
							}else{
								if(!urlzz.exec(urls.value)){
									ck_url.style.display="block";
									ck_url.style.background="#fffbcc";
									ck_url.style.width="155px";
									ck_url.innerHTML="url地址不合法";
									flag2=false;
								}else{
									ck_url.style.width="155px";
									ck_url.style.background="#fffbcc";
									ck_url.innerHTML='验证通过..';	
									flag2=true;
								}	
							}
						}
						function ckurls(){
							if(!urlzz.exec(urls.value)){
								ck_url.style.display="block";
								ck_url.style.background="#fffbcc";
								ck_url.style.width="155px";
								ck_url.innerHTML="url地址不合法";
								flag2=false;
							}else{
								ck_url.style.width="155px";
								ck_url.style.background="#fffbcc";
								ck_url.innerHTML='验证通过..';	
								flag2=true;
							}
						}
						var d=document.getElementById('d');			//描述验证
						var des=document.getElementById('des');
						function ckd(){
							if(d.value.length<1){
								des.style.display="block";
								des.style.background="#fffbcc";
								des.style.width="200px";
								des.innerHTML="请输入链接描述";
								flag3=false;
							}else{
								des.style.width="200px";
								des.style.background="#fffbcc";
								des.innerHTML='链接描述,将会在鼠标放在链接上显示';	
								flag3=true;
							}
						}
						function ckdes(){
							if(d.value.length<1){
								des.style.display="block";
								des.style.background="#fffbcc";
								des.style.width="200px";
								des.innerHTML="请输入链接描述";
								flag3=false;
							}else{
								des.style.width="200px";
								des.style.background="#fffbcc";
								des.innerHTML='链接描述,将会在鼠标放在链接上显示';
								flag3=true;
							}
						}
						var link_image=document.getElementById('link_image');	//远程logo链接图片
						var ycurl=document.getElementById('ycurl');	
						function ckyc(){
							if(link_image.value.length<1){
								ycurl.style.display="block";
								ycurl.style.background="#fffbcc";
								ycurl.style.width="155px";
								ycurl.innerHTML="请输入远程logo路径";
								flag4=false;
							}else{
								if(!urlzz.exec(link_image.value)){
									ycurl.style.display="block";
									ycurl.style.background="#fffbcc";
									ycurl.style.width="155px";
									ycurl.innerHTML="url地址不合法";
									flag4=false;
								}else{
									ycurl.style.width="155px";
									ycurl.style.background="#fffbcc";
									ycurl.innerHTML='验证通过..';
									flag4=true;
								}	
							}
						}
						function ckycs(){
							if(!urlzz.exec(link_image.value)){
								ycurl.style.display="block";
								ycurl.style.background="#fffbcc";
								ycurl.style.width="155px";
								ycurl.innerHTML="url地址不合法";
								flag4=false;
							}else{
								ycurl.style.width="155px";
								ycurl.style.background="#fffbcc";
								ycurl.innerHTML='验证通过..';
								flag4=true;
							}
						}
						var c=document.getElementById('c');				//联系人验证
						var connect=document.getElementById('connect');
						function ckc(){
							if(c.value.length<1){
								connect.style.display="block";
								connect.style.background="#fffbcc";
								connect.style.width="155px";
								connect.innerHTML="请输入联系人";
								flag5=false;
							}else{
								connect.style.width="155px";
								connect.style.background="#fffbcc";
								connect.innerHTML='验证通过..';	
								flag5=true;
							}
						}
						function ckcn(){
							if(c.value.length<1){
								connect.style.display="block";
								connect.style.background="#fffbcc";
								connect.style.width="155px";
								connect.innerHTML="请输入联系人";
								flag5=false;
							}else{
								connect.style.width="155px";
								connect.style.background="#fffbcc";
								connect.innerHTML='验证通过..';	
								flag5=true;
							}
						}
						var zz=/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+\.[a-zA-Z0-9_-]+/;//邮箱验证
						var email=document.getElementById('email');
						var show_email=document.getElementById('show_email');
						function ckemail(){
								if(email.value.length==0){
								show_email.style.width="155px";
								show_email.style.background="#fffbcc";
								show_email.innerHTML='请输入邮箱';
								flag6=false;
								}else{
									if(!zz.exec(email.value)){
									show_email.style.width="155px";
									show_email.style.background="#fffbcc";
									show_email.innerHTML='邮箱格式不正确';
									flag6=false;
									}else{
									show_email.style.width="155px";
									show_email.style.background="#fffbcc";
									show_email.innerHTML='验证通过';
									flag6=true;
									}
								}
							}
							function cke(){
								if(email.value.length==0){
									show_email.style.width="155px";
									show_email.style.background="#fffbcc";
									show_email.innerHTML='邮箱不能为空';
									flag6=false;
								}
								if(!zz.exec(email.value)){
									show_email.style.width="155px";
									show_email.style.background="#fffbcc";
									show_email.innerHTML='邮箱格式不正确';
									flag6=false;
								}else{
									show_email.style.width="155px";
									show_email.style.background="#fffbcc";
									show_email.innerHTML='验证通过';
									flag6=true;
								}
							}
						function ation(){
							if(flag1 && flag2 && flag3 && flag4 && flag5 && flag6){	
								frm.submit();	
							}else{
								ckn();
								ckus();
								ckdes();
								ckycs();
								ckcn();
								cke();


							}
						}
					  </script>
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










