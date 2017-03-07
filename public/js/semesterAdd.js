

function checkInput() {
	var datestart = document.getElementById('date_start').value;
	var dateend = document.getElementById('date_end').value;

	
	if (datestart == '') {
		console.log('DATE START IS EMPTY!!!');
		text = "input Date Start";
		document.getElementById("input").innerHTML = text;
		return false;
	} else if (dateend == '') {
		console.log('DATE END IS EMPTY!!!');
		text = "input Date End";
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
