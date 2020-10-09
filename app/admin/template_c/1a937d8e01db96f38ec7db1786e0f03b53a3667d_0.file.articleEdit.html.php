<?php
/* Smarty version 3.1.32, created on 2020-10-06 14:57:26
  from 'D:\phpstudy_pro\WWW\blog\app\admin\view\article\articleEdit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5f7c1556cf4267_34287589',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a937d8e01db96f38ec7db1786e0f03b53a3667d' => 
    array (
      0 => 'D:\\phpstudy_pro\\WWW\\blog\\app\\admin\\view\\article\\articleEdit.html',
      1 => 1601967441,
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
function content_5f7c1556cf4267_34287589 (Smarty_Internal_Template $_smarty_tpl) {
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
                            <h2>博文管理</h2>
                            <p>编辑博文</p>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- START CONTENT -->
                <div class="content">
                    <div class="simplebox grid740" style="z-index: 720;">
                        <div class="titleh" style="z-index: 710;">
                            <h3>编辑博文</h3>
                        </div>
                        <div class="body" style="z-index: 690;">

                            <form id="form2" name="form2" method="post" action="index.php?p=admin&c=article&a=update">
                                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['art']->value['id'];?>
">
                                <div class="st-form-line" style="z-index: 680;">
                                    <span class="st-labeltext">标题</span>
                                    <input name="a_title" type="text" class="st-forminput" style="width:510px"
                                        value="<?php echo $_smarty_tpl->tpl_vars['art']->value['a_title'];?>
">
                                    <div class="clear" style="z-index: 670;"></div>
                                </div>
                                <div class="st-form-line" style="z-index: 640;">
                                    <span class="st-labeltext">分类</span>
                                    <select class="uniform" name="c_id">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_SESSION['categories'], 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['cat']->value['id'] == $_smarty_tpl->tpl_vars['art']->value['c_id']) {?> selected="selected" <?php }?>>
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
                                <div class="st-form-line">
                                    <span class="st-labeltext">状态</span>
                                    <select class="uniform" name="a_status">
                                        <option value="1" <?php if ($_smarty_tpl->tpl_vars['art']->value['a_status'] == 1) {?> selected="selected" <?php }?>>草稿</option>
                                        <option value="2" <?php if ($_smarty_tpl->tpl_vars['art']->value['a_status'] == 2) {?> selected="selected" <?php }?>>公开</option>
                                        <option value="3" <?php if ($_smarty_tpl->tpl_vars['art']->value['a_status'] == 3) {?> selected="selected" <?php }?>>隐藏</option>
                                    </select>
                                    <div class="clear"></div>
                                </div>
                                <div class="st-form-line" style="z-index: 620;">
                                    <span class="st-labeltext">置顶</span>
                                    <label class="margin-right10">
                                        <div class="radio">
                                            <span><input type="radio" name="a_toped" class="uniform" value="1" <?php if ($_smarty_tpl->tpl_vars['art']->value['a_toped'] == 1) {?> checked="checked" <?php }?>></span>
                                        </div> 置顶
                                    </label>
                                    <label class="margin-right10">
                                        <div class="radio">
                                            <span><input type="radio" name="a_toped" class="uniform" value="2" <?php if ($_smarty_tpl->tpl_vars['art']->value['a_toped'] == 2) {?> checked="checked" <?php }?>></span>
                                        </div> 不置顶
                                    </label>

                                    <div class="clear" style="z-index: 610;"></div>
                                </div>
                                <div class="st-form-line">
                                    <span class="st-labeltext">图片</span>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['art']->value['b_img'];?>
">
                                    <div class="clear"></div>
                                </div>
                                <div class="st-form-line">
                                    <span class="st-labeltext">新图片</span>
                                    <input type="file" name="a_img">
                                    <div class="clear"></div>
                                </div>

                                <!-- START jWYSIWYG TEXT EDITOR -->
                                <div class="simplebox grid740">
                                    <div class="titleh">
                                        <h3>内容</h3>
                                    </div>
                                    <div class="body">
                                        <textarea class="st-forminput" rows="5" cols="47" name="a_content"
                                            style="width:96.5%;"><?php echo $_smarty_tpl->tpl_vars['art']->value['a_content'];?>
</textarea>
                                    </div>

                                </div>
                                <!-- END jWYSIWYG TEXT EDITOR -->

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
