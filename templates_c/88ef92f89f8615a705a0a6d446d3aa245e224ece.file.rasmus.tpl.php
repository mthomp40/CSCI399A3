<?php /* Smarty version Smarty-3.1-DEV, created on 2015-01-19 09:46:33
         compiled from "./templates/rasmus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:185079654254bc37c990c9e2-93862582%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88ef92f89f8615a705a0a6d446d3aa245e224ece' => 
    array (
      0 => './templates/rasmus.tpl',
      1 => 1421291721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '185079654254bc37c990c9e2-93862582',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'name' => 0,
    'age' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_54bc37ca00fdb0_28044097',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bc37ca00fdb0_28044097')) {function content_54bc37ca00fdb0_28044097($_smarty_tpl) {?><!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Smarty Rasmus</title>
    </head>
    <body>
        <div id="content">

            <h1>Rasmus demo form brought to you by <?php echo 'Smarty-3.1-DEV';?>
</h1>
            <h2>G'day</h2>
            <p>You said your name was <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</p>
            <p>You said that your age was <?php echo $_smarty_tpl->tpl_vars['age']->value;?>
</p>
   
        </div>
    </body>

</html><?php }} ?>