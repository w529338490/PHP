<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:40
         compiled from articleOther/createArticle.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p id="page-intro">Free Blog</p>
			<div>
				<span>文章总数(<?php echo $this->_tpl_vars['articleData']['allTotal']; ?>
)&nbsp; | &nbsp;有效文章数(<?php echo $this->_tpl_vars['articleData']['vaildTotal']; ?>
)&nbsp; | &nbsp;<a href='<?php echo $this->_tpl_vars['app']; ?>
/articleManage/viewRecycle'>回收站</a>(<?php echo $this->_tpl_vars['articleData']['invaildTotal']; ?>
)&nbsp; | &nbsp;<a href="<?php echo $this->_tpl_vars['app']; ?>
/articleManage/clearRecycle" onclick="return confirm('您确定清空回收站？')">清空回收站</a></span><br/><br/>
			</div>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>发表文章</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">发表文章</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content " >
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<form action='<?php echo $this->_tpl_vars['url']; ?>
/addArticle' method='post'>
							<table>
								<thead>
									<tr>
										<td>
											<input type='text' name='article_title' style='height:30px;width:400px;font-size:25px;color:#A9A9A9;' value='在此键入标题' id='articleTitle' onclick="titles()"/>
										</td>
										<script>
											function titles(){
												var hidTitle=document.getElementById('articleTitle');
												hidTitle.value="";
											}
										</script>
										<td>
											<b>选择文章类别:</b>
											<select name='article_category' >
												<option value='未分类'>选择分组</option>
												<?php unset($this->_sections['category']);
$this->_sections['category']['name'] = 'category';
$this->_sections['category']['loop'] = is_array($_loop=$this->_tpl_vars['allCategory']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['category']['show'] = true;
$this->_sections['category']['max'] = $this->_sections['category']['loop'];
$this->_sections['category']['step'] = 1;
$this->_sections['category']['start'] = $this->_sections['category']['step'] > 0 ? 0 : $this->_sections['category']['loop']-1;
if ($this->_sections['category']['show']) {
    $this->_sections['category']['total'] = $this->_sections['category']['loop'];
    if ($this->_sections['category']['total'] == 0)
        $this->_sections['category']['show'] = false;
} else
    $this->_sections['category']['total'] = 0;
if ($this->_sections['category']['show']):

            for ($this->_sections['category']['index'] = $this->_sections['category']['start'], $this->_sections['category']['iteration'] = 1;
                 $this->_sections['category']['iteration'] <= $this->_sections['category']['total'];
                 $this->_sections['category']['index'] += $this->_sections['category']['step'], $this->_sections['category']['iteration']++):
$this->_sections['category']['rownum'] = $this->_sections['category']['iteration'];
$this->_sections['category']['index_prev'] = $this->_sections['category']['index'] - $this->_sections['category']['step'];
$this->_sections['category']['index_next'] = $this->_sections['category']['index'] + $this->_sections['category']['step'];
$this->_sections['category']['first']      = ($this->_sections['category']['iteration'] == 1);
$this->_sections['category']['last']       = ($this->_sections['category']['iteration'] == $this->_sections['category']['total']);
?>
													<option value='<?php echo $this->_tpl_vars['allCategory'][$this->_sections['category']['index']]['category_name']; ?>
'><?php echo $this->_tpl_vars['allCategory'][$this->_sections['category']['index']]['category_name']; ?>
</option>
												<?php endfor; endif; ?>
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<b>可见性:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type='radio' name='article_authority' value='1'/>仅自己&nbsp;&nbsp;&nbsp;&nbsp;
											<input type='radio' name='article_authority' value='3' checked='checked'/>全部可见&nbsp;&nbsp;&nbsp;&nbsp;
										</td>
										<td>
											<b>是/否可以评论:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type='radio' name='article_review' value='1' checked='checked' />是&nbsp;&nbsp;&nbsp;&nbsp;
											<input type='radio' name='article_review' value='0' />否&nbsp;&nbsp;&nbsp;&nbsp;
										</td>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<td colspan='2'>
										<input type='submit' value='发表文章' name='subArticle'  class='button' style="height:27px;width:80px"/>&nbsp;&nbsp;&nbsp;&nbsp;
										<input type='reset' value='重置所有'  class='button' style="height:27px;width:80px"/>&nbsp;&nbsp;&nbsp;&nbsp;
										<a href='<?php echo $this->_tpl_vars['app']; ?>
/articleManage/manageArticle' class='button'>返回文章列表</a>
										</td>
									</tr>
								</tfoot>
								<tbody>
									<tr>
										<td colspan='2'>
											<!-- 调用编辑器-->
											<textarea cols='20' rows='30' name='article_content'></textarea>
												<?php echo $this->_tpl_vars['ckeditor']; ?>

										</td>
									</tr>
								</tbody>
							</table>
						</form>
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