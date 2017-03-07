var viewDetails = function(studentID,subjectID) {

	$.ajax({
		url: '/studentGrade/details', 
		data: {studentID: studentID, 
			   subjectID: subjectID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log(response);
			console.log(response.first_name);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.first_name);
			$('#studentID').html(response.student_id);
			$('#midterm').html(response.mid_term);
			$('#finalterm').html(response.final_term);
		}
	});
}
document.onload = function(){
};
