<?php /* Smarty version 2.6.18, created on 2012-02-02 17:35:13
         compiled from categoryManage/createArticle.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p id="page-intro">Free Blog</p>
<!-- 			<div>
				<span>文章总数(<?php echo $this->_tpl_vars['articleData']['allTotal']; ?>
)&nbsp; | &nbsp;有效文章数(<?php echo $this->_tpl_vars['articleData']['vaildTotal']; ?>
)&nbsp; | &nbsp;<a href='<?php echo $this->_tpl_vars['app']; ?>
/articleManage/viewRecycle'>回收站</a>(<?php echo $this->_tpl_vars['articleData']['invaildTotal']; ?>
)&nbsp; | &nbsp;<a href="<?php echo $this->_tpl_vars['app']; ?>
/articleManage/clearRecycle" onclick="return confirm('您确定清空回收站？')">清空回收站</a></span><br/><br/>
			</div> -->
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>快速发表</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">快速发表</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content " >
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<form action='<?php echo $this->_tpl_vars['app']; ?>
/articleOther/addArticle' method='post'>
							<table>
								<thead>
									<tr>
										<td>
											<input type='text' name='article_title' style='height:30px;width:500px;font-size:25px;color:#A9A9A9;' value='在此键入标题'/>
										</td>
										<td>
											<b>文章类别:</b>&nbsp;&nbsp;<?php echo $this->_tpl_vars['Cname']; ?>

											<input type="hidden" name="article_category" value='<?php echo $this->_tpl_vars['Cname']; ?>
'/>
											<!-- <input type='text' value='' -->
										</td>
									</tr>
									<tr>
										<td>
											<b>可见性:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type='radio' name='article_authority' value='1'/>仅自己&nbsp;&nbsp;&nbsp;&nbsp;
											<input type='radio' name='article_authority' value='2'/>好友&nbsp;&nbsp;&nbsp;&nbsp;
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