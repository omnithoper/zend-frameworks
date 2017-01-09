{extends file='layout/layout.tpl'}

{block name=title}
	Editing Student
{/block}

{block name=head}
	<link type="text/css" rel="stylesheet" href="/css/mystyles.css" />
	<script type='text/javascript' src='/js/studentEdit.js'></script>
{/block}

{block name=body}
	<nav id="searchStudent">
		<div id="container">
			<div class="navbar">
				<div class="navbar-inner">
					<a class="brand" href="#">Edit Student</a>
					<form class="navbar-form pull-right">
					  	<a type="button" class="btn" href="/students">return</a>
					</form>
				</div>
			</div>
			{if (!empty($edit.error))}
				<div class="alert alert-danger">{$edit.error}</div>
			{/if}
			<div id="input" class="hide alert alert-danger"></div>
			<form id="edit-student-form" method ="POST">
				<input type="hidden" name="student_id" value="{$result.student_id}"/>
				<input class="input-medium" id ="first_name" type="text" name="first_name" value="{$result.first_name}"
				 onchange="checkInput();"> First Name<br>
				<input class="input-medium" id ="last_name" type="text" name="last_name" value="{$result.last_name}"
				onchange="checkInput();"> Last Name<br>
				<input class="btn btn-default" id="button_save" type="submit" name="edit" value="save" disabled>
			</form>
		</div>
	</nav>	
{/block}