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
			$('#studentID').val(response.student_id);
			$('#unang_pangalan').val(response.first_name);
			$('#apilido').val(response.last_name);
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
			$('#editStudentID').val(response.student_id);
			$('#editFirstName').val(response.first_name);
			$('#editLastName').val(response.last_name);
			$('#editUserName').val(response.username);
			$('#editPassword').val(response.password);

		}
	});
}

var updateStudent = function()
{
	var studentID = $('#editStudentID').val();
	var first_name = $('#editFirstName').val();
	var last_name = $('#editLastName').val();
	var user_name = $('#editUserName').val();
	var password = $('#editPassword').val();
	console.log(studentID);
	$.ajax({
		url: '/students/update', 
		data: {
			studentID: studentID,
			first_name: first_name,
			last_name: last_name,
			user_name: user_name,
			password: password

		},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log('response');
			console.log(response);
			console.log(response.first_name);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.first_name);
			$('#editStudentID').val(response.student_id);
			$('#editFirstName').val(response.first_name);
			$('#editLastName').val(response.last_name);
			$('#editUserName').val(response.user_name);
			$('#editPassword').val(response.password);
		}
	});	
	
	location.reload();
}
var addStudent = function()
{
	var studentID = $('#addStudentID').val();
	var first_name = $('#addFirstName').val();
	var last_name = $('#addLastName').val();
	var user_name = $('#addUserName').val();
	var password = $('#addPassword').val();
	console.log(first_name);
	console.log(last_name);
	console.log(user_name);
	console.log(password);

	$.ajax({
		url: '/students/adds', 
		data: {
			studentID: studentID,
			first_name: first_name,
			last_name: last_name,
			user_name: user_name,
			password: password

		},
		contentType: 'application/json; charset=utf-8',
		success: function(response){

			$('#addStudentID').val(response.student_id);
			$('#addFirstName').val(response.first_name);
			$('#addLastName').val(response.last_name);
			$('#addUserName').val(response.user_name);
			$('#addPassword').val(response.password);
		}
	});	
	location.reload();

}

document.onload = function(){
};
