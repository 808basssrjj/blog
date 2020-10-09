<?php
/* Smarty version 3.1.32, created on 2020-10-07 10:48:12
  from 'D:\phpstudy_pro\WWW\blog\app\admin\view\user\userIndex.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5f7d2c6c2d7d93_95365224',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '39e6f05069600a87541cd8472c11b3e2ded33c3a' => 
    array (
      0 => 'D:\\phpstudy_pro\\WWW\\blog\\app\\admin\\view\\user\\userIndex.html',
      1 => 1602038886,
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
function content_5f7d2c6c2d7d93_95365224 (Smarty_Internal_Template $_smarty_tpl) {
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
?>>
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
                            <p>用户列表</p>
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
                            <h3>用户列表</h3>
                        </div>

                        <table id="myTable" class="tablesorter">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>用户名</th>
                                    <th>角色</th>
                                    <th>注册时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value) {
$__foreach_user_0_saved = $_smarty_tpl->tpl_vars['user'];
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['user']->key+1;?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['u_username'];?>
</td>
                                    <td><?php if ($_smarty_tpl->tpl_vars['user']->value['u_is_admin'] == 1) {?>管理员<?php } else { ?>普通用户<?php }?></td>
                                    <td><?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['user']->value['u_reg_time']);?>
</td>
                                    <td>
                                        <a href="index.php?p=admin&c=user&a=delete&id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"
                                            onClick="return confirm('确认删除当前用户：<?php echo $_smarty_tpl->tpl_vars['user']->value['u_username'];?>
 ?')">删除</a>
                                    </td>
                                </tr>
                                <?php
$_smarty_tpl->tpl_vars['user'] = $__foreach_user_0_saved;
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
