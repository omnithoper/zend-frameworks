function checkInput() {

	var username = document.getElementById('user_name').value;
	var password = document.getElementById('password').value;

 	if (username == '') {
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
