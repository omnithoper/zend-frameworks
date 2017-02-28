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
var editSubject = function(subjectID)
{
	$.ajax({
		url: '/subjects/details', 
		data: {subjectID: subjectID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log('response');
			console.log(response);
			console.log(response.first_name);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.first_name);
			$('#editSubjectID').html(response.subject_id);
			$('#editSubjectName').val(response.subject);
			$('#editSubjectLec').val(response.lec_unit);
			$('#editSubjectLab').val(response.lab_unit);
			$('#editSubjectUnit').val(response.subject_unit);

		}
	});
}
var updateSubject = function()
{
	var subjectID = $('#editSubjectID').html();
	var subjectName = $('#editSubjectName').val();
	var subjectLec = $('#editSubjectLec').val();
	var subjectLab = $('#editSubjectLab').val();
	var subjectUnit = $('#editSubjectUnit').val();
	$.ajax({
		url: '/subjects/update', 
		data: {
			subjectID: subjectID,
			subjectName: subjectName,
			subjectLec: subjectLec,
			subjectLab: subjectLab,
			subjectUnit: subjectUnit

		},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log('response');
			console.log(response);
			console.log(response.subjectName);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.subjectName);
			$('#editSubjectID').html(response.subject_id);
			$('#editSubjectName').val(response.subject);
			$('#editSubjectLec').val(response.lec_unit);
			$('#editSubjectLab').val(response.lab_unit);
			$('#editSubjectUnit').val(response.subject_unit);
		}
	});	
	
	location.reload();
}
var addSubject = function()
{
	var subjectID = $('#addSubjectID').html();
	var subjectName = $('#addSubjectName').val();
	var subjectLec = $('#addSubjectLec').val();
	var subjectLab = $('#addSubjectLab').val();
	var subjectUnit = $('#addSubjectUnit').val();
	$.ajax({
		url: '/subjects/adds', 
		data: {
			subjectID: subjectID,
			subjectName: subjectName,
			subjectLec: subjectLec,
			subjectLab: subjectLab,
			subjectUnit: subjectUnit

		},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log('response');
			console.log(response);
			console.log(response.subjectName);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.subjectName);
			$('#addSubjectID').html(response.subject_id);
			$('#addSubjectName').val(response.subject);
			$('#addSubjectLec').val(response.lec_unit);
			$('#addSubjectLab').val(response.lab_unit);
			$('#addSubjectUnit').val(response.subject_unit);
		}
	});	
	
	location.reload();
}

document.onload = function(){
};
