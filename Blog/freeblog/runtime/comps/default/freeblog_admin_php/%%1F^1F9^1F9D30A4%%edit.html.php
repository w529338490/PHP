<?php /* Smarty version 2.6.18, created on 2012-02-28 21:49:26
         compiled from flink/edit.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p id="page-intro">Free Blog</p>
			<div>
					<span><a href="#">全部链接</a> (<?php echo $this->_tpl_vars['link_num']; ?>
)&nbsp; | &nbsp;<a href="#">显示状态</a> (<?php echo $this->_tpl_vars['dis_num']; ?>
)&nbsp; </span><br/><br/>	
			</div>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>友情链接列表</h3>	
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">友情链接列表</a></li> <!-- href must be unique and match the id of target div -->
					</ul>
					<div class="clear"></div>	
				</div> <!-- End .content-box-header -->
				<div class="content-box-content " >	
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->	
						<table>	
							<thead>
								<tr>
								   <th>选择</th>
								   <th>排序</th>
								   <th>网站url</th>
								   <th>链接描述</th>
								   <th>联系人</th>
								   <th>联系人邮箱</th>
								   <th>显示状态</th>
								   <th>编辑</th>
								</tr>	
							</thead>
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
			<form action="<?php echo $this->_tpl_vars['url']; ?>
/del" method="post">	
			<a href="#" onclick="alls()" class="button">全选</a>&nbsp;
			<a href="#" onclick="fans()" class="button">反选</a>&nbsp;
	<input type="submit" value="删除?" name="sub" class="button" style="height:25px;width:58px" onclick="return confirm('确定要删除您选中的用户吗？')">&nbsp;<a href="#" name="aj"  class="button" onclick="show()">保存排序</a><div style="display:none;border:3px solid #e7e7e7;margin-left:10px;padding:3px;" id="show2" onclick="show3(this)"></div>
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
							<?php unset($this->_sections['ls']);
$this->_sections['ls']['name'] = 'ls';
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['link']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ls']['show'] = true;
$this->_sections['ls']['max'] = $this->_sections['ls']['loop'];
$this->_sections['ls']['step'] = 1;
$this->_sections['ls']['start'] = $this->_sections['ls']['step'] > 0 ? 0 : $this->_sections['ls']['loop']-1;
if ($this->_sections['ls']['show']) {
    $this->_sections['ls']['total'] = $this->_sections['ls']['loop'];
    if ($this->_sections['ls']['total'] == 0)
        $this->_sections['ls']['show'] = false;
} else
    $this->_sections['ls']['total'] = 0;
if ($this->_sections['ls']['show']):

            for ($this->_sections['ls']['index'] = $this->_sections['ls']['start'], $this->_sections['ls']['iteration'] = 1;
                 $this->_sections['ls']['iteration'] <= $this->_sections['ls']['total'];
                 $this->_sections['ls']['index'] += $this->_sections['ls']['step'], $this->_sections['ls']['iteration']++):
$this->_sections['ls']['rownum'] = $this->_sections['ls']['iteration'];
$this->_sections['ls']['index_prev'] = $this->_sections['ls']['index'] - $this->_sections['ls']['step'];
$this->_sections['ls']['index_next'] = $this->_sections['ls']['index'] + $this->_sections['ls']['step'];
$this->_sections['ls']['first']      = ($this->_sections['ls']['iteration'] == 1);
$this->_sections['ls']['last']       = ($this->_sections['ls']['iteration'] == $this->_sections['ls']['total']);
?>
								<tr>
									<td ><input type="checkbox" name="num[]" value="<?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['id']; ?>
"/></td>
									<td><input type="text" name="oder[]" value="<?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['oder']; ?>
" style="width:20px;height:13px;" id="px"></td>
									<td ><?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['link_name']; ?>
</td>
									<td><a href="<?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['link_url']; ?>
" title="<?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['link_description']; ?>
" target="_ablank"><?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['link_url']; ?>
</a></td>
									<td><?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['link_body']; ?>
</td>
									<td><?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['link_body_email']; ?>
</td>
									<?php if ($this->_tpl_vars['link'][$this->_sections['ls']['index']]['disable']): ?>
									<td>显示</td>
									<?php else: ?>
									<td>不显示</td>
									<?php endif; ?>
									<td>
										<!-- 小图标 -->
										 <a href="<?php echo $this->_tpl_vars['url']; ?>
/update/id/<?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['id']; ?>
/" title="修改"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/hammer_screwdriver.png" alt="修改" /></a>
										 <a href="<?php echo $this->_tpl_vars['url']; ?>
/del/id/<?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['id']; ?>
" title="删除"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross.png" alt="删除" onclick="return confirm('确定要删除<?php echo $this->_tpl_vars['link'][$this->_sections['ls']['index']]['link_name']; ?>
链接吗？')" ></a> 
									</td>
								</tr>
							<?php endfor; endif; ?>
							</tbody>	
						</table>
						</form>	
					</div> 
					<script>
					function show(){
						var oder=document.getElementsByName('oder[]');
						var num=document.getElementsByName('num[]');
						var arr='';
						var idarr='';
						var show2=document.getElementById('show2');
						for(var i=0;i<oder.length;i++){
							 arr+=oder[i].value+',';
							 idarr+=num[i].value+',';
						}
						var newarr=arr+'|'+idarr;
						var urls='<?php echo $this->_tpl_vars['url']; ?>
/order/str/'+newarr+'';
							Ajax().get(urls,function(date){
								if(date==1){
									if(show2.style.display=="none"){
										show2.style.display="inline";
										show2.innerHTML="<b>保存成功</b>";
									}else{
										show2.style.display="none";
									}
								}else{
									if(show2.style.display=="none"){
										show2.style.display="inline";
										show2.innerHTML="<b>您还没有改变排序</b>";
									}else{
										show2.style.display="none";
									}	
								}
							})
						}
						function show3(obj){
							obj.style.display="none";
						}
					</script>		
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->		
			<div class="clear"></div>
			<!--页面底部-->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>





