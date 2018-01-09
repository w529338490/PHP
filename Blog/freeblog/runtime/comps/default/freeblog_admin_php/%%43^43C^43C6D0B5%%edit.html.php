<?php /* Smarty version 2.6.18, created on 2012-02-02 17:19:52
         compiled from image/edit.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p id="page-intro">Free Blog</p>
			<div>
					<form action="<?php echo $this->_tpl_vars['url']; ?>
/edit" method="post">
					<span><a href="<?php echo $this->_tpl_vars['url']; ?>
/edit">全部图片</a> (<?php echo $this->_tpl_vars['total']; ?>
)&nbsp; | &nbsp;<a href="<?php echo $this->_tpl_vars['app']; ?>
/album/index">相册总数</a> (<?php echo $this->_tpl_vars['album_total']; ?>
)&nbsp; |  &nbsp; <a href="<?php echo $this->_tpl_vars['url']; ?>
/add">继续添加图片</a></span><br/><br/>
					<span>
					<?php echo $this->_tpl_vars['select2']; ?>

					&nbsp;&nbsp;<input type="submit" class="button" value="提交" style="height:25px;width:50px" >
					</span>&nbsp;&nbsp;&nbsp;&nbsp;
					<span>
					<input type="text"  name="search_username">
					&nbsp;&nbsp;<input type="submit" class="button" value="搜索" style="height:25px;width:50px">
					</span>
				</form>
			</div>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>图片列表</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">图片列表</a></li> <!-- href must be unique and match the id of target div -->
					</ul>
					<div class="clear"></div>	
				</div> <!-- End .content-box-header -->
				<div class="content-box-content " >	
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->	
						<table>	
							<thead>
								<tr>
								   <th>选择</th>
								   <th>图片预览</th>
								   <th>上传者</th>
								   <th>所属相册</th>
								   <th>状态</th>
								   <th>操作</th>	 
								</tr>	
							</thead>
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
			<form action="<?php echo $this->_tpl_vars['url']; ?>
/del" method="post" name="one">	
			<span onclick="alls()" class="button" >全选</span>&nbsp
			<span onclick="fans()" class="button" >反选</span>&nbsp
	<input type="submit" value="删除?" name="sub" class="button" style="height:25px;width:58px" onclick="return confirm('确定要删除您选中的用户吗？')">
	<script>
		function alls(){
			var cks=document.getElementsByName('num[]');
			for(i=0;i<cks.length;i++){
				cks[i].checked=true;
			}
		}	
		function fans(){
			var cks=document.getElementsByName('num[]');
			for(i=0;i<cks.length;i++){
				if(cks[i].checked==true){
					cks[i].checked=false;
				}else{
					cks[i].checked=true;
				}
			}
		}
		function unalls(){
			var cks=document.getElementsByName('num[]');
			for(i=0;i<cks.length;i++){
				cks[i].checked=false;
			}
		}
	</script>
							
										</div>
										<div class="pagination">
											<?php echo $this->_tpl_vars['fpage']; ?>

										</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>	 
							<tbody>
							<?php unset($this->_sections['il']);
$this->_sections['il']['name'] = 'il';
$this->_sections['il']['loop'] = is_array($_loop=$this->_tpl_vars['image']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['il']['show'] = true;
$this->_sections['il']['max'] = $this->_sections['il']['loop'];
$this->_sections['il']['step'] = 1;
$this->_sections['il']['start'] = $this->_sections['il']['step'] > 0 ? 0 : $this->_sections['il']['loop']-1;
if ($this->_sections['il']['show']) {
    $this->_sections['il']['total'] = $this->_sections['il']['loop'];
    if ($this->_sections['il']['total'] == 0)
        $this->_sections['il']['show'] = false;
} else
    $this->_sections['il']['total'] = 0;
if ($this->_sections['il']['show']):

            for ($this->_sections['il']['index'] = $this->_sections['il']['start'], $this->_sections['il']['iteration'] = 1;
                 $this->_sections['il']['iteration'] <= $this->_sections['il']['total'];
                 $this->_sections['il']['index'] += $this->_sections['il']['step'], $this->_sections['il']['iteration']++):
$this->_sections['il']['rownum'] = $this->_sections['il']['iteration'];
$this->_sections['il']['index_prev'] = $this->_sections['il']['index'] - $this->_sections['il']['step'];
$this->_sections['il']['index_next'] = $this->_sections['il']['index'] + $this->_sections['il']['step'];
$this->_sections['il']['first']      = ($this->_sections['il']['iteration'] == 1);
$this->_sections['il']['last']       = ($this->_sections['il']['iteration'] == $this->_sections['il']['total']);
?>
								<tr>
									<td><input type="checkbox" name="num[]" value="<?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['id']; ?>
"/></td>
									<td>
									<div style="width:80px;height60px;float:left">
									<a href="<?php echo $this->_tpl_vars['url']; ?>
/mod/id/<?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['root']; ?>
/public/uploads/th_<?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['name']; ?>
" style="float:left" alt="<?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['title']; ?>
" title="<?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['title']; ?>
"></a>
									</div>
										<div style="float:left;margin-left:25px;">
											<a href="<?php echo $this->_tpl_vars['url']; ?>
/mod/id/<?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['id']; ?>
" style="font-size:15px;"><?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['title']; ?>
</a><br/><br/>
											<b><?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['mime']; ?>
</b>
										</div>
									</td>
									<td><?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['up_author']; ?>
</td>	
									<td><?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['album_title']; ?>
</td>
									<?php if ($this->_tpl_vars['image'][$this->_sections['il']['index']]['postid'] != 0): ?>
									<?php unset($this->_sections['fa']);
$this->_sections['fa']['name'] = 'fa';
$this->_sections['fa']['loop'] = is_array($_loop=$this->_tpl_vars['fadd']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['fa']['show'] = true;
$this->_sections['fa']['max'] = $this->_sections['fa']['loop'];
$this->_sections['fa']['step'] = 1;
$this->_sections['fa']['start'] = $this->_sections['fa']['step'] > 0 ? 0 : $this->_sections['fa']['loop']-1;
if ($this->_sections['fa']['show']) {
    $this->_sections['fa']['total'] = $this->_sections['fa']['loop'];
    if ($this->_sections['fa']['total'] == 0)
        $this->_sections['fa']['show'] = false;
} else
    $this->_sections['fa']['total'] = 0;
if ($this->_sections['fa']['show']):

            for ($this->_sections['fa']['index'] = $this->_sections['fa']['start'], $this->_sections['fa']['iteration'] = 1;
                 $this->_sections['fa']['iteration'] <= $this->_sections['fa']['total'];
                 $this->_sections['fa']['index'] += $this->_sections['fa']['step'], $this->_sections['fa']['iteration']++):
$this->_sections['fa']['rownum'] = $this->_sections['fa']['iteration'];
$this->_sections['fa']['index_prev'] = $this->_sections['fa']['index'] - $this->_sections['fa']['step'];
$this->_sections['fa']['index_next'] = $this->_sections['fa']['index'] + $this->_sections['fa']['step'];
$this->_sections['fa']['first']      = ($this->_sections['fa']['iteration'] == 1);
$this->_sections['fa']['last']       = ($this->_sections['fa']['iteration'] == $this->_sections['fa']['total']);
?>
									<?php if ($this->_tpl_vars['image'][$this->_sections['il']['index']]['id'] == $this->_tpl_vars['fadd'][$this->_sections['fa']['index']]['id']): ?>
										<td><a href="<?php echo $this->_tpl_vars['app']; ?>
/articleOther/viewArticle/aid/<?php echo $this->_tpl_vars['fadd'][0]['aid']; ?>
"><?php echo $this->_tpl_vars['fadd'][$this->_sections['fa']['index']]['article_title']; ?>
</a>&nbsp;&nbsp;&nbsp;--->&nbsp;<a href="<?php echo $this->_tpl_vars['url']; ?>
/del_fadd/id/<?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['id']; ?>
">移除</a>
										</td>
									<?php endif; ?>
									<?php endfor; endif; ?>
									<?php else: ?>
										<td><a href="<?php echo $this->_tpl_vars['url']; ?>
/fadd/id/<?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['id']; ?>
">附加</td>
									<?php endif; ?>
									<td>
										<!-- 小图标 -->
										 <a href="<?php echo $this->_tpl_vars['url']; ?>
/mod/id/<?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['id']; ?>
" title="修改"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/hammer_screwdriver.png" alt="修改" /></a>
										 <a href="<?php echo $this->_tpl_vars['url']; ?>
/del/id/<?php echo $this->_tpl_vars['image'][$this->_sections['il']['index']]['id']; ?>
" title="删除"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross.png" alt="删除" onclick="return confirm('确定要删除吗？')" ></a> 					 
									</td>
								</tr>
								
							<?php endfor; else: ?>
									<tr>
										<td>暂无数据</td>
									</tr>
							<?php endif; ?>
							</tbody>	
							</form>
						</table>
						<script>
							function show(){
								var box=document.getElementById('showbox');
								box.style.display="block";
							}
						</script>	
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


