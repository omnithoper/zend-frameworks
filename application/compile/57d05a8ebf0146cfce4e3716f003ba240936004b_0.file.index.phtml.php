<?php
/* Smarty version 3.1.30, created on 2017-01-10 06:39:20
  from "C:\Users\omnithopter\Documents\zendgit\application\views\scripts\index\index.phtml" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5874819803c2b9_82109790',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57d05a8ebf0146cfce4e3716f003ba240936004b' => 
    array (
      0 => 'C:\\Users\\omnithopter\\Documents\\zendgit\\application\\views\\scripts\\index\\index.phtml',
      1 => 1483947285,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5874819803c2b9_82109790 (Smarty_Internal_Template $_smarty_tpl) {
?>


<head>
    <link type="text/css" rel="stylesheet" href="../../../../css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../../../../css/mystyles.css" />
</head>


<form>
	<h1 align="center">Enrollent System</h1>
	<div id="container"> 
		<table class="table table-bordered table-condensed table-striped"> 
			<tr><td><a href="/students" class="btn btn-block">View students</a></td></tr>
			<tr><td><a href="/subjects/" class="btn btn-block">View subjects</a></td></tr>
			<tr><td><a href="/studentsSubjects/" class="btn btn-block">Enroll</a></td></tr>
			<tr><td><a href="/settings/" class="btn btn-block">Setting</a></td></tr>
			<tr><td><a href="/admin/" class="btn btn-block">Admin</a></td></tr>
			<tr><td><a href="/income/" class="btn btn-block">Income</a></td></tr>
			<tr><td><a href="/login/logout" class="btn btn-block">Log Out</a></td></tr>
		</table>
	</div>
</form>
<?php }
}
