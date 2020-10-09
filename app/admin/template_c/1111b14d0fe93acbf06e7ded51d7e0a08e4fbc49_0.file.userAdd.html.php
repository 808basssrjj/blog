<?php
/* Smarty version 3.1.32, created on 2020-10-05 20:07:30
  from 'D:\phpstudy_pro\WWW\blog\app\admin\view\user\userAdd.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5f7b0c826a9d20_01853327',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1111b14d0fe93acbf06e7ded51d7e0a08e4fbc49' => 
    array (
      0 => 'D:\\phpstudy_pro\\WWW\\blog\\app\\admin\\view\\user\\userAdd.html',
      1 => 1601899227,
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
function content_5f7b0c826a9d20_01853327 (Smarty_Internal_Template $_smarty_tpl) {
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
                            <h2>用户管理</h2>
                            <p>添加用户</p>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- START CONTENT -->
                <div class="content">
                    <div class="simplebox grid740" style="z-index: 720;">
                        <div class="titleh" style="z-index: 710;">
                            <h3>添加用户</h3>
                        </div>
                        <div class="body" style="z-index: 690;">

                            <form id="form2" name="form2" method="post" action="index.php?p=admin&c=user&a=insert">
                                <div class="st-form-line" style="z-index: 680;">
                                    <span class="st-labeltext">用户名</span>
                                    <input name="u_username" type="text" class="st-forminput" style="width:510px"
                                        value="">
                                    <div class="clear" style="z-index: 670;"></div>
                                </div>
                                <div class="st-form-line" style="z-index: 680;">
                                    <span class="st-labeltext">密码</span>
                                    <input name="u_password" type="text" class="st-forminput" style="width:510px"
                                        value="">
                                    <div class="clear" style="z-index: 670;"></div>
                                </div>
                                <div class="st-form-line" style="z-index: 680;">
                                    <span class="st-labeltext">角色</span>
                                    <label class="margin-right10"><input type="radio" name="u_is_admin" value="0"
                                            checked class="uniform" /> 普通用户</label>
                                    <label class="margin-right10"><input type="radio" name="u_is_admin" value="1"
                                            class="uniform" /> 管理员</label>
                                    <div class="clear" style="z-index: 670;"></div>
                                </div>



                                <div class="button-box" style="z-index: 460;">
                                    <input type="submit" id="button" value="提交" class="st-button">
                                </div>
                            </form>

                        </div>
                    </div>
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
