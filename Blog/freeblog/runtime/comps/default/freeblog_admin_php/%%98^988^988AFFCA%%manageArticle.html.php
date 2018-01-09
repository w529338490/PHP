<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:41
         compiled from articleManage/manageArticle.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'articleManage/manageArticle.html', 91, false),)), $this); ?>
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
			<div>
				<span>文章总数(<?php echo $this->_tpl_vars['condition']['totalArticle']; ?>
)&nbsp; | &nbsp;有效文章数(<?php echo $this->_tpl_vars['condition']['vaildArticle']; ?>
)&nbsp; | &nbsp;<a href='<?php echo $this->_tpl_vars['app']; ?>
/articleManage/viewRecycle'>回收站</a>(<?php echo $this->_tpl_vars['condition']['invalidArticle']; ?>
)&nbsp; | &nbsp;<a href="<?php echo $this->_tpl_vars['app']; ?>
/articleManage/clearRecycle" onclick="return confirm('您确定清空回收站？')">清空回收站</a></span><br/><br/>
				<form action="<?php echo $this->_tpl_vars['app']; ?>
/articleManage/searchAtricle" method="post">
					<!--查询发文章时间-->
					<select name='selectMonth'>
						<option value='0'>显示所有时间</option>
						<?php unset($this->_sections['allMonth']);
$this->_sections['allMonth']['name'] = 'allMonth';
$this->_sections['allMonth']['loop'] = is_array($_loop=$this->_tpl_vars['issueMonth']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['allMonth']['show'] = true;
$this->_sections['allMonth']['max'] = $this->_sections['allMonth']['loop'];
$this->_sections['allMonth']['step'] = 1;
$this->_sections['allMonth']['start'] = $this->_sections['allMonth']['step'] > 0 ? 0 : $this->_sections['allMonth']['loop']-1;
if ($this->_sections['allMonth']['show']) {
    $this->_sections['allMonth']['total'] = $this->_sections['allMonth']['loop'];
    if ($this->_sections['allMonth']['total'] == 0)
        $this->_sections['allMonth']['show'] = false;
} else
    $this->_sections['allMonth']['total'] = 0;
if ($this->_sections['allMonth']['show']):

            for ($this->_sections['allMonth']['index'] = $this->_sections['allMonth']['start'], $this->_sections['allMonth']['iteration'] = 1;
                 $this->_sections['allMonth']['iteration'] <= $this->_sections['allMonth']['total'];
                 $this->_sections['allMonth']['index'] += $this->_sections['allMonth']['step'], $this->_sections['allMonth']['iteration']++):
$this->_sections['allMonth']['rownum'] = $this->_sections['allMonth']['iteration'];
$this->_sections['allMonth']['index_prev'] = $this->_sections['allMonth']['index'] - $this->_sections['allMonth']['step'];
$this->_sections['allMonth']['index_next'] = $this->_sections['allMonth']['index'] + $this->_sections['allMonth']['step'];
$this->_sections['allMonth']['first']      = ($this->_sections['allMonth']['iteration'] == 1);
$this->_sections['allMonth']['last']       = ($this->_sections['allMonth']['iteration'] == $this->_sections['allMonth']['total']);
?>
							<option><?php echo $this->_tpl_vars['issueMonth'][$this->_sections['allMonth']['index']]; ?>
</option>
						<?php endfor; endif; ?>
					</select>
					<!--查询分组-->
					<select name="selectGroup">
						<option value='0'>查看所有分类目录</option>
						<?php unset($this->_sections['aCategory']);
$this->_sections['aCategory']['name'] = 'aCategory';
$this->_sections['aCategory']['loop'] = is_array($_loop=$this->_tpl_vars['allCategory']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['aCategory']['show'] = true;
$this->_sections['aCategory']['max'] = $this->_sections['aCategory']['loop'];
$this->_sections['aCategory']['step'] = 1;
$this->_sections['aCategory']['start'] = $this->_sections['aCategory']['step'] > 0 ? 0 : $this->_sections['aCategory']['loop']-1;
if ($this->_sections['aCategory']['show']) {
    $this->_sections['aCategory']['total'] = $this->_sections['aCategory']['loop'];
    if ($this->_sections['aCategory']['total'] == 0)
        $this->_sections['aCategory']['show'] = false;
} else
    $this->_sections['aCategory']['total'] = 0;
if ($this->_sections['aCategory']['show']):

            for ($this->_sections['aCategory']['index'] = $this->_sections['aCategory']['start'], $this->_sections['aCategory']['iteration'] = 1;
                 $this->_sections['aCategory']['iteration'] <= $this->_sections['aCategory']['total'];
                 $this->_sections['aCategory']['index'] += $this->_sections['aCategory']['step'], $this->_sections['aCategory']['iteration']++):
$this->_sections['aCategory']['rownum'] = $this->_sections['aCategory']['iteration'];
$this->_sections['aCategory']['index_prev'] = $this->_sections['aCategory']['index'] - $this->_sections['aCategory']['step'];
$this->_sections['aCategory']['index_next'] = $this->_sections['aCategory']['index'] + $this->_sections['aCategory']['step'];
$this->_sections['aCategory']['first']      = ($this->_sections['aCategory']['iteration'] == 1);
$this->_sections['aCategory']['last']       = ($this->_sections['aCategory']['iteration'] == $this->_sections['aCategory']['total']);
?>
							<option value='<?php echo $this->_tpl_vars['allCategory'][$this->_sections['aCategory']['index']]['category_name']; ?>
'><?php echo $this->_tpl_vars['allCategory'][$this->_sections['aCategory']['index']]['category_name']; ?>
</option>
						<?php endfor; endif; ?>
					<select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" class="button" value="筛选" style="height:25px;width:50px">
				</form>
				
			</div>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>文章列表</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">文章列表</a></li> <!-- href must be unique and match the id of target div -->	
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
									<!--<th>可见性</th>
									<th>是/否可评论</th>-->
									<th>发布时间</th>
									<th>操作</th>
								</tr>
							</thead>
							<tfoot>
							<form action='<?php echo $this->_tpl_vars['url']; ?>
/delArticle' method="post">
								<tr>
									<td colspan='6'>
										<div class="bulk-actions align-left">
											<a href="javascript:void(0)" class="button" onclick="alls()" style="height:15px;width:40px;text-align:center">全选</a>&nbsp
											<a href="javascript:void(0)" class="button" onclick="fans()" style="height:15px;width:40px;text-align:center">反选</a>&nbsp
											<input type="submit" value="删除选中" name="sub" class="button" style="height:25px;width:68px">
										</div>
										<div class="pagination"><!--用户分页-->
											<?php echo $this->_tpl_vars['fpage']; ?>

										</div> <!-- End .pagination -->
									</td>
								</tr>
							</tfoot>
							<tbody>
									<?php unset($this->_sections['allArticle']);
$this->_sections['allArticle']['name'] = 'allArticle';
$this->_sections['allArticle']['loop'] = is_array($_loop=$this->_tpl_vars['viewResult']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['allArticle']['show'] = true;
$this->_sections['allArticle']['max'] = $this->_sections['allArticle']['loop'];
$this->_sections['allArticle']['step'] = 1;
$this->_sections['allArticle']['start'] = $this->_sections['allArticle']['step'] > 0 ? 0 : $this->_sections['allArticle']['loop']-1;
if ($this->_sections['allArticle']['show']) {
    $this->_sections['allArticle']['total'] = $this->_sections['allArticle']['loop'];
    if ($this->_sections['allArticle']['total'] == 0)
        $this->_sections['allArticle']['show'] = false;
} else
    $this->_sections['allArticle']['total'] = 0;
if ($this->_sections['allArticle']['show']):

            for ($this->_sections['allArticle']['index'] = $this->_sections['allArticle']['start'], $this->_sections['allArticle']['iteration'] = 1;
                 $this->_sections['allArticle']['iteration'] <= $this->_sections['allArticle']['total'];
                 $this->_sections['allArticle']['index'] += $this->_sections['allArticle']['step'], $this->_sections['allArticle']['iteration']++):
$this->_sections['allArticle']['rownum'] = $this->_sections['allArticle']['iteration'];
$this->_sections['allArticle']['index_prev'] = $this->_sections['allArticle']['index'] - $this->_sections['allArticle']['step'];
$this->_sections['allArticle']['index_next'] = $this->_sections['allArticle']['index'] + $this->_sections['allArticle']['step'];
$this->_sections['allArticle']['first']      = ($this->_sections['allArticle']['iteration'] == 1);
$this->_sections['allArticle']['last']       = ($this->_sections['allArticle']['iteration'] == $this->_sections['allArticle']['total']);
?>
										<tr>
											<td><input type='checkbox' name='check_article[]' value='<?php echo $this->_tpl_vars['viewResult'][$this->_sections['allArticle']['index']]['aid']; ?>
'/></td>
											<td><?php echo $this->_tpl_vars['viewResult'][$this->_sections['allArticle']['index']]['article_title']; ?>
</td>
											<td><?php echo $this->_tpl_vars['viewResult'][$this->_sections['allArticle']['index']]['article_author']; ?>
</td>
											<td><?php echo $this->_tpl_vars['viewResult'][$this->_sections['allArticle']['index']]['article_category']; ?>
</td>
											<td><?php echo ((is_array($_tmp=$this->_tpl_vars['viewResult'][$this->_sections['allArticle']['index']]['article_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y年-%m月-%d日 %H:%M:%S") : smarty_modifier_date_format($_tmp, "%y年-%m月-%d日 %H:%M:%S")); ?>
</td>										
											<td>
												<a href="<?php echo $this->_tpl_vars['app']; ?>
/articleOther/viewArticle/aid/<?php echo $this->_tpl_vars['viewResult'][$this->_sections['allArticle']['index']]['aid']; ?>
<?php echo $this->_tpl_vars['page']; ?>
" title="编辑文章"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/pencil.png" alt="编辑文章" /></a>
												<a href="<?php echo $this->_tpl_vars['url']; ?>
/moveRecycle/aid/<?php echo $this->_tpl_vars['viewResult'][$this->_sections['allArticle']['index']]['aid']; ?>
<?php echo $this->_tpl_vars['page']; ?>
" title="移至回收站"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/recycle.png" alt="移至回收站" onclick="return confirm('您确定要将<?php echo $this->_tpl_vars['viewResult'][$this->_sections['allArticle']['index']]['article_title']; ?>
移至回收站？')"/></a> 
												<a href="<?php echo $this->_tpl_vars['url']; ?>
/delArticle/aid/<?php echo $this->_tpl_vars['viewResult'][$this->_sections['allArticle']['index']]['aid']; ?>
<?php echo $this->_tpl_vars['page']; ?>
/flag/delete_manager/cName/<?php echo $this->_tpl_vars['viewResult'][$this->_sections['allArticle']['index']]['article_category']; ?>
" title="删除"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross.png" alt="删除" onclick="return confirm('您确定要将<?php echo $this->_tpl_vars['viewResult'][$this->_sections['allArticle']['index']]['article_title']; ?>
删除？')" /></a> 
											</td>	
										</tr>
									<?php endfor; else: ?>
										<tr>
											<td colspan='6' align='center'>您还没有发表文章!</td>
										</tr>
									<?php endif; ?>
									<input type='hidden' name='flag' value='delete_manager' />
								</form>
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