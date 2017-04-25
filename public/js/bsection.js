var viewBSectionDetails = function(bSectionID) {
	var blockSectionID = document.getElementById('blockSectionID').value;
	var studentID = document.getElementById('studentID').value;
	console.log(studentID);

	$.ajax({
		url: '/bsection/index', 
		data: {bSectionID: bSectionID},
		contentType: 'application/json; charset=utf-8',

	});
}


  $(document).on("click", ".view-admin", function () {
                 var adminid = $(this).data('id');
$("#showid").text( adminid );
                 $('#view_contact').modal('show');
            });


document.onload = function(){
};
