var viewBSectionDetails = function(bSectionID) {

	$.ajax({
		url: '/bsection/details', 
		data: {bSectionID: bSectionID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log(response);
			response = $.parseJSON(response);
			for (var i = 0; i < response.length; i++) {
 		
				console.log(response[i].bsection);
				console.log(response[i].semester_number);
				console.log(response[i].subject);
				
				$('#bsection').html(response[i].bsection);
				$('#semester_number').html(response[i].semester_number);
				$('#subject').html(response[i].subject);
			}		
		}

	});

	$("#bSection-details").on("hidden.bs.modal", function(){
	    $("#bsection").html("");
	    $("#semester_number").html("");
	    $("#subject").html("");
	});
}



document.onload = function(){
};
