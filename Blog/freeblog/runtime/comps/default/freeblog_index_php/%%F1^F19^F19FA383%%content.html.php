<?php /* Smarty version 2.6.18, created on 2012-02-02 17:37:00
         compiled from index/content.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->_tpl_vars['title']['foreground_title']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $this->_tpl_vars['title']['foreground_subtitle']; ?>
" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->_tpl_vars['res']; ?>
/js/ajax3.0.js"></script>
<script src="<?php echo $this->_tpl_vars['res']; ?>
/js/jquery-1.3.2.min.js"></script>
</head>
<body >
<div id="header_panel">
  <div id="header_section">
    <div id="title_section"><?php echo $this->_tpl_vars['title']['foreground_title']; ?>
</div>
    <div id="tagline">Give you more free Space</div>
  </div>
</div>
<!-- end of haeder -->
<div id="menu_panel">
  <div id="menu_section">
    <ul>
      <li><a href="<?php echo $this->_tpl_vars['url']; ?>
/index" class="current">首页</a></li>
      <?php echo $this->_tpl_vars['menu']; ?>

    </ul>
  </div>
</div>
<!-- end of menu -->
<div id="content">
  
  <div id="content_column_two">
    <div class="column_two_section_cont">
      <?php unset($this->_sections['cl']);
$this->_sections['cl']['name'] = 'cl';
$this->_sections['cl']['loop'] = is_array($_loop=$this->_tpl_vars['alist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cl']['show'] = true;
$this->_sections['cl']['max'] = $this->_sections['cl']['loop'];
$this->_sections['cl']['step'] = 1;
$this->_sections['cl']['start'] = $this->_sections['cl']['step'] > 0 ? 0 : $this->_sections['cl']['loop']-1;
if ($this->_sections['cl']['show']) {
    $this->_sections['cl']['total'] = $this->_sections['cl']['loop'];
    if ($this->_sections['cl']['total'] == 0)
        $this->_sections['cl']['show'] = false;
} else
    $this->_sections['cl']['total'] = 0;
if ($this->_sections['cl']['show']):

            for ($this->_sections['cl']['index'] = $this->_sections['cl']['start'], $this->_sections['cl']['iteration'] = 1;
                 $this->_sections['cl']['iteration'] <= $this->_sections['cl']['total'];
                 $this->_sections['cl']['index'] += $this->_sections['cl']['step'], $this->_sections['cl']['iteration']++):
$this->_sections['cl']['rownum'] = $this->_sections['cl']['iteration'];
$this->_sections['cl']['index_prev'] = $this->_sections['cl']['index'] - $this->_sections['cl']['step'];
$this->_sections['cl']['index_next'] = $this->_sections['cl']['index'] + $this->_sections['cl']['step'];
$this->_sections['cl']['first']      = ($this->_sections['cl']['iteration'] == 1);
$this->_sections['cl']['last']       = ($this->_sections['cl']['iteration'] == $this->_sections['cl']['total']);
?>
	<h1><a href="#"><?php echo $this->_tpl_vars['alist'][$this->_sections['cl']['index']]['article_title']; ?>
</a></h1>  
      <div class="post_info"> 作者 <a href="#"><?php echo $this->_tpl_vars['alist'][$this->_sections['cl']['index']]['article_author']; ?>
</a>&nbsp; 发表于<?php echo $this->_tpl_vars['alist'][$this->_sections['cl']['index']]['article_time']; ?>
 </div>
	 <?php echo $this->_tpl_vars['alist'][$this->_sections['cl']['index']]['article_content']; ?>

	<div class="post_comment" width="100%"><span class="comment"><a href="#">评论数：<b id="nums"><?php echo $this->_tpl_vars['alist'][$this->_sections['cl']['index']]['review_num']; ?>
</b></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='#C1'>留下评论</a></span></div>
			<hr />
			<div id='review'>
				<?php echo $this->_tpl_vars['reviewAll']; ?>

			</div>
			<!--定义锚点-->
			<a name='C1'></a>
			<div class="column_two_section_cont" style='width:575px;margin-top:50px;' id='notes'><!--回复评论输入框-->
				<form id='reContent'>
					个人昵称：<input type='text' style='width:400px' id='name'/><br />
					电子邮箱：<input type='text' style='width:400px' id='email'/><br />
					个人网站：<input type='text' style='width:400px' id='website'/><br />
					评论内容：<br />
					<textarea style='width:570px;height:200px' id='replayContent' onclick='heres()'>在此键入评论内容</textarea>
					<input type='hidden' id='aid' value='<?php echo $this->_tpl_vars['alist'][$this->_sections['cl']['index']]['aid']; ?>
' />
					<span style='background:#cdcfc9;color:#060606' onclick='subContent()'>发表评论</spanl>
				</form>
			 </div>
	  <?php endfor; endif; ?>
      <script>
	  var contents=document.getElementById('replayContent');
	  var nums=document.getElementById('nums');
	  var j='';
	  var showAll=document.getElementById('review');
	  function heres(){
			contents.innerText='';
	  }
		function subContent(){
			var name=document.getElementById('name');
			var email=document.getElementById('email');
			var website=document.getElementById('website');
			var aid=document.getElementById('aid');
			var str=name.value+'|'+email.value+'|'+website.value+'|'+contents.value+'|'+aid.value;	
				Ajax().get("<?php echo $this->_tpl_vars['url']; ?>
/sendData/str/"+str+"",function(data){
					//alert(data);
					var k=data.split('^');
					nums.innerHTML=k[1];
					j+=k[0];
					showAll.innerHTML=j;
					j='';
				})
		}
		
		function bb(obj){
			if(obj.parentNode.nextSibling.style.display=="none"){
				obj.parentNode.nextSibling.style.display="block";
			}else{
				obj.parentNode.nextSibling.style.display="none";
			}
		}
		function bb2(obj){
			obj.parentNode.parentNode.style.display="none";
		}
		//评论套评论
		var rr=document.getElementById('rr');
		function bb3(obj){
			var ids=$(obj).siblings('#rid2').val();
			var content2=$(obj).siblings('#cont2').val();
			var website2=$(obj).siblings('#web2').val();
			var email2=$(obj).siblings('#email2').val();
			var name2=$(obj).siblings('#name2').val();
			var backup=document.getElementById('backup');
			alert(backup);
			if(ids && content2 && website2 && email2 && name2){	
				//alert(ids+website2+email2+name2+content2);
				var str2=ids+','+website2+','+email2+','+name2+','+content2;
				var url2='<?php echo $this->_tpl_vars['url']; ?>
/sendData/str2/'+str2+'';
				//alert(url2);
				Ajax().get(url2,function(date){
					backup.style.display="none";
					alert(date);
				})
			}else{
				alert('请填写完整');
			}
		}
	  </script>
    </div>
    <!-- end of column two -->  </div>
  <div id="content_column_three">
     <div class="column_three_section">
      <?php echo $this->_tpl_vars['right_0']; ?>

    </div>
	 <div class="column_three_section">
     <?php echo $this->_tpl_vars['right_1']; ?>

    </div>
	<div class="column_three_section">
     <?php echo $this->_tpl_vars['right_2']; ?>

    </div>
	<div class="column_three_section">
     <?php echo $this->_tpl_vars['right_3']; ?>

    </div>
	<div class="column_three_section">
     <?php echo $this->_tpl_vars['right_4']; ?>

    </div>
	<div class="column_three_section">
     <?php echo $this->_tpl_vars['right_5']; ?>

    </div>
	<div class="column_three_section">
     <?php echo $this->_tpl_vars['right_6']; ?>

    </div>
    <div class="cleaner_with_divider">&nbsp;</div>
    <div class="column_three_section">
      <h1>About This Blog</h1>
      <p>we will give you more free space</p>
    </div>
  </div>
  <!-- end of column three -->
  <div class="cleaner">&nbsp;</div>
</div>
<!-- end of content -->
<div id="bottom_panel">
   <div class="bottom_panel_section"> <a href="#">Home</a> | <a href="#">关于我们</a> | <a href="#">联系我们</a> | email:<?php echo $this->_tpl_vars['title']['foreground_email']; ?>
<br />
    <br />
    Copyright &copy; 2024 <a href="#"><strong>freeblog TEAM</strong></a> | Author <a href="#">卫聪 | 闫海静</a></div>
  <div class="bottom_panel_section">
    <h1>FreeBlog</h1>
    <p>欢迎大家使用，版权归 &nbsp;&nbsp;<b><a href="#">freeblog team</a></b>&nbsp;&nbsp;所有 </p>
    <p> </p>
  </div>
  <div class="cleaner">&nbsp;</div>
</div>
<!-- end of bottom panel -->
</body>
</html>