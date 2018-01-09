<?php /* Smarty version 2.6.18, created on 2012-02-02 17:17:54
         compiled from index/index.html */ ?>
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
  <div id="content_column_two" >
    <?php unset($this->_sections['al']);
$this->_sections['al']['name'] = 'al';
$this->_sections['al']['loop'] = is_array($_loop=$this->_tpl_vars['article']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['al']['show'] = true;
$this->_sections['al']['max'] = $this->_sections['al']['loop'];
$this->_sections['al']['step'] = 1;
$this->_sections['al']['start'] = $this->_sections['al']['step'] > 0 ? 0 : $this->_sections['al']['loop']-1;
if ($this->_sections['al']['show']) {
    $this->_sections['al']['total'] = $this->_sections['al']['loop'];
    if ($this->_sections['al']['total'] == 0)
        $this->_sections['al']['show'] = false;
} else
    $this->_sections['al']['total'] = 0;
if ($this->_sections['al']['show']):

            for ($this->_sections['al']['index'] = $this->_sections['al']['start'], $this->_sections['al']['iteration'] = 1;
                 $this->_sections['al']['iteration'] <= $this->_sections['al']['total'];
                 $this->_sections['al']['index'] += $this->_sections['al']['step'], $this->_sections['al']['iteration']++):
$this->_sections['al']['rownum'] = $this->_sections['al']['iteration'];
$this->_sections['al']['index_prev'] = $this->_sections['al']['index'] - $this->_sections['al']['step'];
$this->_sections['al']['index_next'] = $this->_sections['al']['index'] + $this->_sections['al']['step'];
$this->_sections['al']['first']      = ($this->_sections['al']['iteration'] == 1);
$this->_sections['al']['last']       = ($this->_sections['al']['iteration'] == $this->_sections['al']['total']);
?>
	<div class="column_two_section">
      <h1><a href="<?php echo $this->_tpl_vars['url']; ?>
/content/aid/<?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['aid']; ?>
"><?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['article_title']; ?>
</a></h1>
      <div class="post_info"> 作者 <a href="#"><?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['article_author']; ?>
</a>&nbsp; 发表于<?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['article_time']; ?>
 </div>
     <!-- <img src="<?php echo $this->_tpl_vars['res']; ?>
/images/image_01.jpg" alt="" /> -->
      <?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['article_content']; ?>

      <div class="post_comment"> <a href="#"><span class="comment">评论数：<?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['review_num']; ?>
</span></a> </div>
    </div>
	<?php endfor; endif; ?>
	<div ><?php echo $this->_tpl_vars['fpage']; ?>
</div>
  </div>
  <!-- end of column two -->
  <div id="content_column_three">
    <!-- end of ads section -->
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
    Copyright &copy; 2024 <a href="#"><strong>freeblog TEAM</strong></a> | Author  <a href="#">卫聪 | 闫海静</a></div>
  <div class="bottom_panel_section">
    <h1>FreeBlog</h1>
    <p>欢迎大家使用，版权归&nbsp;&nbsp;<b><a href="#">freeblog team</a></b>&nbsp;&nbsp;所有 </p>
  </div>
  <div class="cleaner">&nbsp;</div>
</div>
<!-- end of bottom panel -->
</body>
</html>