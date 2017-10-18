

var viewDetails = function(studentID,subjectID,semesterID) {
	console.log(studentID);
	console.log(subjectID);
	console.log(semesterID);
	$.ajax({
		url: '/studentgrade/details', 
		data: {studentID: studentID, 
			   subjectID: subjectID,
			   semesterID: semesterID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
		//	console.log(response);
		//	console.log(response.first_name);
			response = $.parseJSON(response);
		//	console.log(response);
		//	console.log(response.first_name);
			$('#studentID').html(response.student_id);
			$('#midterm').html(response.mid_term);
			$('#finalterm').html(response.final_term);
			$('#totalGrade').html(response.total_grade);

		}
	});
}

$( document ).ready(function(studentID,subjectID, semesterID) {
   console.log( "ready!" );
  //  var addStudentSubjectGrade = function(studentID,subjectID,semesterID)
//{
		console.log("studentID");
		var a = document.getElementById('midTerm').value;
        var b = parseInt($('input[name=finalTerm]').val());
        var totalGrade = a+b;
        console.log("totalGrade");
        console.log("a");
        console.log("b");
	//var semesterNumber = $('#addSemesterNumber').val();
			    console.log( "ready!" );

	$.ajax({
		url: '/studentgrade/adds', 
		data: {
			totalGrade: totalGrade,
			studentID: studentID,
			subjectID: subjectID,
			semesterID: semesterID,
		//	semesterNumber: semesterNumber

		},

		success: function(response){

		}
	});	
	
$.ajax({
	url: '/studentgrade/index', 
	data: {studentID: studentID},
	data: {subjectID: subjectID},
	contentType: 'application/json; charset=utf-8',
	success: function(response){
		        console.log(response);

		response = $.parseJSON(response);
		var table ='<table class="table table-bordered table-condensed table-striped" >'+ "<tr><th>" + 'Block Section' +"</th><th>" + 'Semester Number' + "</th><th>" + 'Subject' + "</th></tr>";
	
		for (var i = 0; i < response.length; i++) {
			table += "<tr><td>" + response[i].bsection + "</td><td>" + response[i].semester_number + "</td><td>" + response[i].subject + "</td></tr>";
		}		
	
		    table +=  "</table>";
	$(".studentGrade-ajax").append(table);

	}

});


$("#bSection-details").on("hidden.bs.modal", function(){
    $(".blocksection").html("");
   
});


//}
});


document.onload = function(){
};
