<?php
/* Smarty version 3.1.32, created on 2020-10-08 15:11:42
  from 'D:\phpstudy_pro\WWW\blog\app\admin\view\comment\commentIndex.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5f7ebbae141827_16214451',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13862173540f5ee8b3570d285f24e041a8235e27' => 
    array (
      0 => 'D:\\phpstudy_pro\\WWW\\blog\\app\\admin\\view\\comment\\commentIndex.html',
      1 => 1602141098,
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
function content_5f7ebbae141827_16214451 (Smarty_Internal_Template $_smarty_tpl) {
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
                            <h2>评论管理</h2>
                            <p>评论列表</p>
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
                            <h3>评论列表</h3>
                        </div>

                        <table id="myTable" class="tablesorter">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>作者</th>
                                    <th>内容</th>
                                    <th>博文名</th>
                                    <th>评论时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['comments']->value, 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['c']->value['u_username'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['c']->value['c_comment'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['c']->value['a_title'];?>
</td>
                                    <td><?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['c']->value['c_time']);?>
</td>
                                    <td>
                                        <a href="index.php?p=admin&c=comment&a=delete&id=<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
"
                                            onclick="return confirm('确认删除当前评论？')">删除</a>
                                    </td>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <?php echo $_smarty_tpl->tpl_vars['pagestr']->value;?>

                        </ul>
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
