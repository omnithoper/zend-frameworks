function checkInput() {
	var firstname = document.getElementById('first_name').value;
	var surname = document.getElementById('last_name').value;
	var username = document.getElementById('user_name').value;
	var password = document.getElementById('password').value;

	var tempName = document.getElementsByName('last_name')[0].value;

	if (firstname == '') {
		text = "input First Name";
		document.getElementById("input").innerHTML = text;
		document.getElementById('input').classList.remove('hide');	
		document.getElementById("input").css;
		return false;
	} else if (surname == '') {
		text = "input Last Name";
		document.getElementById("input").innerHTML = text;	
		document.getElementById('input').classList.remove('hide');	
		return false;
	} else if (username == '') {
		console.log('USERNAME IS EMPTY!!!');
		text = "input User Name";
		document.getElementById("input").innerHTML = text;	
		document.getElementById('input').classList.remove('hide');		
		return false;
	} else if (password == '') {
		console.log('PASSWORD IS EMPTY!!!');
		text = "input Password";
		document.getElementById("input").innerHTML = text;	
		return false;		
	} else {
		document.getElementById('button_save').disabled = false;
		document.getElementById('input').classList.add('hide');	
		document.getElementById('input').classList.remove('hide');		
		return true;
	}
	
}

window.onload = function(){
	checkInput();
};
