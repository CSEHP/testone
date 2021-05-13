<?php
/* Smarty version 3.1.39, created on 2021-05-13 17:41:39
  from 'D:\PhpStormProject\myframe\resources\views\students.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_609cf45340a121_83606995',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '412f582e66ade0fecf465c7a95ea44a595839ef3' => 
    array (
      0 => 'D:\\PhpStormProject\\myframe\\resources\\views\\students.html',
      1 => 1620898793,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_609cf45340a121_83606995 (Smarty_Internal_Template $_smarty_tpl) {
?><!--
 * @Author: your name
 * @Date: 2021-05-11 20:17:47
 * @LastEditTime: 2021-05-13 10:11:11
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \myframe\resources\views\students.html
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生信息列表</title>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>性别</th>
            <th>编辑</th>
        </tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['gender'];?>
</td>
                <td><a href="getOne?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">编辑</a></td>
            </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>
</body>
</html>
<?php }
}
