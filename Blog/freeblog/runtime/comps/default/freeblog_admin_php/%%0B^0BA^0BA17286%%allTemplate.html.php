<?php /* Smarty version 2.6.18, created on 2012-02-02 17:20:13
         compiled from templateManage/allTemplate.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p id="page-intro">Free Blog</p>
			<script>
				function show(id){
					document.getElementById(id).style.display="block";
				}
				function noshow(id){
					document.getElementById(id).style.display="none";
				}
			</script>
			<div>
				<span>模板总数(<?php echo $this->_tpl_vars['templateAll']; ?>
)&nbsp; | &nbsp;自定义模板数(<?php echo $this->_tpl_vars['templateNum']; ?>
)</span>
			</div>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>模板管理</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">模板管理</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content " >
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<table>
							<thead>
							</thead>
							<tfoot>
								<tr>
									<td colspan='2'>
										<form action='<?php echo $this->_tpl_vars['url']; ?>
/uploadsTemplate' method='post' enctype="multipart/form-data">
										<!--<form action='<?php echo $this->_tpl_vars['url']; ?>
/uploadsTemplate' method='post'>-->
											<input type='file' name='temUpload'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type='submit' value='上传模板' class='button'/>
										</form>
									</td>
								</tr>
								<tr>
									<td colspan='2'>
										<hr />
									</td>
								</tr>
								<tr>
									<td>默认模板1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onclick='changeTem("default")'>启用</a>&nbsp;&nbsp;</div></td>
									<td rowspan='2'>
										<b>模板简介:</b><br /><br />
										该模板让您的blog有绚丽的风格。
									</td>
								</tr>
								<tr>
									<td><img src='<?php echo $this->_tpl_vars['root']; ?>
/home/views/default/resource/them.png' /></td>
								</tr>
								<!--分配自定义模板-->
								<?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['template']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
									<tr>
										<td colspan='2'>
											<hr />
										</td>
									</tr>
									<div style='display:none;position:absolute;right:200px;top:500px;' id='<?php echo $this->_tpl_vars['template'][$this->_sections['l']['index']]['name']; ?>
'>
										<img src="<?php echo $this->_tpl_vars['template'][$this->_sections['l']['index']]['images']; ?>
"/>
									</div>
									<tr>
										<td><?php echo $this->_tpl_vars['template'][$this->_sections['l']['index']]['name']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onclick='changeTem("<?php echo $this->_tpl_vars['template'][$this->_sections['l']['index']]['name']; ?>
")'>启用</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='<?php echo $this->_tpl_vars['url']; ?>
/templateNam/tempName/<?php echo $this->_tpl_vars['template'][$this->_sections['l']['index']]['name']; ?>
' onclick='return confirm("您确定要删除 <?php echo $this->_tpl_vars['template'][$this->_sections['l']['index']]['name']; ?>
 ?")'>删除</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onmouseover="show('<?php echo $this->_tpl_vars['template'][$this->_sections['l']['index']]['name']; ?>
')" onmouseout="noshow('<?php echo $this->_tpl_vars['template'][$this->_sections['l']['index']]['name']; ?>
')">预览</a></div></td>
										
										<td rowspan='2'>
											<b>模板简介:</b><br /><br />
											<?php echo $this->_tpl_vars['template'][$this->_sections['l']['index']]['note']; ?>

										</td>
									</td>
									
									</tr>
									<tr>
										<td><img src="<?php echo $this->_tpl_vars['template'][$this->_sections['l']['index']]['image']; ?>
"/></td>
									</tr>
								<?php endfor; endif; ?>
							</tfoot>
							<tbody>
								<script>
									function changeTem(TemName){
										Ajax().post('<?php echo $this->_tpl_vars['url']; ?>
/changeTems',"temName="+TemName,function(data){
											alert(data);
										})
									}
								</script>
							</tbody>
						</table>
						<script>
							/*function viewMenu(){
								var menu=document.getElementsById('Menus1');
								menu.style.display='block';
							}*/
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