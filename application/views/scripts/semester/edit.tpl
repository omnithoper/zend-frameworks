{extends file='layout/layout.tpl'}

{block name=title}
	Edit Semester
{/block}

{block name=head}
			<link type="text/css" rel="stylesheet" href="/css/mystyles.css" />
			<script type='text/javascript' src='/js/vendor/jquery-3.1.1.min.js'></script>
			<script type='text/javascript' src='/js/vendor/bootstrap.min.js'></script>	
			<script type='text/javascript' src='/js/vendor/plugins/bootstrap-datepicker.js'></script>
			<script type='text/javascript' src='../../js/semesterEdit.js'></script>
		{/block}
	{block name=body}		
	<form  method ="POST">
		<nav id="searchStudent">
			<div id="container">
				<h1>Edit Semester Date</h1>
				{if (!empty($edit.error))}
					<div>
						{$edit.error}
					</div>
				{/if}
				<h3 id="input"></h3> 
				<input type="hidden" name="semester_id" value="{$view[0].semester_id}" />
				<input id="date_start" data-date-format="yyyy-mm-dd" type="text" name="date_start" value="{$view[0].date_start}" 
				onchange="checkInput();">Date Start<br>
				<input id="date_end" data-date-format="yyyy-mm-dd" type="text" name="date_end" value="{$view[0].date_end}"
				onchange="checkInput();">Date End<br>
				<input id="button_save" type="submit" name="edit" value="save" disabled>
				<a style="float:right" href="/Settings">(Return)</a>
			</div>
		</nav>		
	</form>
	<script type='text/javascript'>
	$('#date_start').datepicker();
	$('#date_end').datepicker();
</script>	

{/block}
