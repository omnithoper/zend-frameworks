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
			$('#editStudentID').html(response.student_id);
			$('#editFirstName').val(response.first_name);
			$('#editLastName').val(response.last_name);
			$('#editUserName').val(response.username);
			$('#editPassword').val(response.password);

		}
	});
}

var updateStudent = function()
{
	var studentID = $('#editStudentID').html();
	var first_name = $('#editFirstName').val();
	var last_name = $('#editLastName').val();
	var user_name = $('#editUserName').val();
	var password = $('#editPassword').val();
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
			$('#editStudentID').html(response.student_id);
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
	var studentID = $('#addStudentID').html();
	var first_name = $('#addFirstName').val();
	var last_name = $('#addLastName').val();
	var user_name = $('#addUserName').val();
	var password = $('#addPassword').val();
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
			console.log('response');
			console.log(response);
			console.log(response.first_name);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.first_name);
			$('#addStudentID').html(response.student_id);
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
