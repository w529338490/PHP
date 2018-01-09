<?php /* Smarty version 2.6.18, created on 2012-02-02 17:20:00
         compiled from dataManage/operSet.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'checkeds', 'dataManage/operSet.html', 32, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--
/*******************************************************************************************************************************************
作者：闫海静 
功能：该页面主要用来显示操作记录页面的设置
********************************************************************************************************************************************/
-->
			<p id="page-intro">Free Blog</p>
			<div>
			</div>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>记录管理-详细设置</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">详细设置</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content " >
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<table>
							<tbody style=''>
								<form action="<?php echo $this->_tpl_vars['url']; ?>
/editNote/operType/userManage" method='post'>
									<tr>
										<td colspan='4'><h3>用户管理</h3></td>
									</tr>
									<tr>
										<td>屏蔽用户&nbsp;&nbsp;<input type='checkbox' name='shield_name' value='1' <?php echo smarty_function_checkeds(array('operType' => 'shield_name','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td>单个删除用户&nbsp;&nbsp;<input type='checkbox' name='single_del_user' value='1' <?php echo smarty_function_checkeds(array('operType' => 'single_del_user','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td>批量删除用户&nbsp;&nbsp;<input type='checkbox' name='multi_del_user' value='1' <?php echo smarty_function_checkeds(array('operType' => 'multi_del_user','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td>修改用户信息&nbsp;&nbsp;<input type='checkbox' name='edit_userinfo' value='1' <?php echo smarty_function_checkeds(array('operType' => 'edit_userinfo','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td colspan='4' align='right'>添加用户&nbsp;&nbsp;<input type='checkbox' name='add_user' value='1' <?php echo smarty_function_checkeds(array('operType' => 'add_user','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td><input type='submit' value='保存修改' class='button'/></td>
									</tr>
								</form>
							</tbody>
						</table>
						<table>
							<tbody style=''>
								<form action="<?php echo $this->_tpl_vars['url']; ?>
/editNote/operType/userGroupManage" method='post'>
									<tr>
										<td colspan='3'><h3>用户分组管理</h3></td>
									</tr>
									<tr>
										<td align='right'>添加分组&nbsp;&nbsp;<input type='checkbox' name='add_user_group' value='1' <?php echo smarty_function_checkeds(array('operType' => 'add_user_group','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>删除分组&nbsp;&nbsp;<input type='checkbox' name='del_user_group' value='1' <?php echo smarty_function_checkeds(array('operType' => 'del_user_group','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>修改分组信息&nbsp;&nbsp;<input type='checkbox' name='edit_user_group' value='1' <?php echo smarty_function_checkeds(array('operType' => 'edit_user_group','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td colspan='4'><input type='submit' value='保存修改' class='button'/></td>
									</tr>
								</form>
							</tbody>
						</table>
						<table>
							<tbody style=''>
								<form action='<?php echo $this->_tpl_vars['url']; ?>
/editNote/operType/articleManage' method='post'>
									<tr>
										<td colspan='4'><h3>文章管理</h3></td>
									</tr>
									<tr>
										<td align='right'>发表文章&nbsp;&nbsp;<input type='checkbox' name='issue_article' value='1' <?php echo smarty_function_checkeds(array('operType' => 'issue_article','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>文章修改&nbsp;&nbsp;<input type='checkbox' name='article_edit' value='1' <?php echo smarty_function_checkeds(array('operType' => 'article_edit','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>回收文章&nbsp;&nbsp;<input type='checkbox' name='recyle_article' value='1' <?php echo smarty_function_checkeds(array('operType' => 'recyle_article','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>删除文章&nbsp;&nbsp;<input type='checkbox' name='single_del_userinfo' value='1' <?php echo smarty_function_checkeds(array('operType' => 'single_del_userinfo','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td colspan='1' align='right'>批量删除文章&nbsp;&nbsp;<input type='checkbox' name='multi_del_article' value='1' <?php echo smarty_function_checkeds(array('operType' => 'multi_del_article','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td colspan='1' align='right'>清空回收站&nbsp;&nbsp;<input type='checkbox' name='clear_recyle_article' value='1' <?php echo smarty_function_checkeds(array('operType' => 'clear_recyle_article','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td colspan='1' align='right'>还原文章&nbsp;&nbsp;<input type='checkbox' name='restore_article' value='1' <?php echo smarty_function_checkeds(array('operType' => 'restore_article','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td colspan='1' align='right'>批量还原文章&nbsp;&nbsp;<input type='checkbox' name='multi_restore_article' value='1' <?php echo smarty_function_checkeds(array('operType' => 'multi_restore_article','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td colspan='4'><input type='submit' value='保存修改' class='button'/></td>
									</tr>
								</form>
							</tbody>
						</table>
						<table>
							<tbody style=''>
								<form action='<?php echo $this->_tpl_vars['url']; ?>
/editNote/operType/articleGroupManage' method='post'>
									<tr>
										<td colspan='3'><h3>文章分组管理</h3></td>
									</tr>
									<tr>
										<td align='right'>添加分组&nbsp;&nbsp;<input type='checkbox' name='add_atricle_group' value='1' <?php echo smarty_function_checkeds(array('operType' => 'add_atricle_group','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>删除分组&nbsp;&nbsp;<input type='checkbox' name='del_article_group' value='1' <?php echo smarty_function_checkeds(array('operType' => 'del_article_group','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>修改分组信息&nbsp;&nbsp;<input type='checkbox' name='edit_article_group' value='1' <?php echo smarty_function_checkeds(array('operType' => 'edit_article_group','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td colspan='4'><input type='submit' value='保存修改' class='button'/></td>
									</tr>
								</form>
							</tbody>
						</table>
						<table>
							<tbody style=''>
								<form action='<?php echo $this->_tpl_vars['url']; ?>
/editNote/operType/imageManage' method='post'>
									<tr>
										<td colspan='4'><h3>图片管理</h3></td>
									</tr>
									<tr>
										<!--所有的input 标签中没有结束符 是通过插件的形式来补全-->
										<td align='right'>添加图片&nbsp;&nbsp;<input type='checkbox' name='add_image' value='1' <?php echo smarty_function_checkeds(array('operType' => 'add_image','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>单个删除图片&nbsp;&nbsp;<input type='checkbox' name='single_del_image' value='1' <?php echo smarty_function_checkeds(array('operType' => 'single_del_image','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>多个删除图片&nbsp;&nbsp;<input type='checkbox' name='multi_del_image' value='1' <?php echo smarty_function_checkeds(array('operType' => 'multi_del_image','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>附加图片&nbsp;&nbsp;<input type='checkbox' name='attachment_image' value='1' <?php echo smarty_function_checkeds(array('operType' => 'attachment_image','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td colspan='4' align='right'>修改图片信息&nbsp;&nbsp;<input type='checkbox' name='edit_image' value='1' <?php echo smarty_function_checkeds(array('operType' => 'edit_image','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td colspan='4'><input type='submit' value='保存修改' class='button'/></td>
									</tr>
								</form>
							</tbody>
						</table>
						<table>
							<tbody style=''>
								<form action='<?php echo $this->_tpl_vars['url']; ?>
/editNote/operType/imageAlbumManage' method='post'>
									<tr>
										<td colspan='3'><h3>相册管理</h3></td>
									</tr>
									<tr>
										<td align='right'>添加分组&nbsp;&nbsp;<input type='checkbox' name='add_photo_album' value='1' <?php echo smarty_function_checkeds(array('operType' => 'add_photo_album','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>删除分组&nbsp;&nbsp;<input type='checkbox' name='del_photo_album' value='1' <?php echo smarty_function_checkeds(array('operType' => 'del_photo_album','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>修改分组信息&nbsp;&nbsp;<input type='checkbox' name='edit_photo_album' value='1' <?php echo smarty_function_checkeds(array('operType' => 'edit_photo_album','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td colspan='3'><input type='submit' value='保存修改' class='button'/></td>
									</tr>
								</form>
							</tbody>
						</table>
						<table>
							<tbody style=''>
								<form action='<?php echo $this->_tpl_vars['url']; ?>
/editNote/operType/webManage' method='post'>
									<tr>
										<td colspan='4'><h3>网站管理</h3></td>
									</tr>
									<tr>
										<td align='right'>修改标题&nbsp;&nbsp;<input type='checkbox' name='edit_title' value='1' <?php echo smarty_function_checkeds(array('operType' => 'edit_title','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>修改副标题&nbsp;&nbsp;<input type='checkbox' name='edit_subtitle' value='1' <?php echo smarty_function_checkeds(array('operType' => 'edit_subtitle','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>修改管理员邮箱&nbsp;&nbsp;<input type='checkbox' name='edit_admin_email' value='1' <?php echo smarty_function_checkeds(array('operType' => 'edit_admin_email','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>保留上传数据文件&nbsp;&nbsp;<input type='checkbox' name='save_upload_file' value='1' <?php echo smarty_function_checkeds(array('operType' => 'save_upload_file','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td align='right' colspan='4'>网站状态&nbsp;&nbsp;<input type='checkbox' name='webstat' value='1' <?php echo smarty_function_checkeds(array('operType' => 'webstat','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td colspan='4'><input type='submit' value='保存修改' class='button'/></td>
									</tr>
								</form>
							</tbody>
						</table>
						<table>
							<tbody style=''>
								<form action='<?php echo $this->_tpl_vars['url']; ?>
/editNote/operType/dataManage' method='post'>
									<tr>
										<td colspan='4'><h3>数据管理</h3></td>
									</tr>
									<tr>
										<td align='right'>导入数据&nbsp;&nbsp;<input type='checkbox' name='import_data_file' value='1' <?php echo smarty_function_checkeds(array('operType' => 'import_data_file','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>清空上传数据&nbsp;&nbsp;<input type='checkbox' name='clear_data_file' value='1' <?php echo smarty_function_checkeds(array('operType' => 'clear_data_file','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>excel导出&nbsp;&nbsp;<input type='checkbox' name='excel_save' value='1' <?php echo smarty_function_checkeds(array('operType' => 'excel_save','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>txt导出&nbsp;&nbsp;<input type='checkbox' name='txt_save' value='1' <?php echo smarty_function_checkeds(array('operType' => 'txt_save','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
									</tr>
									<tr>
										<td colspan='4'><input type='submit' value='保存修改' class='button'/></td>
									</tr>
								</form>
							</tbody>
						</table>
						<table>
							<tbody style=''>
								<form action='<?php echo $this->_tpl_vars['url']; ?>
/editNote/operType/operManage' method='post'>
									<tr>
										<td colspan='4'><h3>操作记录</h3></td>
									</tr>
									<tr>
										<td align='right'>记录删除&nbsp;&nbsp;<input type='checkbox' name='del_oper' value='1' <?php echo smarty_function_checkeds(array('operType' => 'del_oper','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>记录保存&nbsp;&nbsp;<input type='checkbox' name='save_oper' value='1' <?php echo smarty_function_checkeds(array('operType' => 'save_oper','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<!--<td align='right'>记录查看&nbsp;&nbsp;<input type='checkbox' name='view_oper' value='1' <?php echo smarty_function_checkeds(array('operType' => 'view_oper','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>-->
										<td align='right'>&nbsp;</td>
									</tr>
									<tr>
										<td colspan='4'><input type='submit' value='保存修改' class='button'/></td>
									</tr>
								</form>
							</tbody>
						</table>
						<table>
							<tbody style=''>
								<form action='<?php echo $this->_tpl_vars['url']; ?>
/editNote/operType/templManage' method='post'>
									<tr>
										<td colspan='4'><h3>模板管理</h3></td>
									</tr>
									<tr>
										<td align='right'>模板启用&nbsp;&nbsp;<input type='checkbox' name='templ_start' value='1' <?php echo smarty_function_checkeds(array('operType' => 'templ_start','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>模板上传&nbsp;&nbsp;<input type='checkbox' name='templ_upload' value='1' <?php echo smarty_function_checkeds(array('operType' => 'templ_upload','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>模板删除&nbsp;&nbsp;<input type='checkbox' name='templ_del' value='1' <?php echo smarty_function_checkeds(array('operType' => 'templ_del','operArr' => $this->_tpl_vars['operAuthors']), $this);?>
</td>
										<td align='right'>&nbsp;&nbsp;</td>
									</tr>
									<tr>
										<td colspan='4'><input type='submit' value='保存修改' class='button'/></td>
									</tr>
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