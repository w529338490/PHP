<?php /* Smarty version 2.6.18, created on 2012-02-17 11:30:56
         compiled from image/mod.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p id="page-intro">Free Blog</p>
			<div>
					<a href="<?php echo $this->_tpl_vars['url']; ?>
/edit">返回图片列表</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['url']; ?>
/add">继续添加图片</a>
					
			</div>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>图片修改</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">图片修改</a></li> <!-- href must be unique and match the id of target div -->
					</ul>
					<div class="clear"></div>	
				</div> <!-- End .content-box-header -->
				<div class="content-box-content " >	
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->	
						
						<table >	
						<form action="<?php echo $this->_tpl_vars['url']; ?>
/update/pid/<?php echo $this->_tpl_vars['pid']; ?>
" method="post" enctype="multipart/form-data">
							
							<tr>
								<td width="200">&nbsp;</td>
								<td>
									<div style="height:169px;width:480px; ">
										<div style="float:left;width:300px;">
											<img src="<?php echo $this->_tpl_vars['root']; ?>
/public/uploads/th2_<?php echo $this->_tpl_vars['info']['name']; ?>
">
										</div>
										<div style="float:right;font-weight:bold;">
											图片标题:<?php echo $this->_tpl_vars['info']['title']; ?>
<br/><br/>
											文件类型:<?php echo $this->_tpl_vars['info']['mime']; ?>
<br/><br/>
											上传时间:<?php echo $this->_tpl_vars['info']['mktime']; ?>
<br/><br/>
											原始尺寸:<?php echo $this->_tpl_vars['info'][0]; ?>
&nbsp;x&nbsp;<?php echo $this->_tpl_vars['info'][1]; ?>
<br/><br/>
										</div>	
									</div>
								</td>
								
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>
									<div style="height:50px;width:420px;">
										<div style="float:left;font-weight:bold">更改所属相册</div>
										<div style="float:left;margin-left:70px;"><?php echo $this->_tpl_vars['select']; ?>
</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>
									<div style="height:50px;width:420px;">
										<div style="float:left;font-weight:bold">标题</div>
										<div style="float:right;"><input type="text" name="title" size="40" style="border:1px solid gray" value="<?php echo $this->_tpl_vars['info']['title']; ?>
"></div>
									</div>
								</td>
								
							</tr>
							
							<tr>
								<td>&nbsp;</td>
								<td>
									<div style="height:50px;width:420px;">
										<div style="float:left;font-weight:bold">描述</div>
										<div style="float:right;width:275px;"><textarea name="description" style="border:1px solid gray;margin:0xp;padding:0px;" ></textarea></div>
									</div>
								</td>
							
							</tr>
							

							<tr >
								<td>&nbsp;</td>
								<td>
									<div style="height:50px;width:470px;">
										<div style="float:left;font-weight:bold">文件上传路径</div>
										<div style="float:right;"><input type="text" name="title" size="47" style="border:1px solid gray;backgroud:gray;" value="<?php echo $this->_tpl_vars['root']; ?>
/public/uploads/<?php echo $this->_tpl_vars['info']['name']; ?>
" disabled></div>
									</div>
								</td>
							</tr >
						
							
			<!--
							<tr >
								<td>&nbsp;</td>
								<td>
									<div style="height:40px;width:420px;">
				<div style="float:left;font-weight:bold;margin-top:10px;">选择水印图片</div>
				<div style="float:left;margin-top:9px;margin-left:40px;height:15px;width:250px;"><input type="file" name="title"  style="border:1px solid gray;"></div>
									</div>
								</td>
							<tr >
								<td>&nbsp;</td>
								<td>
									<div style="height:50px;width:420px;">
										<div style="float:left;font-weight:bold">等比例缩放</div>
										<div style="float:right;margin-right:100px;">宽&nbsp;&nbsp;<input type="text" name="title" size="5" style="border:1px solid gray" name="width">&nbsp;&nbsp;高&nbsp;&nbsp;<input type="text" name="title" size="5" style="border:1px solid gray" name="height"></div>
									</div>
								</td>
							</tr>
							<tr >
								<td>&nbsp;</td>
									<td>
									<div style="height:50px;width:420px;">
										<div style="float:left;font-weight:bold">选择水印位置</div>
										<div style="float:left;margin-left:80px">
										顶部
										左<input type="radio" name="position" value="1" style="border:1px solid gray">
										中<input type="radio" name="position" value="2" style="border:1px solid gray">
										右<input type="radio" name="position" value="3" style="border:1px solid gray">
										<br/>
										中部
										左<input type="radio" name="position" value="4" style="border:1px solid gray">
										中<input type="radio" name="position" value="5" style="border:1px solid gray">
										右<input type="radio" name="position" value="6" style="border:1px solid gray">
										<br/>
										底部
										左<input type="radio" name="position" value="7" style="border:1px solid gray">
										中<input type="radio" name="position" value="8" style="border:1px solid gray">
										右<input type="radio" name="position" value="9" style="border:1px solid gray">
										</div>
									</div>
								</td>
							</tr>
					-->

							
							<tr>
								<td>&nbsp;</td>
								<td>
								<div style="margin-left:150px;margin-top:20px;">
								<input type="submit" value="提交" class="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="重置" class="button"></td>
								</div>
							</tr>

						</form>
						</table>
						<script>
							function show(){
								var s=document.getElementById('show');
									s.style.display="block";
							}
						</script>
						
					</div> <!-- E			
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->		
			<div class="clear"></div>
			<!--页面底部-->
				<div id="messages" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
				<h3>3 Messages</h3>
				<p>
					<strong>17th May 2009</strong> by Admin<br />
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue.
					<small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
				</p>
				<p>
					<strong>2nd May 2009</strong> by Jane Doe<br />
					Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.
					<small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
				</p>
				<p>
					<strong>25th April 2009</strong> by Admin<br />
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue.
					<small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
				</p>
				<form action="#" method="post">
					<h4>New Message</h4>
					<fieldset>
						<textarea class="textarea" name="textfield" cols="79" rows="5"></textarea>
					</fieldset>
					<fieldset>
						<select name="dropdown" class="small-input">
							<option value="option1">Send to...</option>
							<option value="option2">Everyone</option>
							<option value="option3">Admin</option>
							<option value="option4">Jane Doe</option>
						</select>
						<input class="button" type="submit" value="Send" />
					</fieldset>	
				</form>
			</div> <!-- End #messages -->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>





