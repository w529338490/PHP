<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:42
         compiled from ReviewManage/viewReview.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'ReviewManage/viewReview.html', 63, false),)), $this); ?>
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
					<h3>管理评论</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">管理评论</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content " >
						<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
							<table>
								<tfoot>
									<form action='<?php echo $this->_tpl_vars['app']; ?>
/articleManage/delArticle' method='post'>
									<tr>
										<td colspan='6'>
											<div class="bulk-actions align-left">
												<a href="javascript:void(0)" class="button" onclick="alls()" style="height:15px;width:40px;text-align:center">全选</a>&nbsp
												<a href="javascript:void(0)" class="button" onclick="fans()" style="height:15px;width:40px;text-align:center">反选</a>&nbsp
												<input type='hidden' name='flage' value='delete_reviewManage' />
												<input type='hidden' name='page' value='<?php echo $this->_tpl_vars['page']; ?>
' />
												<input type="submit" value="删除选中" name="reviewDel" class="button" style="height:25px;width:68px" onclick='return confirm("您确实要删除选择的文章？删除后该文章下的所有评论，回复都将删除！")'>
											</div>
											<div class="pagination"><!--用户分页-->
												<?php echo $this->_tpl_vars['fpage']; ?>

											</div> <!-- End .pagination -->
										</td>
									</tr>
								</tfoot>
								<tbody>
										<?php unset($this->_sections['review']);
$this->_sections['review']['name'] = 'review';
$this->_sections['review']['loop'] = is_array($_loop=$this->_tpl_vars['reviewData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['review']['show'] = true;
$this->_sections['review']['max'] = $this->_sections['review']['loop'];
$this->_sections['review']['step'] = 1;
$this->_sections['review']['start'] = $this->_sections['review']['step'] > 0 ? 0 : $this->_sections['review']['loop']-1;
if ($this->_sections['review']['show']) {
    $this->_sections['review']['total'] = $this->_sections['review']['loop'];
    if ($this->_sections['review']['total'] == 0)
        $this->_sections['review']['show'] = false;
} else
    $this->_sections['review']['total'] = 0;
if ($this->_sections['review']['show']):

            for ($this->_sections['review']['index'] = $this->_sections['review']['start'], $this->_sections['review']['iteration'] = 1;
                 $this->_sections['review']['iteration'] <= $this->_sections['review']['total'];
                 $this->_sections['review']['index'] += $this->_sections['review']['step'], $this->_sections['review']['iteration']++):
$this->_sections['review']['rownum'] = $this->_sections['review']['iteration'];
$this->_sections['review']['index_prev'] = $this->_sections['review']['index'] - $this->_sections['review']['step'];
$this->_sections['review']['index_next'] = $this->_sections['review']['index'] + $this->_sections['review']['step'];
$this->_sections['review']['first']      = ($this->_sections['review']['iteration'] == 1);
$this->_sections['review']['last']       = ($this->_sections['review']['iteration'] == $this->_sections['review']['total']);
?>
											<tr>
												<td><input type='checkbox' name='check_article[]' value="<?php echo $this->_tpl_vars['reviewData'][$this->_sections['review']['index']]['aid']; ?>
"/></td>
												<td>
													<a href='<?php echo $this->_tpl_vars['url']; ?>
/viewArticle/aid/<?php echo $this->_tpl_vars['reviewData'][$this->_sections['review']['index']]['aid']; ?>
'>
														<?php echo $this->_tpl_vars['reviewData'][$this->_sections['review']['index']]['article_title']; ?>

													</a>
													<br />
													<br />
													<?php echo ((is_array($_tmp=$this->_tpl_vars['reviewData'][$this->_sections['review']['index']]['article_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y年-%m月-%d日 %H:%M:%S") : smarty_modifier_date_format($_tmp, "%y年-%m月-%d日 %H:%M:%S")); ?>

												</td>
											<?php if ($this->_tpl_vars['reviewData'][$this->_sections['review']['index']]['flag']): ?>
												<td>
													<?php echo $this->_tpl_vars['reviewData'][$this->_sections['review']['index']]['review_name']; ?>

													<br />
													<br />
													<?php echo $this->_tpl_vars['reviewData'][$this->_sections['review']['index']]['review_email']; ?>

												</td>
												<td>
													<?php echo ((is_array($_tmp=$this->_tpl_vars['reviewData'][$this->_sections['review']['index']]['review_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y年-%m月-%d日 %H:%M:%S") : smarty_modifier_date_format($_tmp, "%y年-%m月-%d日 %H:%M:%S")); ?>

													<br />
													<br />
													共(<?php echo $this->_tpl_vars['reviewData'][$this->_sections['review']['index']]['review_count']; ?>
)篇评论
												</td>
											</tr>
											<?php else: ?>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td>&nbsp;该文章还没有评论!</td>
											</tr>
											<?php endif; ?>
										<?php endfor; else: ?>
											<tr>
												<td colspan='6'>还没有文章需要评论!</td>
											</tr>
										<?php endif; ?>
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