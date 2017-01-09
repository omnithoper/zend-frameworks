<?php
/* Smarty version 3.1.30, created on 2017-01-09 07:34:14
  from "c:\Users\omnithopter\Documents\zend\application\views\scripts\login\index.phtml" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58733cf655ff85_36944932',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab66186e2b5628f94a700fd23356f3c5c66ce349' => 
    array (
      0 => 'c:\\Users\\omnithopter\\Documents\\zend\\application\\views\\scripts\\login\\index.phtml',
      1 => 1483947215,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58733cf655ff85_36944932 (Smarty_Internal_Template $_smarty_tpl) {
?>

<head>
    <link type="text/css" rel="stylesheet" href="../../../../css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../../../../css/mystyles.css" />
</head>
<form method = "post" action="/login/login">
    
      <nav id="searchStudent"> 
         <div id = "container">
           <h2>Enter Username and Password</h2>
   <?php if ((!empty($_smarty_tpl->tpl_vars['error']->value))) {?>
   <h4 class = "form-signin-heading"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
   <?php }?>
   <input type = "text" class = "form-control" name = "username" placeholder = "username" required autofocus></br>
   <input type = "password" class = "form-control" name = "password" placeholder = "password" required autofocus>
   <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
      name = "login">Login</button>
         </div> 
      </nav>   
</form>
<?php }
}
