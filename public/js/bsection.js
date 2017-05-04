
var viewBSectionDetails = function(bSectionID) {
	$.ajax({
		url: '/bsection/details', 
		data: {bSectionID: bSectionID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			response = $.parseJSON(response);
			var table ='<table class="table table-bordered table-condensed table-striped" >'+ "<tr><th>" + 'Block Section' +"</th><th>" + 'Semester Number' + "</th><th>" + 'Subject' + "</th></tr>";
		
			for (var i = 0; i < response.length; i++) {
				table += "<tr><td>" + response[i].bsection + "</td><td>" + response[i].semester_number + "</td><td>" + response[i].subject + "</td></tr>";
			}		
		
			    table +=  "</table>";
		$(".blocksection").append(table);

		}

	});


$("#bSection-details").on("hidden.bs.modal", function(){
    $(".blocksection").html("");
   
});

}

var totalUnits = function(bSectionID) {
	$.ajax({
		url: '/bsection/totalunits', 
		data: {bSectionID: bSectionID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			response = $.parseJSON(response);
			$('#totalUnits').html(response);
		}	
	});
}

var addSubjects = function() {
	var whatID = $('.listsubject').val();
	var idExplode = whatID.split(',');
	var subjectID = idExplode[0];
	var bSectionID = idExplode[1];
	$.ajax({
		url: '/bsection/adds', 
		data: {
			subjectID: subjectID,
			bSectionID: bSectionID,

		},
	});
	location.reload();
}


var checkSubjectName = function() {
	var	whatID = [];  
	whatID.push ($('.listsubject').val());
	
	console.log(whatID);
/*
	$.ajax({
		url: '/bsection/displayaddsubjects', 
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			response = $.parseJSON(response);
			console.log(response);
	
		}
	});	
*/
	$("#bSection-details").on("hidden.bs.modal", function(){
    $(".listsubject").html("");
   
});

}

var bSectionID = function(bSectionID) {
	$.ajax({
		url: '/bsection/listsubjects', 
		data: {bSectionID: bSectionID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			response = $.parseJSON(response);
			var option ='<option value= "">' + '(Select Subject)' + "</option>" ;
			for (var i = 0; i < response.length; i++) {
				option += '<option value="' + response[i].subject_id + "," + bSectionID + '">' + response[i].subject + "</option>" ;
			}		
		$(".listsubject").append(option);

	}

});


$("#bSection-details").on("hidden.bs.modal", function(){
    $(".listsubject").html("");
   
});

}

document.onload = function(){
};


