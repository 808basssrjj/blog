<?php
/* Smarty version 3.1.32, created on 2020-10-08 14:27:30
  from 'D:\phpstudy_pro\WWW\blog\app\admin\view\category\categoryIndex.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5f7eb15204ec28_39310447',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '48173a8590630ba755d6506fbb547b6473f5f0d2' => 
    array (
      0 => 'D:\\phpstudy_pro\\WWW\\blog\\app\\admin\\view\\category\\categoryIndex.html',
      1 => 1602138169,
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
function content_5f7eb15204ec28_39310447 (Smarty_Internal_Template $_smarty_tpl) {
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
                            <p>分类列表</p>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- START CONTENT -->
                <div class="content">
                    <!-- START TABLE -->
                    <div class="simplebox grid740">

                        <div class="titleh">
                            <h3>分类列表</h3>
                        </div>

                        <table id="myTable" class="tablesorter">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>名称</th>
                                    <th>下属博文数量</th>
                                    <th>排序</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_SESSION['categories'], 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
</td>
                                    <td><?php echo str_repeat('----',$_smarty_tpl->tpl_vars['cat']->value['level']);
echo $_smarty_tpl->tpl_vars['cat']->value['c_name'];?>
</td>
                                    <td><?php echo (($tmp = @$_smarty_tpl->tpl_vars['c_count']->value[$_smarty_tpl->tpl_vars['cat']->value['id']])===null||$tmp==='' ? 0 : $tmp);?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['cat']->value['c_sort'];?>
</td>
                                    <td>
                                        <a href="index.php?p=admin&c=category&a=edit&id=<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
">编辑</a>
                                        <a href="index.php?p=admin&c=category&a=delete&id=<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
"
                                            onClick="return confirm('确认删除：<?php echo $_smarty_tpl->tpl_vars['cat']->value['c_name'];?>
 分类？')">删除</a>
                                    </td>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END TABLE -->
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
