var viewDetails = function(adminID) {

	$.ajax({
		url: '/admin/details', 
		data: {adminID: adminID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log(response);
			console.log(response.user_id);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.user_id);
			$('#adminID').html(response.user_id);
			$('#adminUser').html(response.username);
			$('#adminPass').html(response.password);
		}
	});
}
var editAdmin = function(adminID) {

	$.ajax({
		url: '/admin/details', 
		data: {adminID: adminID},
		contentType: 'application/json; charset=utf-8',
		success: function(response){
			console.log(response);
			console.log(response.user_id);
			response = $.parseJSON(response);
			console.log(response);
			console.log(response.user_id);
			$('#editAdminID').html(response.user_id);
			$('#editAdminUser').val(response.username);
			$('#editAdminPass').val(response.password);
		}
	});
}

document.onload = function(){
};
