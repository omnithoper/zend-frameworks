	$('#date_start').datepicker();
	$('#date_end').datepicker();
function checkInput() {
	var firstname = document.getElementById('first_name').value;
	var surname = document.getElementById('last_name').value;
	var username = document.getElementById('user_name').value;
	var password = document.getElementById('password').value;

	var tempName = document.getElementsByName('last_name')[0].value;

	if (firstname == '') {
		console.log('FIRSTNAME IS EMPTY!!!');
		text = "input First Name";
		document.getElementById("input").innerHTML = text;
		return false;
	} else if (surname == '') {
		console.log('SURNAME IS EMPTY!!!');
		text = "input Last Name";
		document.getElementById("input").innerHTML = text;	
		return false;
	} else if (username == '') {
		console.log('USERNAME IS EMPTY!!!');
		text = "input User Name";
		document.getElementById("input").innerHTML = text;	
		return false;
	} else if (password == '') {
		console.log('PASSWORD IS EMPTY!!!');
		text = "input Password";
		document.getElementById("input").innerHTML = text;	
		return false;		
	} else {
		console.log('EVERYTHING IS OK!!!');
		text = "do you want to save student";
		document.getElementById("input").innerHTML = text;	
		document.getElementById('button_save').disabled = false;
		return true;
	}
}

document.onload = function(){
checkInput();
};
