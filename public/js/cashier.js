var computeChange = function() {
	
	var cash = document.getElementById('cash').value;
	var amount = document.getElementById('amount').value;
	var change = cash - amount;

	document.getElementById('change').value = change;	
	document.getElementById('change_display').classList.remove('hide');	
	console.log(document.getElementById('change_display'));
};

function checkPayment() {
	
	if (Number(cash) < Number(amount)) {
		console.log('not enough cash');
		return false;
	} else {
		console.log('EVERYTHING IS OK!!!');
		document.getElementById('button_save').disabled = false;
		return true;
	}
	
}


window.onload = function(){
	document.getElementById('change_display').classList.add('hide');
	console.log(document.getElementById('change_display'));
};


