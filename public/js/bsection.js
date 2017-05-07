
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
	var whatID = $(".addTableData").val();
	console.log(whatID);
		return;

	var idExplode = whatID[0].split(',');
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
	var whatID = $('.listsubject').val();
	//console.log(whatID);
	var idExplode = whatID[0].split(',');
	var subjectID = idExplode[0];
	var bSectionID = idExplode[1];
	$.ajax({
		url: '/bsection/listaddsubjects', 
		data: {
			subjectID: subjectID,
		},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			response = $.parseJSON(response);
		//	var table ='<table class="table table-bordered table-condensed table-striped" >'+ "<tr><th>" + 'Block Section' +"</th><th>" + 'Subject' + "</th></tr>";
		
			//for (var i = 0; i < response.length; i++) {
				data =   "<tr><td>" + bSectionID + "</td><td>" + response.subject + "</td></tr>";
			//}		
		
		//	    table +=  "</table>";
		$("#addTableData").append(data);
		//console.log(table);

		}	

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


