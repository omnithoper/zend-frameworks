<?php
/* Smarty version 3.1.30, created on 2017-01-09 07:34:07
  from "C:\Users\omnithopter\Documents\zend\application\views\scripts\students\index.phtml" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58733cefb28951_35877012',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a14fe0f80f3540bf863e4ea19191280d8eb02a70' => 
    array (
      0 => 'C:\\Users\\omnithopter\\Documents\\zend\\application\\views\\scripts\\students\\index.phtml',
      1 => 1483947225,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58733cefb28951_35877012 (Smarty_Internal_Template $_smarty_tpl) {
?>

<head>
    <link type="text/css" rel="stylesheet" href="../../../../css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../../../../css/mystyles.css" />
</head>

	<nav id ="searchStudent">
		<div id="container">
			<div class="navbar">
				<div class="navbar-inner">
						<h1>Subject Records</h1>
					<form class="navbar-form pull-right">
					  	<a type="button" class="btn" href="/">return</a>
					</form>
				</div>
			</div>
			<form>
				<a style="float:left"  href="/logic/studentPaginated.php">(paginated)</a>
				<a class="pull-right btn btn-success" href="/students/add">
					<i class="icon-plus"></i>
				</a>
			</form>

			<?php if ((empty($_smarty_tpl->tpl_vars['student']->value))) {?>
				<div class="alert alert-info">No students yet</div>
			<?php } else { ?>
				<table class="table table-bordered table-condensed table-striped"> 
					<p id="delete"></p>
					<tr>
						<th>ID</th>
						<th>FirstName</th>
						<th>LastName</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['student']->value, 'details');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['details']->value) {
?>
						<tr>
						<td align="center"><?php echo $_smarty_tpl->tpl_vars['details']->value['student_id'];?>
</td>
						<td align="center"><?php echo $_smarty_tpl->tpl_vars['details']->value['first_name'];?>
</td>
						<td	align="center"><?php echo $_smarty_tpl->tpl_vars['details']->value['last_name'];?>
</td>
						<td align="center"><?php echo $_smarty_tpl->tpl_vars['details']->value['payed'];?>
</td>
						<td style="width: 1px; wrap: nowrap;" nowrap>
							<a href='/students/edit?student_id=<?php echo $_smarty_tpl->tpl_vars['details']->value['student_id'];?>
' class="btn" title="edit Student"> 
								<i class="icon icon-edit"></i>
							</a>

							<a id="href_delete"href='students/delete?student_id=<?php echo $_smarty_tpl->tpl_vars['details']->value['student_id'];?>
' 
						class="btn btn-danger" title="Delete Student"> 
								<i class="icon icon-remove"></i>
							</a>

							<?php if (($_smarty_tpl->tpl_vars['details']->value['payed'] == 'paid')) {?>
								<a id="href_delete"href='students/download?student_id=<?php echo $_smarty_tpl->tpl_vars['details']->value['student_id'];?>
' 
								class="btn btn-success" title="download invoice"> 
									<i class="icon icon-download"></i>
								</a>
							<?php }?>	
						</td>
						</tr>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

				</table>
			<?php }?>
		</div>
	</nav>
<?php }
}
