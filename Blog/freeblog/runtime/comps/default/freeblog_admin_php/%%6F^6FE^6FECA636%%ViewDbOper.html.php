<?php /* Smarty version 2.6.18, created on 2012-02-02 17:20:12
         compiled from dataManage/ViewDbOper.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'dataManage/ViewDbOper.html', 37, false),)), $this); ?>
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
					<h3>操作记录</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">操作记录</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content " >
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<table id='operNotes'>
							<thead>
								<tr>
									<td colspan='5'>
										<button class='button' onclick='sendDatas()'>删除全部记录</button>&nbsp;&nbsp;&nbsp;
										<a href='<?php echo $this->_tpl_vars['url']; ?>
/saveOper'><button class='button'>记录保存</button></a>
									</td>
								</tr>
								<tr>
								<th>操作人</th>
								<th>操作模块</th>
								<th>操作详情</th>
								<th>操作时间</th>
								</tr>
							</thead>
							<tfoot>
								<?php unset($this->_sections['lo']);
$this->_sections['lo']['name'] = 'lo';
$this->_sections['lo']['loop'] = is_array($_loop=$this->_tpl_vars['resultDbOper']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['lo']['show'] = true;
$this->_sections['lo']['max'] = $this->_sections['lo']['loop'];
$this->_sections['lo']['step'] = 1;
$this->_sections['lo']['start'] = $this->_sections['lo']['step'] > 0 ? 0 : $this->_sections['lo']['loop']-1;
if ($this->_sections['lo']['show']) {
    $this->_sections['lo']['total'] = $this->_sections['lo']['loop'];
    if ($this->_sections['lo']['total'] == 0)
        $this->_sections['lo']['show'] = false;
} else
    $this->_sections['lo']['total'] = 0;
if ($this->_sections['lo']['show']):

            for ($this->_sections['lo']['index'] = $this->_sections['lo']['start'], $this->_sections['lo']['iteration'] = 1;
                 $this->_sections['lo']['iteration'] <= $this->_sections['lo']['total'];
                 $this->_sections['lo']['index'] += $this->_sections['lo']['step'], $this->_sections['lo']['iteration']++):
$this->_sections['lo']['rownum'] = $this->_sections['lo']['iteration'];
$this->_sections['lo']['index_prev'] = $this->_sections['lo']['index'] - $this->_sections['lo']['step'];
$this->_sections['lo']['index_next'] = $this->_sections['lo']['index'] + $this->_sections['lo']['step'];
$this->_sections['lo']['first']      = ($this->_sections['lo']['iteration'] == 1);
$this->_sections['lo']['last']       = ($this->_sections['lo']['iteration'] == $this->_sections['lo']['total']);
?>
								<tr>
									<td><?php echo $this->_tpl_vars['resultDbOper'][$this->_sections['lo']['index']]['oname']; ?>
</td>
									<td><?php echo $this->_tpl_vars['resultDbOper'][$this->_sections['lo']['index']]['opertype']; ?>
</td>
									<td><?php echo $this->_tpl_vars['resultDbOper'][$this->_sections['lo']['index']]['operdeta']; ?>
</td>
									<td><?php echo ((is_array($_tmp=$this->_tpl_vars['resultDbOper'][$this->_sections['lo']['index']]['opertime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y年-%m月-%d日 %H:%M:%S") : smarty_modifier_date_format($_tmp, "%y年-%m月-%d日 %H:%M:%S")); ?>
</td>
								</tr>
								<?php endfor; else: ?>
								<tr>
									<td>没有相关记录!</td>
								</tr>
								<?php endif; ?>
								<tr>
									<td colspan='4' style='text-align:right'>
									<div class="pagination"><!--用户分页-->
										<?php echo $this->_tpl_vars['fpage']; ?>

									</div> <!-- End .pagination -->
									</td>
								</tr>
							</tfoot>
							<tbody>
								<tr style='display:none' id='hidTb'>
									<td colspan='4'>没有相关记录!</td>
								</tr>
									<script>
										function sendDatas(){
												//$.get("<?php echo $this->_tpl_vars['url']; ?>
/delDbOper","delData="+delData,function(data)
													//var notes=document.getElementById('notes');
													//notes.innerHTML="<tr><td>没有相关记录</td></tr>";
													//alert(data);
											Ajax().post("<?php echo $this->_tpl_vars['url']; ?>
/delDbOper","isSure=1",function(data){
												if(data == '1'){
													var operNotes=document.getElementById('operNotes').tFoot;
													operNotes.style.display='none';
													var operTb=document.getElementById('hidTb');
													
													operTb.style.display='block';
													alert('删除成功');
												}else{
													alert('删除失败,请稍候再试');
												}
											});
										}
									</script>
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