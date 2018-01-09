<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:51
         compiled from image/add.html */ ?>

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
			<div>
					<a href="<?php echo $this->_tpl_vars['url']; ?>
/edit">返回图片列表</a>&nbsp;&nbsp;&nbsp;
				
			</div>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					
					<h3>上传图片</h3>

					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">上传图片</a></li> <!-- href must be unique and match the id of target div -->			
					</ul>
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">	
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->			
				<div class="notification attention png_bg">
				<a href="#" class="close"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_grey_small.png" title="关闭友情提醒" alt="关闭" /></a>
				<div>
					友情提醒：添加图片时，请别忘记选择<font color="red">相册</font>和输入<font color="red">图片标题</font> ^_^ ~~
				</div>
				</div>
					<form action="<?php echo $this->_tpl_vars['url']; ?>
/insert" method="post" enctype="multipart/form-data">
						<table>	
								
						<tr>
							<td ></td>
							<td>
							<span class="col_width">选择相册<font color="red">*</font></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['select']; ?>

							</td>
						</tr>
						<tr>
							<td ></td>
							<td>
							图片标题<font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title[]">
							</td>
						</tr>
						<tr>
							<td ></td>
							<td>
							<span class="col_width" style="float:left;">上传图片<font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<span id="apic" style="float:left !important;float:none;width:300px;">
							<input type="file" name="pic[]" onchange="show()" id="pic">				
							</span>
							</td>
							<script>
								function show(){//图片预览js未完成
									var img=document.getElementById('pic');
									var shows=document.getElementById('shows');
									//alert(img.value);
									//alert(shows.src);	
								}
							</script>
						</tr>
						<tr>
							<td ></td>
							<td>
							<span class="col_width">&nbsp; </span>
							&nbsp;<a href="javascript:addpic()">继续添加</a>&nbsp;<b>↓</b>
							<span id="del" style="display:none">&nbsp;&nbsp;<a href="javascript:delpic()">减少一个</a>&nbsp;<b>↑</b></span>
							</td>
						</tr>
						<tr>
							<td ></td>
							<td>
						<span class="col_width">&nbsp;</span><button type="submit" class="button">添 加</button>&nbsp;&nbsp;
						<button type="reset" class="button" >重 置</button>
							</td>
						</tr>	
						</table>
						</form>
					</div> <!-- End #tab1 -->
					  
					<script>
						var picobj=document.getElementById("apic");
						var del=document.getElementById("del");
						var i=0;
						function addpic(){
							i++;
							if(i==1)
								del.style.display="inline";   										

							var file=document.createElement("input");
							file.type="file";
							file.name="pic[]";
							
							var ti=document.createElement("input");
							ti.type="text";
							ti.name="title[]";
							ti.value="标题....";
							ti.style.border="1px solid gray";
							ti.style.marginTop="10px";
							ti.style.marginBottom="10px";
							ti.size="16";
							var br=document.createElement("br");
							picobj.appendChild(ti);
							picobj.appendChild(br);
							picobj.appendChild(file);	
						}
						function delpic(){
							i--;
							if(i==0)
								del.style.display="none";   
							picobj.removeChild(picobj.lastChild);
							picobj.removeChild(picobj.lastChild);
							picobj.removeChild(picobj.lastChild);
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










