<?php /* Smarty version 2.6.18, created on 2012-02-17 11:29:51
         compiled from articleManage/viewRecycle.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'articleManage/viewRecycle.html', 69, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<script>
				function alls(){
					var cks=document.getElementsByName('check_article[]');
					for(i=0;i<cks.length;i++){
						cks[i].checked=true;
					}
				}	
				function fans(){
					var cks=document.getElementsByName('check_article[]');
					for(i=0;i<cks.length;i++){
						if(cks[i].checked==true){
							cks[i].checked=false;
						}else{
							cks[i].checked=true;
						}
					}
				}
			</script>
			<p id="page-intro">Free Blog</p>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>回收列表</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">回收列表</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content " >
						<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
							<table>
								<thead>
									<tr>
										<th>选择</th>
										<th>标题</th>
										<th>作者</th>
										<th>所属类别</th>
										<th>发布时间</th>
										<th>操作</th>
									</tr>
								</thead>
								<tfoot>
									<form action='<?php echo $this->_tpl_vars['url']; ?>
/delArticle' method='post'>
									<tr>
										<td colspan='6'>
											<div class="bulk-actions align-left">
												<a href="javascript:void(0)" class="button" onclick="alls()" style="height:15px;width:40px;text-align:center">全选</a>&nbsp
												<a href="javascript:void(0)" class="button" onclick="fans()" style="height:15px;width:40px;text-align:center">反选</a>&nbsp
												<input type="submit" value="还原选中" name="restorSelect" class="button" style="height:25px;width:68px">&nbsp;
												<input type="submit" value="删除选中" name="sub" class="button" style="height:25px;width:68px">
											</div>
											<div class="pagination"><!--用户分页-->
												<?php echo $this->_tpl_vars['fpage']; ?>

											</div> <!-- End .pagination -->
										</td>
									</tr>
								</tfoot>
								<tbody>
										<?php unset($this->_sections['Article']);
$this->_sections['Article']['name'] = 'Article';
$this->_sections['Article']['loop'] = is_array($_loop=$this->_tpl_vars['recycleArticle']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Article']['show'] = true;
$this->_sections['Article']['max'] = $this->_sections['Article']['loop'];
$this->_sections['Article']['step'] = 1;
$this->_sections['Article']['start'] = $this->_sections['Article']['step'] > 0 ? 0 : $this->_sections['Article']['loop']-1;
if ($this->_sections['Article']['show']) {
    $this->_sections['Article']['total'] = $this->_sections['Article']['loop'];
    if ($this->_sections['Article']['total'] == 0)
        $this->_sections['Article']['show'] = false;
} else
    $this->_sections['Article']['total'] = 0;
if ($this->_sections['Article']['show']):

            for ($this->_sections['Article']['index'] = $this->_sections['Article']['start'], $this->_sections['Article']['iteration'] = 1;
                 $this->_sections['Article']['iteration'] <= $this->_sections['Article']['total'];
                 $this->_sections['Article']['index'] += $this->_sections['Article']['step'], $this->_sections['Article']['iteration']++):
$this->_sections['Article']['rownum'] = $this->_sections['Article']['iteration'];
$this->_sections['Article']['index_prev'] = $this->_sections['Article']['index'] - $this->_sections['Article']['step'];
$this->_sections['Article']['index_next'] = $this->_sections['Article']['index'] + $this->_sections['Article']['step'];
$this->_sections['Article']['first']      = ($this->_sections['Article']['iteration'] == 1);
$this->_sections['Article']['last']       = ($this->_sections['Article']['iteration'] == $this->_sections['Article']['total']);
?>
											<tr>
												<td><input type='checkbox' name='check_article[]' value="<?php echo $this->_tpl_vars['recycleArticle'][$this->_sections['Article']['index']]['aid']; ?>
"/></td>
												<td><?php echo $this->_tpl_vars['recycleArticle'][$this->_sections['Article']['index']]['article_title']; ?>
</td>
												<td><?php echo $this->_tpl_vars['recycleArticle'][$this->_sections['Article']['index']]['article_author']; ?>
</td>
												<td><?php echo $this->_tpl_vars['recycleArticle'][$this->_sections['Article']['index']]['article_category']; ?>
</td>
												<td><?php echo ((is_array($_tmp=$this->_tpl_vars['recycleArticle'][$this->_sections['Article']['index']]['article_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y/%m/%d/%H:%M:%S") : smarty_modifier_date_format($_tmp, "%y/%m/%d/%H:%M:%S")); ?>
</td>									
												<td>
													<a href="<?php echo $this->_tpl_vars['url']; ?>
/viewArticle/aid/<?php echo $this->_tpl_vars['manageArticle'][$this->_sections['contact']['index']]['aid']; ?>
" title="查看详细信息"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/pencil.png" alt="查看详细信息" /></a>
													<a href="<?php echo $this->_tpl_vars['url']; ?>
/restoreArticle/aid/<?php echo $this->_tpl_vars['recycleArticle'][$this->_sections['Article']['index']]['aid']; ?>
" title="还原"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/restore.png" alt="还原" /></a>
													<a href="<?php echo $this->_tpl_vars['url']; ?>
/delArticle/aid/<?php echo $this->_tpl_vars['recycleArticle'][$this->_sections['Article']['index']]['aid']; ?>
/flag/delete_recycle" title="彻底删除"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross.png" alt="彻底删除" onclick='return confirm("确认从回收站删除？一经删除不可恢复！")'/></a>
												</td>	
											</tr>
										<?php endfor; else: ?>
											<tr>
												<td colspan='6'>回收站中没有文章!</td>
											</tr>
										<?php endif; ?>
										<input type='hidden' name='flag' value='delete_recycle' />
									</form>
								</tbody>
							</table>
						</div>
					<div class="clear"></div>
				</div> <!-- End #tab1 -->				
			</div> <!-- End .content-box-content -->
		</div> <!-- End .content-box -->		
<div class="clear"></div>
		
<!--页面底部-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>