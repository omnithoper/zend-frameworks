
var viewBSectionDetails = function(bSectionID) {
	//console.log(bSectionID);
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

/*
var addSubjects = function() {
	var TableData;
	var TableData = new Array();
	    
	$('#addTableData tr').each(function(row, tr){
	    TableData[row]={
	    	"bSectionID" : $(tr).find('td:eq(0)').text()
	        , "subject_id" : $(tr).find('td:eq(1)').text()
	        , "subject" :$(tr).find('td:eq(2)').text()
	       
	    }

	}); 
	TableData.shift();  

	$.ajax({
		url: '/bsection/adds', 
		data: {
			TableData: TableData,
		},
	});
//	location.reload();
}

*/

var checkSubjectAdd = function() {

	var whatID = $('.listsubject').val();
	var idExplode = whatID.split(',');
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
			data =   "<tr><td>" + bSectionID + "</td><td>" + response.subject_id + "</td><td>" + response.subject + "</td></tr>";
		
	
		$("#addTableData").append(data);

		var seen = {};
			$('#addTableData tr').each(function() {
    		var txt = $(this).text();
    		if (seen[txt])
        		$(this).remove();
    		else
        		seen[txt] = true;
		});

		}	

	});
$("#bSection-details").on("hidden.bs.modal", function(){
    $("#addTableData").html("");
   
});
}

var checkSubjectDelete= function() {

	var whatID = $('.deleteblocksection').val();
	console.log(whatID);
	var idExplode = whatID.split(',');
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
			data =   "<tr><td>" + bSectionID + "</td><td>" + response.subject_id + "</td><td>" + response.subject + "</td></tr>";
		
	
		$("#deleteTableData").append(data);

		var seen = {};
			$('#deleteTableData tr').each(function() {
    		var txt = $(this).text();
    		if (seen[txt])
        		$(this).remove();
    		else
        		seen[txt] = true;
		});

		}	

	});

$("#bSection-details").on("hidden.bs.modal", function(){
    $("#deleteTableData").html("");
   
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

var deletebSectionSubjects = function(bSectionID) {
	$.ajax({
		url: '/bsection/bsectionsubjects', 
		data: {bSectionID: bSectionID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			response = $.parseJSON(response);
			var option ='<option value= "">' + '(Select Subject)' + "</option>" ;
			for (var i = 0; i < response.length; i++) {
				option += '<option value="' + response[i].subject_id + "," + bSectionID + '">' + response[i].subject + "</option>" ;
			}		
		$(".deleteblocksection").append(option);
	}

});

$("#bSection-delete").on("hidden.bs.modal", function(){
    $(".deleteblocksection").html("");
   
});

}

$(document).ready(function(){
	$('#bs').click(function() {
		var TableData;
		var TableData = new Array();
		    
		$('#addTableData tr').each(function(row, tr){
		    TableData[row]={
		    	"bSectionID" : $(tr).find('td:eq(0)').text()
		        , "subject_id" : $(tr).find('td:eq(1)').text()
		        , "subject" :$(tr).find('td:eq(2)').text()
		       
		    }

		}); 
		TableData.shift();  

		$.ajax({
			url: '/bsection/adds', 
			data: {
				TableData: TableData,
			},
		});

				alert('Subject added. Reload the page please.');
		location.reload();
	});
});


$(document).ready(function(){
	$('#bSDelete').click(function() {
		var TableData;
		var TableData = new Array();
		    
		$('#deleteTableData tr').each(function(row, tr){
		    TableData[row]={
		    	"bSectionID" : $(tr).find('td:eq(0)').text()
		        , "subject_id" : $(tr).find('td:eq(1)').text()
		        , "subject" :$(tr).find('td:eq(2)').text()
		       
		    }

		}); 
		TableData.shift();  

		$.ajax({
			url: '/bsection/deletesubjects', 
			data: {
				TableData: TableData,
			},
		});

				alert('Subject deleted. Reload the page please.');
		location.reload();
	});
});


document.onload = function(){
};

