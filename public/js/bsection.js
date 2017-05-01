
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

var bSectionID = function(bSectionID) {
	$.ajax({
	url: '/bsection/listsubjects', 
	data: {bSectionID: bSectionID},
	contentType: 'application/json; charset=utf-8',
	success: function(response){
		response = $.parseJSON(response);
		var option ='<option value= "">' + '(Select Subject)' + "</option>" ;
		console.log(response);
		for (var i = 0; i < response.length; i++) {
			option += '<option value="' + response[i].subject_id + "," + bSectionID + '">' + response[i].subject + "</option>" ;
		}		
	console.log(option);
	$(".listsubject").append(option);

	}

});


$("#bSection-details").on("hidden.bs.modal", function(){
    $(".listsubject").html("");
   
});

}

document.onload = function(){
};


