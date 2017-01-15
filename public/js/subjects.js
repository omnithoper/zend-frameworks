var viewDetails = function(subjectID) {

	$.ajax({
		url: '/subjects/details', 
		data: {subjectID: subjectID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log(response);
			console.log(response.first_name);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.first_name);
			$('#subjectID').html(response.subject_id);
			$('#subjectName').html(response.subject);
			$('#subjectUnit').html(response.subject_unit);
		}
	});
}
alert("die");
document.onload = function(){
};
