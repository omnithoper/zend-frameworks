var viewDetails = function(studentID) {

	$.ajax({
		url: '/students/details', 
		data: {studentID: studentID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log(response);
			console.log(response.first_name);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.first_name);
			$('#studenID').html(response.student_id);
			$('#unang_pangalan').html(response.first_name);
			$('#apilido').html(response.last_name);
		}
	});
}

var editStudent = function(studentID)
{
	$.ajax({
		url: '/students/details', 
		data: {studentID: studentID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log('response');
			console.log(response);
			console.log(response.first_name);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.first_name);
			$('#student-edit #studenID').html(response.student_id);
			$('#student-edit #unang_pangalan').val(response.first_name);
			$('#student-edit #apilido').val(response.last_name);
		}
	});
}
document.onload = function(){
};
