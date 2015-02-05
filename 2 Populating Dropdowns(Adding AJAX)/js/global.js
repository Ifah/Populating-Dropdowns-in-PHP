$('#user-select').on('change', function(){
	var self = $(this);

	$.ajax({
		url: 'http://localhost:8080/Populating%20Dropdowns%20in%20PHP/2%20Populating%20Dropdowns(Adding%20AJAX)/partials/user.php',
		type: 'GET',
		data: { user: self.val()},
		success: function(data){
			$('#user-profile').html(data);
		}
	});
});