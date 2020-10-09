<?php
/* Smarty version 3.1.32, created on 2020-10-04 17:29:19
  from 'D:\phpstudy_pro\WWW\blog\app\admin\view\Index\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5f7995ef7462d4_84248602',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5f5e4bfd73487aeadffda0090df442a925fffc31' => 
    array (
      0 => 'D:\\phpstudy_pro\\WWW\\blog\\app\\admin\\view\\Index\\index.html',
      1 => 1601803756,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/header.html' => 1,
    'file:../Public/sidebar.html' => 1,
    'file:../Public/foot.html' => 1,
  ),
),false)) {
function content_5f7995ef7462d4_84248602 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>博客后台</title>
    <link rel="stylesheet" type="text/css" href="<?php echo P;?>
/css/app.css" />
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo P;?>
/js/app.js"><?php echo '</script'; ?>
>
</head>

<body>
    <div class="wrapper">
        <!-- START HEADER -->

        <?php $_smarty_tpl->_subTemplateRender('file:../Public/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <!-- END HEADER -->

        <!-- START MAIN -->
        <div id="main">
            <!-- START SIDEBAR -->

            <?php $_smarty_tpl->_subTemplateRender('file:../Public/sidebar.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <!-- END SIDEBAR -->

            <!-- START PAGE -->
            <div id="page">
                <!-- start page title -->
                <div class="page-title">
                    <div class="in">
                        <div class="titlebar">
                            <h2>控制面板</h2>
                            <p>小标题</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <!-- end page title -->
                <!-- START CONTENT -->
                <div class="content">
                    <!-- start simple tips -->
                    <div class="simple-tips">
                        <h2>提示</h2>
                        <ul>
                            <li>1. 使用左侧的导航菜单进入功能</li>
                            <li>2. 使用右上角的退出按钮退出管理后台</li>
                        </ul>
                        <a href="#" class="close tips" title="关闭">关闭</a>
                    </div>
                    <div class="simple-tips">
                        <h2>提示</h2>
                        <ul>
                            <li>1. 您当前使用的ip: <?php echo $_SERVER['REMOTE_ADDR'];?>
</li>
                            <li>2. PHP版本: <?php echo PHP_VERSION;?>
</li>
                            <li>3. 浏览器: <?php echo $_SERVER['HTTP_USER_AGENT'];?>
</li>
                        </ul>
                        <a href="#" class="close tips" title="关闭">关闭</a>
                    </div>

                    <!-- start dashbutton -->
                    <div class="grid740">
                        <span class="dashbutton"> <img src="<?php echo P;?>
/img/icons/dashbutton/users.png" width="44" height="32"
                                alt="icon" /> <b>用户数</b> <?php echo $_smarty_tpl->tpl_vars['counts']->value;?>
</span>
                        <div class="clear"></div>
                    </div>

                    <div class="clear"></div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END PAGE -->
            <div class="clear"></div>
        </div>
        <!-- END MAIN -->

        <!-- START FOOTER -->
        <?php $_smarty_tpl->_subTemplateRender('file:../Public/foot.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <!-- END FOOTER -->
    </div>
</body>

</html><?php }
}
