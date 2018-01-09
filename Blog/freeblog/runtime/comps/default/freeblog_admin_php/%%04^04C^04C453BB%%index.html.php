<?php /* Smarty version 2.6.18, created on 2012-02-02 17:22:47
         compiled from tool/index.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/tool_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<p id="page-intro">Free Blog</p>
			<br/><br/>
			<div class="clear"></div> <!-- End .clear -->	
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>FreeBlog系统简介</h3>			
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">FreeBlog系统简介</a></li> <!-- href must be unique and match the id of target div -->	
					</ul>			
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->			
				<div class="content-box-content " >	
				<div class="notification attention png_bg">
				<a href="#" class="close"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/icons/cross_grey_small.png" title="关闭友情提醒" alt="关闭" /></a>
				<div>
					友情提醒：如需自定义两边的侧边栏，只需拖动你需要的模块覆盖原有的即可 
				</div>
				</div>
	
	<div class="demo" >
	<table>
	<tr><td>
	<div style="float:left;font-weight:bold;">自定义左边栏</div><br/>
	<div class="column"  style="border:3px solid #878787;float:left;" id="left">
		
	</div>
	<div class="box" style="margin-left:26px;float:left;border:3px solid gray;text-align:center">
	<div class="column" >
		<div class="portlet">
			<div id="a_category_list" class="portlet-header">分类列表</div>
			<div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
		</div>
		<div class="portlet">
			<div id="a_time_list" class="portlet-header">文章归档</div>
			<div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
		</div>
	</div>
	<div class="column" >
		<div class="portlet">
			<div id="a_newarticle_list" class="portlet-header">最新文章</div>
			<div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
		</div>
		<div class="portlet">
			<div id="a_search_list" class="portlet-header">友情链接</div>
			<div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
		</div>
	</div>
	<div class="column" >
		<div class="portlet">
			<div id="a_comment_list" class="portlet-header">近期评论</div>
			<div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
		</div>
		<div class="portlet">
			<div id="u_populer_list" class="portlet-header">活跃用户</div>
			<div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
		</div>
	</div>
	</div>
	<div style="float:right;width:129px;font-weight:bold;margin-top:-17px">自定义右边栏</div><br/>
	<div class="column"  style="border:3px solid #878787;float:right;margin-top:-17px" id="right">
		
	</div>
	<td></tr>
	<tr>
		<td >
		<div style="text-align:center;">
		<input type="button" value="保存" class="button" id="tijiao" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" class="button" value="重置">
		</div>
		</td>
	</tr>
</table>
<script>
	var l="";
	var	r="";	
	$('#tijiao').click(function(){
	if($('#left>div').length){
	for(var i=0;i<$('#left>div').length;i++){	
		 l+=$('#left>div').children('.portlet-header:eq('+i+')').attr('id')+',';
	}
		var url1="<?php echo $this->_tpl_vars['url']; ?>
/left/lid/"+l+"";
		Ajax().get(url1,function(date){
			//$('#left').appendTo('div').addClass('portlet-header').attr('id','asdas');
			if(date==1){
				alert('保存左边栏成功');
			}
		})
		l="";
	}
	
	//右边栏
	if($('#right>div').length){
		for(var i=0;i<$('#right>div').length;i++){		
			r+=$('#right>div').children('.portlet-header:eq('+i+')').attr('id')+',';
		}
			var url2="<?php echo $this->_tpl_vars['url']; ?>
/left/rid/"+r+"";
			Ajax().get(url2,function(date){
				if(date==1){
					alert('保存右边栏成功');
				}
			})
			r="";
		}
	})
</script>
</div><!-- End demo -->
</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->		
			<div class="clear"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public/foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>