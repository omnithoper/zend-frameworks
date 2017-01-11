{extends file='layout/layout.tpl'}

{block name=title}
	Add Semester
{/block}

{block name=head}
		<link type="text/css" rel="stylesheet" href="/css/mystyles.css" />
		<script type='text/javascript' src='/js/vendor/jquery-3.1.1.min.js'></script>
		<script type='text/javascript' src='/js/vendor/bootstrap.min.js'></script>	
		<script type='text/javascript' src='/js/vendor/plugins/bootstrap-datepicker.js'></script>
		<script type='text/javascript' src='/js/semesterAdd.js'></script>
	{/block}
	{block name=body} 
	<form id="add-student-form" method ="POST">
	<nav id ="searchStudent">
		<div id="container"> 
			<h1>Add Semester</h1>
			{if (!empty($result.error))}
				<div>
					{$result.error}
				</div>
			{/if} 
			<h3 id="input"></h3>
			<input id="date_start" data-date-format="yyyy-mm-dd" type="text" name="date_start" onchange="checkInput();" value="{$dateStart}" /> Date Start<br/>
			<input id="date_end" data-date-format="yyyy-mm-dd" type="text" name="date_end" onchange="checkInput();" value="{$dateEnd}" /> Date End<br/>
			
			<input class="btn" id="button_save" type="submit" name="save" value="save" disabled />		
			<a style="float:right" href="/Settings">(Return)</a>
		</div>
	</nav>	
	</form>
<script type='text/javascript'>
	$('#date_start').datepicker();
	$('#date_end').datepicker();
</script>	
	{/block}
