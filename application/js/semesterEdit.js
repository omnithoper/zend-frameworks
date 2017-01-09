function checkInput() {
	var dateStart = document.getElementById('date_start').value;
	var dateEnd = document.getElementById('date_end').value;

	if (dateStart == '') {
		console.log('Date Start IS EMPTY!!!');
		text = "input Date Start";
		document.getElementById("input").innerHTML = text;
		return false;
	} else if (dateEnd == '') {
		console.log('Date End unit IS EMPTY!!!');
		text = "input Date End";
		document.getElementById("input").innerHTML = text;	
		return false;
	} else {
		console.log('EVERYTHING IS OK!!!');
		text = "do you want to save Semester?";
		document.getElementById("input").innerHTML = text;	
		document.getElementById('button_save').disabled = false;
		return true;
	}
	
}

document.onload = function(){
checkInput();
};

