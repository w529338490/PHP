<?php /* Smarty version 2.6.18, created on 2012-02-02 17:22:40
         compiled from dataManage/viewDB.html */ ?>
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
					<h3>数据管理</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">数据管理</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content " >
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<table>
							<thead>
								<tr>
									<td>
									<!-- action='<?php echo $this->_tpl_vars['url']; ?>
/importData' method='post' -->
										<form action='<?php echo $this->_tpl_vars['url']; ?>
/importData' method='post' enctype="multipart/form-data">
											<input type='file' name='importData'/>&nbsp;&nbsp;&nbsp;
											<!--<input type='submit' value='导入' class='button' />-->
											<button class='button'>导入</button>
										</form>
									</td>
									<td>
										
									</td>
									<!--判定用户是否存放数据表,如果不存放文件夹中将不存在数据表不显示该按钮-->
									<?php if ($this->_tpl_vars['resultSaveData'] == '1'): ?>
									<td>
										<button class='button' onclick='clearDbFile()'>清空上传数据文件</button>&nbsp;&nbsp;<span id='uploadNum'>(<?php echo $this->_tpl_vars['uploadNum']; ?>
)</span>
										<script>
											function clearDbFile(){
												Ajax().post("<?php echo $this->_tpl_vars['url']; ?>
/delDbFile",'sureDel=1',function(data){
													alert(data);
													var upload=document.getElementById('uploadNum');
													upload.innerHTML="(0)";
												})
											}
										</script>
									</td>
									<?php endif; ?>
								</tr>
								<br />
								<br />
								<br />
							</thead>
							<tfoot>
							</tfoot>
							<tbody>
								<?php unset($this->_sections['loo']);
$this->_sections['loo']['name'] = 'loo';
$this->_sections['loo']['loop'] = is_array($_loop=$this->_tpl_vars['tableDeta']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loo']['show'] = true;
$this->_sections['loo']['max'] = $this->_sections['loo']['loop'];
$this->_sections['loo']['step'] = 1;
$this->_sections['loo']['start'] = $this->_sections['loo']['step'] > 0 ? 0 : $this->_sections['loo']['loop']-1;
if ($this->_sections['loo']['show']) {
    $this->_sections['loo']['total'] = $this->_sections['loo']['loop'];
    if ($this->_sections['loo']['total'] == 0)
        $this->_sections['loo']['show'] = false;
} else
    $this->_sections['loo']['total'] = 0;
if ($this->_sections['loo']['show']):

            for ($this->_sections['loo']['index'] = $this->_sections['loo']['start'], $this->_sections['loo']['iteration'] = 1;
                 $this->_sections['loo']['iteration'] <= $this->_sections['loo']['total'];
                 $this->_sections['loo']['index'] += $this->_sections['loo']['step'], $this->_sections['loo']['iteration']++):
$this->_sections['loo']['rownum'] = $this->_sections['loo']['iteration'];
$this->_sections['loo']['index_prev'] = $this->_sections['loo']['index'] - $this->_sections['loo']['step'];
$this->_sections['loo']['index_next'] = $this->_sections['loo']['index'] + $this->_sections['loo']['step'];
$this->_sections['loo']['first']      = ($this->_sections['loo']['iteration'] == 1);
$this->_sections['loo']['last']       = ($this->_sections['loo']['iteration'] == $this->_sections['loo']['total']);
?>
								<tr>
									<td><?php echo $this->_tpl_vars['tableDeta'][$this->_sections['loo']['index']]['TABLE_NAME']; ?>
</td>
									<td><?php echo $this->_tpl_vars['tableDeta'][$this->_sections['loo']['index']]['TABLE_COMMENT']; ?>
</td>
									<td>
										<a href='<?php echo $this->_tpl_vars['url']; ?>
/saveTxt/TABLE_NAME/<?php echo $this->_tpl_vars['tableDeta'][$this->_sections['loo']['index']]['TABLE_NAME']; ?>
' title='导出到TXT'><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/detaCates.png" alt="导出到TXT"/></a>
									</td>
								</tr>
								<?php endfor; endif; ?>
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