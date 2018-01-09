<?php /* Smarty version 2.6.18, created on 2018-01-10 00:26:55
         compiled from user/index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>留言本</title>
    <link href="<?php echo $this->_tpl_vars['res']; ?>
/css/message.css" rel="stylesheet" type="text/css">
</head>
<body>

<a> <?php echo $this->_tpl_vars['uname']; ?>
 </a> <br>
<a> <?php echo $this->_tpl_vars['isok']; ?>
  </a>

<div id="flink">
    友情连接:

    <?php unset($this->_sections['link']);
$this->_sections['link']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['link']['name'] = 'link';
$this->_sections['link']['show'] = true;
$this->_sections['link']['max'] = $this->_sections['link']['loop'];
$this->_sections['link']['step'] = 1;
$this->_sections['link']['start'] = $this->_sections['link']['step'] > 0 ? 0 : $this->_sections['link']['loop']-1;
if ($this->_sections['link']['show']) {
    $this->_sections['link']['total'] = $this->_sections['link']['loop'];
    if ($this->_sections['link']['total'] == 0)
        $this->_sections['link']['show'] = false;
} else
    $this->_sections['link']['total'] = 0;
if ($this->_sections['link']['show']):

            for ($this->_sections['link']['index'] = $this->_sections['link']['start'], $this->_sections['link']['iteration'] = 1;
                 $this->_sections['link']['iteration'] <= $this->_sections['link']['total'];
                 $this->_sections['link']['index'] += $this->_sections['link']['step'], $this->_sections['link']['iteration']++):
$this->_sections['link']['rownum'] = $this->_sections['link']['iteration'];
$this->_sections['link']['index_prev'] = $this->_sections['link']['index'] - $this->_sections['link']['step'];
$this->_sections['link']['index_next'] = $this->_sections['link']['index'] + $this->_sections['link']['step'];
$this->_sections['link']['first']      = ($this->_sections['link']['iteration'] == 1);
$this->_sections['link']['last']       = ($this->_sections['link']['iteration'] == $this->_sections['link']['total']);
?>
    <a href="<?php echo $this->_tpl_vars['data'][$this->_sections['link']['index']]['username']; ?>
"><?php echo $this->_tpl_vars['data'][$this->_sections['link']['index']]['username']; ?>
</a>
    <?php endfor; endif; ?>

    <ul>
       <?php unset($this->_sections['foo']);
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
$this->_sections['foo']['step'] = 1;
$this->_sections['foo']['start'] = $this->_sections['foo']['step'] > 0 ? 0 : $this->_sections['foo']['loop']-1;
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = $this->_sections['foo']['loop'];
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>
        <li>
            <?php if ($this->_tpl_vars['data'][$this->_sections['foo']['index']]['username'] == 'li bai'): ?>
               aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                <?php else: ?>
                bbbbbbbbbbbbbbbbbbb
            <?php endif; ?>
        </li>
        <?php endfor; endif; ?>
    </ul>
</div>

<div id="main">
    <div id="header">
        <div id="logo"><img src="<?php echo $this->_tpl_vars['res']; ?>
/images/logo.gif" alt="留言本实例"></div>
        <div id="search">
            <a> <?php echo '<?php'; ?>
 echo "asdasd" <?php echo '?>'; ?>
 </a>
            <form action="<?php echo $this->_tpl_vars['url']; ?>
/login" method="post" name="login">
                用户名：<input name="username" size="12" type="text">
                密码：<input name="password" size="12" type="password">
                <input type="hidden" value="login"  name="action"/>
                <input name="do"  value="登 陆 " class="button" type="submit">
            </form>
        </div>
    </div>

    <div id="left" >
        <h3><?php echo '<?php'; ?>
 echo $infoCount;<?php echo '?>'; ?>
条留言</h3>
        <fieldset>
            <legend>发表留言</legend>
            <form action="<{$url}/user>" method="post" name="frm" onsubmit="return test();">
                <table border="0" cellpadding="5" cellspacing="0" width="0">
                    <tbody><tr>
                        <td width="20%">留言标题</td><td><input name="title" size="30" type="text" /></td>
                    </tr>
                    <tr>
                        <td>用户网名</td><td><input name="username"  value="" size="30" type="text" /></td>
                    </tr>
                    <tr>
                        <td>内容</td><td><textarea name="content" cols="42" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input name="action" value="insert" type="hidden">
                            <input value=" 提 交 " class="button" type="submit">
                        </td>
                    </tr>
                    </tbody></table>
            </form>
        </fieldset>
    </div>

    <div id="footer">&#169;&nbsp;2011&nbsp;www.houdunwang.com</div>

</div>

</body></html>