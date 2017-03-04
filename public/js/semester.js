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

document.onload = function(){
};