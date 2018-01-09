<?php /* Smarty version 2.6.18, created on 2012-02-02 17:35:07
         compiled from categoryManage/detaCategory.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'categoryManage/detaCategory.html', 57, false),)), $this); ?>
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
					<h3>分类详情</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">分类详情</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content " >
						<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
							<table>
								<thead>
									<tr>
										<th width='100'>项目</th>
										<th width='400'>详情</th>
										<th>操作</th>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>
									<!--各级别间的关系-->
									<tr>
										<td><b>分类关系：</b></td>
										<td><?php echo $this->_tpl_vars['detaCategory']['path']; ?>
</td>
										<td>
											<a href='<?php echo $this->_tpl_vars['url']; ?>
/modCategoryName/cid/<?php echo $this->_tpl_vars['detaCategory']['cid']; ?>
' class='button'>更改类名</a>
										</td>
									</tr>
								<tr>
										<td><b>类别简介：</b></td>
										<td><?php echo $this->_tpl_vars['detaCategory']['category_content']; ?>
</td>
										<td>
											<a href='<?php echo $this->_tpl_vars['url']; ?>
/modCategoryContent/cid/<?php echo $this->_tpl_vars['detaCategory']['cid']; ?>
' class='button'>修改简介</a>
										</td>
									</tr>								
									<tr>
										<td><b>包含文章数：</b></td>
										<td><?php echo $this->_tpl_vars['detaCategory']['category_total']; ?>
</td>						
										<td>
											<?php if ($this->_tpl_vars['detaCategory']['subAction'] == 'N'): ?>
												<!--Cid/<?php echo $this->_tpl_vars['detaCategory']['cid']; ?>
/-->
												<a href='<?php echo $this->_tpl_vars['app']; ?>
/categoryManage/createArticle/Cname/<?php echo $this->_tpl_vars['detaCategory']['category_name']; ?>
' class='button'>发表文章</a>
											<?php else: ?>
												<font color='red'>不能在父类模块下发表文章</font>
											<?php endif; ?>
										</td>
									</tr>
									<tr>
										<td><b>创建时间：</b></td>
										<td colspan='3'><?php echo ((is_array($_tmp=$this->_tpl_vars['detaCategory']['category_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y年-%m月-%d日 %H:%M:%S") : smarty_modifier_date_format($_tmp, "%y年-%m月-%d日 %H:%M:%S")); ?>
</td>
									</tr>
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