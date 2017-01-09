function checkInput() {
	var subject = document.getElementById('subject').value;
	var subjectUnit = document.getElementById('subject_unit').value;

	if (subject == '') {
		console.log('subject IS EMPTY!!!');
		text = "input subject";
		document.getElementById("input").innerHTML = text;
		return false;
	} else if (subjectUnit == '') {
		console.log('subject unit IS EMPTY!!!');
		text = "input subject unit";
		document.getElementById("input").innerHTML = text;	
		return false;
	} else {
		console.log('EVERYTHING IS OK!!!');
		text = "do you want to save subject?";
		document.getElementById("input").innerHTML = text;	
		document.getElementById('button_save').disabled = false;
		return true;
	}
	
}

document.onload = function(){
checkInput();
};


