<?php
/* Smarty version 3.1.39, created on 2021-05-13 17:45:09
  from 'D:\PhpStormProject\myframe\resources\views\student.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_609cf5256f9556_11932906',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fb632157a0cc843e773453fd5ab2d462571e959a' => 
    array (
      0 => 'D:\\PhpStormProject\\myframe\\resources\\views\\student.html',
      1 => 1620898793,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_609cf5256f9556_11932906 (Smarty_Internal_Template $_smarty_tpl) {
?><!--
 * @Author: your name
 * @Date: 2021-05-11 20:17:47
 * @LastEditTime: 2021-05-13 10:43:10
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
  <form action="update" method="POST">
    <div>
      <label for="name">姓名：</label>
      <input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
">
    </div>

    <div>
      <label for="gender">性别：</label>
      <input type="text" name="gender" id="gender" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['gender'];?>
">
    </div>

    <div>
      <label for="email">性别：</label>
      <input type="text" name="email" id="email" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
">
    </div>

    <div>
      <label for="mobile">性别：</label>
      <input type="text" name="mobile" id="mobile" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['mobile'];?>
">
    </div>

    <div>
      <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
    </div>

    <div>
      <input type="submit" value="提交">
    </div>


  </form>
</body>
</html>
<?php }
}
