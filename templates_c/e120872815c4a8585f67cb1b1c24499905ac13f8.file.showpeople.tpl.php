<?php /* Smarty version Smarty-3.1-DEV, created on 2015-01-15 15:38:36
         compiled from "./templates/showpeople.tpl" */ ?>
<?php /*%%SmartyHeaderCode:130373297854b7444c24d941-88290553%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e120872815c4a8585f67cb1b1c24499905ac13f8' => 
    array (
      0 => './templates/showpeople.tpl',
      1 => 1421296688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '130373297854b7444c24d941-88290553',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'people' => 0,
    'person' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_54b7444c270f94_87050616',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b7444c270f94_87050616')) {function content_54b7444c270f94_87050616($_smarty_tpl) {?><!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>People known to Rasmus</title>
    </head>
    <body>
        <div id="content">

            <h1>People in the data table</h1>
            
            <table border="1">
                <tr><th>Name</th><th>Age</th></tr>
                <?php  $_smarty_tpl->tpl_vars['person'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['person']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['people']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['person']->key => $_smarty_tpl->tpl_vars['person']->value){
$_smarty_tpl->tpl_vars['person']->_loop = true;
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['person']->value[0];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['person']->value[1];?>
</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </body>

</html><?php }} ?>