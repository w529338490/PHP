<?php /* Smarty version 2.6.18, created on 2012-02-13 17:02:47
         compiled from index/lists.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title><?php echo $this->_tpl_vars['title']['foreground_title']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $this->_tpl_vars['title']['foreground_subtitle']; ?>
" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
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
" class="current">首页</a></li>
		<?php echo $this->_tpl_vars['menu']; ?>

    </ul>
  </div>
</div>
<!-- end of menu -->
<div id="content">
  <div id="content_column_one">
   <div class="column_one_section">
     <?php echo $this->_tpl_vars['left_0']; ?>

    </div>
    
    <div class="column_one_section"><!--文章归档-->
      <?php echo $this->_tpl_vars['left_1']; ?>

    </div>
  
    <div class="column_one_section">
      <?php echo $this->_tpl_vars['left_2']; ?>

    </div>
	
	 <div class="column_one_section">
      <?php echo $this->_tpl_vars['left_3']; ?>

    </div>
	
	 <div class="column_one_section">
      <?php echo $this->_tpl_vars['left_4']; ?>

    </div>

	<div class="column_one_section">
      <?php echo $this->_tpl_vars['left_5']; ?>

    </div>
	<div class="column_one_section">
      <?php echo $this->_tpl_vars['left_6']; ?>

    </div>
	
   
  </div>
  <!-- end of column one -->
  <div id="content_column_two">
    <div class="column_two_section_list">
      <h1><a href="#"><?php echo $this->_tpl_vars['alist'][0]['article_category']; ?>
</a></h1>
      <div class="post_info"> </div>
		<div class="list">
		<ul>
			<?php unset($this->_sections['arl']);
$this->_sections['arl']['name'] = 'arl';
$this->_sections['arl']['loop'] = is_array($_loop=$this->_tpl_vars['alist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['arl']['show'] = true;
$this->_sections['arl']['max'] = $this->_sections['arl']['loop'];
$this->_sections['arl']['step'] = 1;
$this->_sections['arl']['start'] = $this->_sections['arl']['step'] > 0 ? 0 : $this->_sections['arl']['loop']-1;
if ($this->_sections['arl']['show']) {
    $this->_sections['arl']['total'] = $this->_sections['arl']['loop'];
    if ($this->_sections['arl']['total'] == 0)
        $this->_sections['arl']['show'] = false;
} else
    $this->_sections['arl']['total'] = 0;
if ($this->_sections['arl']['show']):

            for ($this->_sections['arl']['index'] = $this->_sections['arl']['start'], $this->_sections['arl']['iteration'] = 1;
                 $this->_sections['arl']['iteration'] <= $this->_sections['arl']['total'];
                 $this->_sections['arl']['index'] += $this->_sections['arl']['step'], $this->_sections['arl']['iteration']++):
$this->_sections['arl']['rownum'] = $this->_sections['arl']['iteration'];
$this->_sections['arl']['index_prev'] = $this->_sections['arl']['index'] - $this->_sections['arl']['step'];
$this->_sections['arl']['index_next'] = $this->_sections['arl']['index'] + $this->_sections['arl']['step'];
$this->_sections['arl']['first']      = ($this->_sections['arl']['iteration'] == 1);
$this->_sections['arl']['last']       = ($this->_sections['arl']['iteration'] == $this->_sections['arl']['total']);
?>
			<li><a href="<?php echo $this->_tpl_vars['url']; ?>
/content/aid/<?php echo $this->_tpl_vars['alist'][$this->_sections['arl']['index']]['aid']; ?>
"><?php echo $this->_tpl_vars['alist'][$this->_sections['arl']['index']]['article_title']; ?>
</a>
			<br/>&nbsp;&nbsp;&nbsp;作者：<?php echo $this->_tpl_vars['alist'][$this->_sections['arl']['index']]['article_author']; ?>
&nbsp;&nbsp;|&nbsp;&nbsp;评论数：<a href="#"><?php echo $this->_tpl_vars['alist'][$this->_sections['arl']['index']]['review_num']; ?>
</a>
			</li>
			<?php endfor; endif; ?>
		</ul>
		</div>
      <div class="post_comment"> <a href="#"></a> </div>
    </div>
    
  </div>
  <!-- end of column two -->
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
    <p>欢迎大家使用，版权归&nbsp;&nbsp;<b><a href="#">freeblog team</a></b>&nbsp;&nbsp;所有 </p>
  </div>
  <div class="cleaner">&nbsp;</div>
</div>
<!-- end of bottom panel -->
</body>
</html>