
function checkSubjectName() {

	var subjectName = document.getElementById('subject_list').value;
	var list = document.getElementById('list').value;
	// var payed = document.getElementById('payed').value;
	// console.log(payed);

	if (subjectName == '(Select Subject)') {
		console.log('Select a Subject');
		return false;	
	} else {
		console.log('EVERYTHING IS OK!!!');
		document.getElementById('button_save').disabled = false;
		return true;
	}

	if (list == '(Select Block Section)') {
		console.log('Select Block Section');
		return false;	
	} else {
		console.log('EVERYTHING IS OK!!!');
		document.getElementById('button_save').disabled = false;
		return true;
	}
	/*
	if (payed == '') {
		console.log('student is not yet  payed');
		return false;
	} else {
		console.log('EVERYTHING IS OK!!!');
		document.getElementById('payment').disables = false;
		return true;
	}
	*/
	
}

document.onload = function(){
checkInput();
checkSubjectName();
};

