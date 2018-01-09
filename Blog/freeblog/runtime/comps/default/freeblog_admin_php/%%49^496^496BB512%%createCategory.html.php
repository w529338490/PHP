<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:46
         compiled from categoryOther/createCategory.html */ ?>
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
					<h3>添加分类</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">添加分类</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content " >
						<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
							<table>
								<tfoot>
									<form action='<?php echo $this->_tpl_vars['url']; ?>
/addCategory' method='post'>
										<tr>
											<td colspan='6'>
												<div class="bulk-actions align-left">
													<input type="submit" value="确认添加" name="sub" class="button" style="height:25px;width:68px">
													<input type="submit" value="分类列表" name="sub" class="button" style="height:25px;width:68px">
												</div>
												<div class="pagination"><!--用户分页-->
													<?php echo $this->_tpl_vars['fpage']; ?>

												</div> <!-- End .pagination -->
											</td>
										</tr>
								</tfoot>
								<tbody>
										<tr>
											<td>
												*上级分类:
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<select name='path'>
													<option value='0'>---选择所属类别---</option>
													<option value='0'>根目录</option>
													<?php unset($this->_sections['allCate']);
$this->_sections['allCate']['name'] = 'allCate';
$this->_sections['allCate']['loop'] = is_array($_loop=$this->_tpl_vars['allCategory']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['allCate']['show'] = true;
$this->_sections['allCate']['max'] = $this->_sections['allCate']['loop'];
$this->_sections['allCate']['step'] = 1;
$this->_sections['allCate']['start'] = $this->_sections['allCate']['step'] > 0 ? 0 : $this->_sections['allCate']['loop']-1;
if ($this->_sections['allCate']['show']) {
    $this->_sections['allCate']['total'] = $this->_sections['allCate']['loop'];
    if ($this->_sections['allCate']['total'] == 0)
        $this->_sections['allCate']['show'] = false;
} else
    $this->_sections['allCate']['total'] = 0;
if ($this->_sections['allCate']['show']):

            for ($this->_sections['allCate']['index'] = $this->_sections['allCate']['start'], $this->_sections['allCate']['iteration'] = 1;
                 $this->_sections['allCate']['iteration'] <= $this->_sections['allCate']['total'];
                 $this->_sections['allCate']['index'] += $this->_sections['allCate']['step'], $this->_sections['allCate']['iteration']++):
$this->_sections['allCate']['rownum'] = $this->_sections['allCate']['iteration'];
$this->_sections['allCate']['index_prev'] = $this->_sections['allCate']['index'] - $this->_sections['allCate']['step'];
$this->_sections['allCate']['index_next'] = $this->_sections['allCate']['index'] + $this->_sections['allCate']['step'];
$this->_sections['allCate']['first']      = ($this->_sections['allCate']['iteration'] == 1);
$this->_sections['allCate']['last']       = ($this->_sections['allCate']['iteration'] == $this->_sections['allCate']['total']);
?>
														<option value='<?php echo $this->_tpl_vars['allCategory'][$this->_sections['allCate']['index']]['cid']; ?>
'>
															<?php echo $this->_tpl_vars['allCategory'][$this->_sections['allCate']['index']]['category_name']; ?>

														</option>
													<?php endfor; endif; ?>
												</select>
											</td>
										</tr>
										<tr>
											<td>
											*分类标题:
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type='text' name='category_name' /></td>
										</tr>
										<tr>
											<td colspan='2'>
												分类简介:
											</td>
										</tr>
										<tr>
											<td colspan='2'>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;
												<textarea name='category_content' rows='7' cols='30'></textarea>
											</td>
										</tr>
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