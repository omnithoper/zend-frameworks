{extends file='layout/layout.tpl'}

{block name=title}
	ADD Student
{/block}

{block name=head}
		<link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="/css/mystyles.css" />
		<script type='text/javascript' src='/js/studentAdd.js'></script>
{/block}
{block name=body}
	<form id="add-student-form" method ="POST">
	<nav id ="searchStudent">
		<div id="container"> 
			<h1>Add Student</h1>
			{if (!empty($result.error))}
				<div>
					{$result.error}
				</div>
			{/if} 
			<h3 id="input"></h3>
			<input id="first_name" type="text" name="first_name" onchange="checkInput();" /> First Name<br/>
			<input id="last_name" type="text" name="last_name" onchange="checkInput();" /> Last Name<br/>
			<input class="btn" id="button_save" type="submit" name="save" value="save" disabled />		
			<a style="float:right" href="/students">(Return)</a>
		</div>
	</nav>	
	</form>

{/block}