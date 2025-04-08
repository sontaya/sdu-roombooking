console.log("Call API");
const apiFormData = {
    code_faculty: '01'
};

$.ajax({
    url: '/api/get_personnel_profile', // Your CodeIgniter route
    type: 'POST',
    dataType: 'json',
    data: apiFormData,
	success: function(response) {
		if (response.status === 'success') {

			console.log("api->get_personnel_profile : [success]");

			var profile = response.data['profile'][0];
			console.log(profile);

		} else {
			// Handle error response
			console.error('API Error:', response.message);
			alert('Error loading faculty data');
		}
	},
    error: function(xhr, status, error) {
        console.error('Error:', error);
    }
});
