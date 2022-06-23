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
					'code_person': $("#hrcode").val()
				}
				console.log(apiFormData);

				jQuery.ajax({

					url:  "https://personnel.dusit.ac.th/app/api/get_profile",
					headers: {
						'Access-Control-Allow-Origin': '*',
						'Authorization': 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImRhdGFjZW50ZXIifQ.P1rIezruul_arAeU4XzwMRs3Zic2G2P2PI50pFhapMQ',
						// 'Content-Type': 'application/x-www-form-urlencoded',
					},
					crossDomain: true,
					type: 'POST',
					datatype: 'application/json',
					data: apiFormData,
					success: function (resProfile){


						console.log("api->get_personnel_profile : [success]");

						var profile = resProfile['profile'][0];
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
