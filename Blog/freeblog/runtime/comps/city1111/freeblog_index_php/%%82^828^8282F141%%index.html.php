<?php /* Smarty version 2.6.18, created on 2012-02-17 16:31:14
         compiled from index/index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">

<head>


  <title>FreeBlog</title>

  <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['res']; ?>
/css/html.css" media="screen, projection, tv " />
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['res']; ?>
/css/layout.css" media="screen, projection, tv" />
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['res']; ?>
/css/print.css" media="print" />

</head>


<body>

<!-- CONTENT: Holds all site content except for the footer.  This is what causes the footer to stick to the bottom -->
<div id="content">



  <!-- HEADER: Holds title, subtitle and header images -->
  <div id="header">

    <div id="title">
      <h1>FreeBlog</h1>
      
    </div>

    <img src="<?php echo $this->_tpl_vars['res']; ?>
/images/bg/balloons.gif" alt="balloons" class="balloons" />
    <img src="<?php echo $this->_tpl_vars['res']; ?>
/images/bg/header_left.jpg" alt="left slice" class="left" />
    <img src="<?php echo $this->_tpl_vars['res']; ?>
/images/bg/header_right.jpg" alt="right slice" class="right" />

  </div>



  <!-- MAIN MENU: Top horizontal menu of the site.  Use class="here" to turn the current page tab on -->
  <div id="mainMenu">
    <ul class="floatRight">
	<li><a href="#" class="here">首页</a><li>
      <?php echo $this->_tpl_vars['menu']; ?>

    </ul>
  </div>




  <!-- PAGE CONTENT BEGINS: This is where you would define the columns (number, width and alignment) -->
  <div id="page">
    <!-- 25 percent width column, aligned to the left -->
    <div class="width25 floatLeft leftColumn">

      <h1>Intro</h1>
		
      <ul class="sideMenu">
        <li class="here">
          <ul>
            <?php echo $this->_tpl_vars['left_0']; ?>

          </ul>
        </li>
      </ul>

	  <ul class="sideMenu">
        <li class="here">
          <ul>
            <?php echo $this->_tpl_vars['left_1']; ?>

          </ul>
        </li>
      </ul>

	  <ul class="sideMenu">
        <li class="here">
          <ul>
            <?php echo $this->_tpl_vars['left_2']; ?>

          </ul>
        </li>
      </ul>

	  <ul class="sideMenu">
        <li class="here">
          <ul>
            <?php echo $this->_tpl_vars['left_3']; ?>

          </ul>
        </li>
      </ul>

	  <ul class="sideMenu">
        <li class="here">
          <ul>
            <?php echo $this->_tpl_vars['left_4']; ?>

          </ul>
        </li>
      </ul>

	  <ul class="sideMenu">
        <li class="here">
          <ul>
            <?php echo $this->_tpl_vars['left_5']; ?>

          </ul>
        </li>
      </ul>

	  <ul class="sideMenu">
        <li class="here">
          <ul>
            <?php echo $this->_tpl_vars['left_6']; ?>

          </ul>
        </li>
      </ul>

      
    </div>




    <!-- 75 percent width column, aligned to the right -->
    <div class="width75 floatRight">


      <!-- Gives the gradient block -->
      <?php unset($this->_sections['al']);
$this->_sections['al']['name'] = 'al';
$this->_sections['al']['loop'] = is_array($_loop=($this->_tpl_vars['article'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	  <div class="gradient">

        <a name="coding"></a>	
        <h2><a href="<?php echo $this->_tpl_vars['url']; ?>
/content/aid/<?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['aid']; ?>
"><?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['article_title']; ?>
</a></h2>
        <ul>
			<li>作者 <a href="#"><?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['article_author']; ?>
</a></li>
			<li>发表于<?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['article_time']; ?>
</li>
			<li><a href="#"><span class="comment">评论数：<?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['review_num']; ?>
</span></a></li>
		</ul>
		<p>
          <?php echo $this->_tpl_vars['article'][$this->_sections['al']['index']]['article_content']; ?>

        </p>

        <a name="expressions"><div style="border:1px dashed white"></div></a>
		

      </div>
		<?php endfor; endif; ?>
       <div><?php echo $this->_tpl_vars['fpage']; ?>
</div>

    </div>

  </div>

</div>


<!-- FOOTER: Site footer for links, copyright, etc. -->


</body>

</html>