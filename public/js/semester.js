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
			$('#semesterID').html(response.semester_id);
			$('#semesterDateStart').html(response.date_start);
			$('#semesterDateEnd').html(response.date_end);
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
			$('#editSemesterID').html(response.semester_id);
			$('#editDateStart').val(response.date_start);
			$('#editDateEnd').val(response.date_end);
		}
	});
}
var updateSemester = function()
{
	var semesterID = $('#editSemesterID').html();
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
			$('#editStudentID').html(response.semester_id);
			$('#editDateStart').val(response.date_start);
			$('#editDateEnd').val(response.date_end);

		}
	});	
	location.reload();	

}
var addSemester = function()
{
	var semesterID = $('#addSemesterID').html();
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
			$('#addSemesterID').html(response.semester_id);
			$('#addDateStart').val(response.date_start);
			$('#addDateEnd').val(response.date_end);

		}
	});	
	location.reload();	

}
document.onload = function(){
};
