var viewDetails = function(subjectID) {

	$.ajax({
		url: '/subjects/details', 
		data: {subjectID: subjectID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log(response);
			response = $.parseJSON(response);
			console.log(response);
			$('#subjectID').val(response.subject_id);
			$('#subjectName').val(response.subject);
			$('#subjectUnit').val(response.subject_unit);
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
			response = $.parseJSON(response);
			console.log(response);
			$('#editSubjectID').val(response.subject_id);
			$('#editSubjectName').val(response.subject);
			$('#editSubjectLec').val(response.lec_unit);
			$('#editSubjectLab').val(response.lab_unit);
			$('#editSubjectUnit').val(response.subject_unit);
			//$('#editSemesterNumber').val(response.semester_number);
		}
	});

}
var updateSubject = function()
{
	var subjectID = $('#editSubjectID').val();
	var subjectName = $('#editSubjectName').val();
	var subjectLec = $('#editSubjectLec').val();
	var subjectLab = $('#editSubjectLab').val();
	var subjectUnit = $('#editSubjectUnit').val();
	//var semesterNumber = $('#editSemesterNumber').val();
	$.ajax({
		url: '/subjects/update', 
		data: {
			subjectID: subjectID,
			subjectName: subjectName,
			subjectLec: subjectLec,
			subjectLab: subjectLab,
			subjectUnit: subjectUnit,
			//semesterNumber: semesterNumber

		},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			response = $.parseJSON(response);
			$('#editSubjectID').val(response.subject_id);
			$('#editSubjectName').val(response.subject);
			$('#editSubjectLec').val(response.lec_unit);
			$('#editSubjectLab').val(response.lab_unit);
			$('#editSubjectUnit').val(response.subject_unit);
		//	$('#editSemesterNumber').val(response.semester_number);
		}
	});	
	
	location.reload();
}
var addSubject = function()
{
	var subjectID = $('#addSubjectID').val();
	var subjectName = $('#addSubjectName').val();
	var subjectLec = $('#addSubjectLec').val();
	var subjectLab = $('#addSubjectLab').val();
	var subjectUnit = $('#addSubjectUnit').val();
	//var semesterNumber = $('#addSemesterNumber').val();
	$.ajax({
		url: '/subjects/adds', 
		data: {
			subjectID: subjectID,
			subjectName: subjectName,
			subjectLec: subjectLec,
			subjectLab: subjectLab,
			subjectUnit: subjectUnit,
		//	semesterNumber: semesterNumber

		},
		success: function(response){
			console.log('response');
			response = $.parseJSON(response);
			$('#addSubjectID').val(response.subject_id);
			$('#addSubjectName').val(response.subject);
			$('#addSubjectLec').val(response.lec_unit);
			$('#addSubjectLab').val(response.lab_unit);
			$('#addSubjectUnit').val(response.subject_unit);
		//	$('#addSemesterNumber').val(response.semester_number);
		}
	});	
	
	location.reload();
}

document.onload = function(){
	$('#subjects').hide();

};
