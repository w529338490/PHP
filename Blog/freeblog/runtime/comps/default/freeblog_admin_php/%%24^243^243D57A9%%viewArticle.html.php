<?php /* Smarty version 2.6.18, created on 2012-02-17 11:31:10
         compiled from ReviewManage/viewArticle.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'ReviewManage/viewArticle.html', 50, false),array('modifier', 'returnWebSite', 'ReviewManage/viewArticle.html', 108, false),array('modifier', 'isExit', 'ReviewManage/viewArticle.html', 120, false),array('function', 'reReview', 'ReviewManage/viewArticle.html', 127, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<script type="text/javascript">
				function show(obj){
					var sp = obj.getElementsByTagName('span')[0];
						sp.style.display='block';
				}
				function hide(obj){
					var sp = obj.getElementsByTagName('span')[0];
						sp.style.display='none';					
				}
				
				
				function showReview(num,rrid){
					var a=document.getElementById(rrid);

						if(num){
							a.style.display='block';
							var xSpace=event.clientX;
							var ySpace=event.clientY;
						}else{
							a.style.display='none';
						}
				}
				
				function subContent(){
					
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
								<thead>
									<tr>
										<td style='font-size:20px;'><?php echo $this->_tpl_vars['articleData']['article_title']; ?>
</td>
									</tr>
									<tr>
										<td><?php echo $this->_tpl_vars['articleData']['article_author']; ?>
 发表于 <?php echo ((is_array($_tmp=$this->_tpl_vars['articleData']['article_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y年-%m月-%d日 %H:%M:%S") : smarty_modifier_date_format($_tmp, "%y年-%m月-%d日 %H:%M:%S")); ?>
</td>
									</tr>
									<tr>
										<td colspan='2'>
											<div style='width: 976px;' >
												<hr />
												<br />
												<br />
													<?php echo $this->_tpl_vars['articleData']['article_content']; ?>

												<br />
												<br />
												<hr />
											</div>
										</td>
									</tr>
								</thead>
							</table>
							<table>
								<thead>
									<tr>
										<td>
											<b style='color:#519c00;font-size:15px;'>&nbsp;&nbsp;<?php echo $this->_tpl_vars['articleData']['article_title']; ?>
&nbsp;&nbsp;的 详 细 评 论</b>
											<br />
											<br />
											<br />
										</td>
									</tr>
								</thead>
								<tfoot>
 									<tr>
										<td colspan='6'>
<!-- 											<div class="bulk-actions align-left">
												<button class="button" onclick="alls()" style="height:25px;width:50px">全选</button>&nbsp
												<button class="button" onclick="fans()" style="height:25px;width:50px">反选</button>&nbsp
												<input type="submit" value="还原选中" name="sub" class="button" style="height:25px;width:68px">
												<input type="submit" value="删除选中" name="sub" class="button" style="height:25px;width:68px">
											</div> -->
											<div class="pagination"><!--用户分页-->
												<?php echo $this->_tpl_vars['fpage']; ?>

											</div> <!-- End .pagination -->
										</td>
									</tr> 
								</tfoot>
								<tbody id='text'>
									
										<?php unset($this->_sections['allReview']);
$this->_sections['allReview']['name'] = 'allReview';
$this->_sections['allReview']['loop'] = is_array($_loop=$this->_tpl_vars['articleReview']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['allReview']['show'] = true;
$this->_sections['allReview']['max'] = $this->_sections['allReview']['loop'];
$this->_sections['allReview']['step'] = 1;
$this->_sections['allReview']['start'] = $this->_sections['allReview']['step'] > 0 ? 0 : $this->_sections['allReview']['loop']-1;
if ($this->_sections['allReview']['show']) {
    $this->_sections['allReview']['total'] = $this->_sections['allReview']['loop'];
    if ($this->_sections['allReview']['total'] == 0)
        $this->_sections['allReview']['show'] = false;
} else
    $this->_sections['allReview']['total'] = 0;
if ($this->_sections['allReview']['show']):

            for ($this->_sections['allReview']['index'] = $this->_sections['allReview']['start'], $this->_sections['allReview']['iteration'] = 1;
                 $this->_sections['allReview']['iteration'] <= $this->_sections['allReview']['total'];
                 $this->_sections['allReview']['index'] += $this->_sections['allReview']['step'], $this->_sections['allReview']['iteration']++):
$this->_sections['allReview']['rownum'] = $this->_sections['allReview']['iteration'];
$this->_sections['allReview']['index_prev'] = $this->_sections['allReview']['index'] - $this->_sections['allReview']['step'];
$this->_sections['allReview']['index_next'] = $this->_sections['allReview']['index'] + $this->_sections['allReview']['step'];
$this->_sections['allReview']['first']      = ($this->_sections['allReview']['iteration'] == 1);
$this->_sections['allReview']['last']       = ($this->_sections['allReview']['iteration'] == $this->_sections['allReview']['total']);
?>
										<form action='<?php echo $this->_tpl_vars['url']; ?>
/reReviews' method='post'>
											<tr id='shows' onmouseover="show(this)" onmouseout="hide(this)">
												<td>
													<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['review_email']; ?>
&nbsp;&nbsp;在&nbsp;&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['review_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y年-%m月-%d日 %H:%M:%S") : smarty_modifier_date_format($_tmp, "%y年-%m月-%d日 %H:%M:%S")); ?>

													<br />
													<br />
													给<?php echo $this->_tpl_vars['articleData']['article_title']; ?>
进行了名为：<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['review_name']; ?>
的评论:
													<br />
													<br />
													<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['review_content']; ?>

													<br />
													<br />
													<?php if (((is_array($_tmp=$this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['review_website'])) ? $this->_run_mod_handler('returnWebSite', true, $_tmp) : smarty_modifier_returnWebSite($_tmp))): ?>
														她/他的webSite:&nbsp;&nbsp;<a href="http://<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['review_website']; ?>
"><?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['review_website']; ?>
</a>
													<br />
													<br />												
													<?php endif; ?>
													<span style='display:none'>
													<a href='#' onclick='showReview(1,<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['rid']; ?>
)'>回复</a>&nbsp;|&nbsp;
													<a href='<?php echo $this->_tpl_vars['url']; ?>
/appReview/aid/<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['aid']; ?>
/rid/<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['rid']; ?>
'>批准</a>&nbsp;|&nbsp;

													<!--<a href='' onclick='return confirm("确认该回复为垃圾评论? 删除后将不可找回！")'>垃圾评论</a>&nbsp;|&nbsp;-->
													<a href='<?php echo $this->_tpl_vars['url']; ?>
/delReview/aid/<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['aid']; ?>
/rid/<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['rid']; ?>
<?php echo $this->_tpl_vars['page']; ?>
' onclick='return confirm("评定为垃圾评论后将不可恢复！")'>垃圾评论</a>
													<!--如果没有评论回复将不显示删除所有-->
													<?php if (((is_array($_tmp=$this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['rid'])) ? $this->_run_mod_handler('isExit', true, $_tmp, $this->_tpl_vars['counts']) : smarty_modifier_isExit($_tmp, $this->_tpl_vars['counts']))): ?>
													&nbsp;|<a href="<?php echo $this->_tpl_vars['url']; ?>
/delrReview/aid/<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['aid']; ?>
<?php echo $this->_tpl_vars['page']; ?>
" onclick='return confirm("您确认删除该评论的所有回复？")'>&nbsp;删除所有回复</a>
													<?php endif; ?>
													</span>
													<?php if (((is_array($_tmp=$this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['rid'])) ? $this->_run_mod_handler('isExit', true, $_tmp, $this->_tpl_vars['counts']) : smarty_modifier_isExit($_tmp, $this->_tpl_vars['counts']))): ?>
														<br />
														<br />
														<?php echo smarty_function_reReview(array('reviewArray' => $this->_tpl_vars['articlereReviews'],'reID' => $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['rid']), $this);?>

														<br />
														<br />
													<?php endif; ?>
													<div style='display:none' id='<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['rid']; ?>
'>
														<hr />	
														回复<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['review_email']; ?>
给《<?php echo $this->_tpl_vars['articleData']['article_title']; ?>
》的回复：
														<br />
														<br />
														<textarea name='rr_content' style='width: 976px; height: 176px;'></textarea>											
														<br />
														</br />
														<input type='submit' class='button' value='确认回复'>
														<input type='hidden' name='rid' value='<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['rid']; ?>
' />
														<input type='hidden' name='aid' value='<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['aid']; ?>
' />
														<input type='button' value='取消回复' class='button' onclick='showReview(0,<?php echo $this->_tpl_vars['articleReview'][$this->_sections['allReview']['index']]['rid']; ?>
)'/>
														<br />
														<br />
														<br />
													</div>
												</td>
											</tr>
											<tr>
												<td>&nbsp;&nbsp;</td>
											</tr>
											</form>
										<?php endfor; endif; ?>
									
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