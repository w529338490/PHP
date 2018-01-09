<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:49
         compiled from categoryManage/manageCategory.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'split_catTag', 'categoryManage/manageCategory.html', 37, false),)), $this); ?>
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
					<h3>分类列表</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">分类列表</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content " >
						<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
							<table>
								<thead>
									<tr>
										<th>分类</th>
										<th>查看</th>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>
									<?php unset($this->_sections['cates']);
$this->_sections['cates']['name'] = 'cates';
$this->_sections['cates']['loop'] = is_array($_loop=$this->_tpl_vars['allCates']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cates']['show'] = true;
$this->_sections['cates']['max'] = $this->_sections['cates']['loop'];
$this->_sections['cates']['step'] = 1;
$this->_sections['cates']['start'] = $this->_sections['cates']['step'] > 0 ? 0 : $this->_sections['cates']['loop']-1;
if ($this->_sections['cates']['show']) {
    $this->_sections['cates']['total'] = $this->_sections['cates']['loop'];
    if ($this->_sections['cates']['total'] == 0)
        $this->_sections['cates']['show'] = false;
} else
    $this->_sections['cates']['total'] = 0;
if ($this->_sections['cates']['show']):

            for ($this->_sections['cates']['index'] = $this->_sections['cates']['start'], $this->_sections['cates']['iteration'] = 1;
                 $this->_sections['cates']['iteration'] <= $this->_sections['cates']['total'];
                 $this->_sections['cates']['index'] += $this->_sections['cates']['step'], $this->_sections['cates']['iteration']++):
$this->_sections['cates']['rownum'] = $this->_sections['cates']['iteration'];
$this->_sections['cates']['index_prev'] = $this->_sections['cates']['index'] - $this->_sections['cates']['step'];
$this->_sections['cates']['index_next'] = $this->_sections['cates']['index'] + $this->_sections['cates']['step'];
$this->_sections['cates']['first']      = ($this->_sections['cates']['iteration'] == 1);
$this->_sections['cates']['last']       = ($this->_sections['cates']['iteration'] == $this->_sections['cates']['total']);
?>
										<tr>
											<td><a href='<?php echo $this->_tpl_vars['url']; ?>
/detaCategory/CateId/<?php echo $this->_tpl_vars['allCates'][$this->_sections['cates']['index']]['cid']; ?>
'><?php echo $this->_tpl_vars['allCates'][$this->_sections['cates']['index']]['category_name']; ?>
</a></td>
											<td>
												<a href='<?php echo $this->_tpl_vars['url']; ?>
/detaCategory/CateId/<?php echo $this->_tpl_vars['allCates'][$this->_sections['cates']['index']]['cid']; ?>
'><image src='<?php echo $this->_tpl_vars['res']; ?>
/images/icons/detaCates.png'/></a>
												&nbsp;&nbsp;
												<!--判断是否存在自类,如果存在输出可以不删除，如果不存在输出不可以删除-->
												<?php if ($this->_tpl_vars['allCates'][$this->_sections['cates']['index']]['flag'] == 'NO'): ?>
													<image src='<?php echo $this->_tpl_vars['res']; ?>
/images/icons/unrecycle.png' />
												<?php else: ?>
													<a href='<?php echo $this->_tpl_vars['url']; ?>
/delCategory/Cid/<?php echo $this->_tpl_vars['allCates'][$this->_sections['cates']['index']]['cid']; ?>
'><image src='<?php echo $this->_tpl_vars['res']; ?>
/images/icons/recycle.png' onclick='return confirm("您确实要删除<?php echo smarty_function_split_catTag(array('string' => $this->_tpl_vars['allCates'][$this->_sections['cates']['index']]['category_name']), $this);?>
类？")'/></a>
												<?php endif; ?>
											</td>
										</tr>
									<?php endfor; else: ?>
										<tr><td colspan='2'>还没有类别!</td></tr>
									<?php endif; ?>
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