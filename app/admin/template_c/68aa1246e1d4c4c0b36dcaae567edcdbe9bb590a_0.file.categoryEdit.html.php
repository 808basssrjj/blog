<?php
/* Smarty version 3.1.32, created on 2020-10-05 16:23:05
  from 'D:\phpstudy_pro\WWW\blog\app\admin\view\category\categoryEdit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5f7ad7e9d734b0_10993219',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '68aa1246e1d4c4c0b36dcaae567edcdbe9bb590a' => 
    array (
      0 => 'D:\\phpstudy_pro\\WWW\\blog\\app\\admin\\view\\category\\categoryEdit.html',
      1 => 1601886184,
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
function content_5f7ad7e9d734b0_10993219 (Smarty_Internal_Template $_smarty_tpl) {
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
                            <h2>分类管理</h2>
                            <p>编辑分类</p>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- START CONTENT -->
                <div class="content">
                    <div class="simplebox grid740" style="z-index: 720;">
                        <div class="titleh" style="z-index: 710;">
                            <h3>编辑分类</h3>
                        </div>
                        <div class="body" style="z-index: 690;">

                            <form id="form2" name="form2" method="post" action="index.php?p=admin&c=category&a=update">
                                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
                                <div class="st-form-line" style="z-index: 680;">
                                    <span class="st-labeltext">名称</span>
                                    <input name="c_name" type="text" class="st-forminput" style="width:510px"
                                        value="<?php echo $_SESSION['categories'][$_smarty_tpl->tpl_vars['id']->value]['c_name'];?>
">
                                    <div class="clear" style="z-index: 670;"></div>
                                </div>
                                <div class="st-form-line" style="z-index: 640;">
                                    <span class="st-labeltext">父分类</span>
                                    <select name="c_parent_id" class="uniform">
                                        <option value="0">无</option>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['cat']->value['id'] == $_SESSION['categories'][$_smarty_tpl->tpl_vars['id']->value]['c_parent_id']) {?>selected='selected' <?php }?>>
                                            <?php echo str_repeat('----',$_smarty_tpl->tpl_vars['cat']->value['level']);
echo $_smarty_tpl->tpl_vars['cat']->value['c_name'];?>

                                        </option>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </select>
                                    <div class="clear"></div>
                                </div>
                                <div class="st-form-line" style="z-index: 680;">
                                    <span class="st-labeltext">排序</span>
                                    <input name="c_sort" type="text" class="st-forminput" style="width:510px"
                                        value="<?php echo $_SESSION['categories'][$_smarty_tpl->tpl_vars['id']->value]['c_sort'];?>
">
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
