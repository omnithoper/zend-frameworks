var viewDetails = function(semesterID) {

	$.ajax({
		url: '/semester/details', 
		data: {semesterID: semesterID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log(response);
			console.log(response.first_name);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.first_name);
			$('#semesterID').val(response.semester_id);
			$('#semesterDateStart').val(response.date_start);
			$('#semesterDateEnd').val(response.date_end);
		}
	});
}
var editSemester = function(semesterID) {

	$.ajax({
		url: '/semester/details', 
		data: {semesterID: semesterID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log(response);
			console.log(response.first_name);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.first_name);
			$('#editSemesterID').val(response.semester_id);
			$('#editDateStart').val(response.date_start);
			$('#editDateEnd').val(response.date_end);
		}
	});
}
var updateSemester = function()
{
	var semesterID = $('#editSemesterID').val();
	var dateStart = $('#editDateStart').val();
	var dateEnd = $('#editDateEnd').val();
	
	$.ajax({
		url: '/semester/update', 
		data: {
			semesterID: semesterID,
			dateStart: dateStart,
			dateEnd: dateEnd

		},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log('response');
			console.log(response);
			console.log(response.date_start);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.date_start);
			$('#editStudentID').val(response.semester_id);
			$('#editDateStart').val(response.date_start);
			$('#editDateEnd').val(response.date_end);

		}
	});	
	location.reload();	

}
var addSemester = function()
{
	var semesterID = $('#addSemesterID').val();
	var dateStart = $('#addDateStart').val();
	var dateEnd = $('#addDateEnd').val();
	
	$.ajax({
		url: '/semester/adds', 
		data: {
			semesterID: semesterID,
			dateStart: dateStart,
			dateEnd: dateEnd

		},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log('response');
			console.log(response);
			console.log(response.date_start);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.date_start);
			$('#addSemesterID').val(response.semester_id);
			$('#addDateStart').val(response.date_start);
			$('#addDateEnd').val(response.date_end);

		}
	});	
	location.reload();	

}
document.onload = function(){
};
