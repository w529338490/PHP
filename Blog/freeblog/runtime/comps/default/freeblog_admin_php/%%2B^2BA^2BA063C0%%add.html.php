<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:38
         compiled from group/add.html */ ?>

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
						<li><a href="#tab1" class="default-tab" >添加用户组</a></li> <!-- href must be unique and match the id of target div -->
						
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
/insert" method="post" id="frm">
						<table>	
							<tbody>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td width="300">用户组名<font color="red">*</font></td>
									<td><input type="text" name="group_name" id="ck_name" onfocus="ck_ns()" onblur="ck_n()">(不能以特殊符号开头)<div id="cname" style="display:none;width:150px"></div></td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>用户组描述<font color="red">*</font></td>
									<td width="300"><textarea name="group_description" onfocus="ck_tt()" onblur="ck_t()" id="tt"></textarea><div id="ctt" style="display:none;width:150px"></div></td>
								</tr>
								<tr>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>权限设置</td>
									<td width="800">
									<input type="checkbox" name="group_muser" value="1">用户管理  
									<input type="checkbox" name="group_mweb" value="1">网站编辑  
									<input type="checkbox" name="group_marticle" value="1">文章管理 
									<input type="checkbox" name="group_mimage" value="1">图片管理 
									<input type="checkbox" name="group_sendarticle" value="1">发表文章
									<input type="checkbox" name="group_sendcomment" value="1">发表评论  
									<input type="checkbox" name="group_sendmessage" value="1">发站内信 
									</td>
								</tr>
								<tr >
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td >&nbsp</td>
									<td>
										<div class="bulk-actions align-left" >
											<button class="button" id="subs" onclick="actions()">确定</button>
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
					  <script>
							var frm=document.getElementById('frm');
							var subs=document.getElementById('subs');
							var ck_name=document.getElementById('ck_name');
							var cname=document.getElementById('cname');
							var ctt=document.getElementById('tt');
							var ct=document.getElementById('ctt');
							var tflag=false;
							var nflag=false;
							

							function ck_tt(){
								ct.style.display="block";
								if(ctt.value.length<1){
									ct.style.background="#fffbcc";
									ct.innerHTML="描述不能为空";
								}else{
									ct.style.background="#fffbcc";
									ct.innerHTML="验证通过";
									tflag=true;
								}
							}
							function ck_t(){
								if(ctt.value.length<1){
									ct.style.background="#fffbcc";
									cname.innerHTML="描述不能为空";
								}else{
									ct.style.background="#fffbcc";
									ct.innerHTML="验证通过";
									tflag=true;
								}
							}


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

							function actions(){
								if(nflag==true && tflag==true){
									frm.submit();
								}else{
									ck_tt();
									ck_ns();
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










