<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Demo</title>
</head>
<body>
	<form action="">
		<input type="tel" name="hrcode" id="hrcode" value="2020-052">
		<input type="button" id="btnsend" value="send">
	</form>


	<script>var BASE_URL = "<?php echo base_url(); ?>";</script>

	<script src="<?= base_url('assets/js/jquery-3.6.0.js'); ?>"></script>

	<script>
		$(document).ready(function(){
			console.log('Ready..');


			$("#btnsend").click(function(){
				var apiFormData = {
					'search_key': $("#hrcode").val()
				}
				console.log(apiFormData);

				jQuery.ajax({
					url: '/api/get_personnel_profile', // Your CodeIgniter route
					type: 'POST',
					dataType: 'json',
					data: apiFormData,
					success: function(response) {


						console.log("api->get_personnel_profile : [success]");

						var profile = response.data['profile'][0];
						// alert(profile);
						console.log(profile);

					}
				});
			});
		});


		function setHeader(xhr) {

			xhr.setRequestHeader('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImRhdGFjZW50ZXIifQ.P1rIezruul_arAeU4XzwMRs3Zic2G2P2PI50pFhapMQ');
		}
	</script>
</body>
</html>
