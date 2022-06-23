"use strict";



jQuery(document).ready(function() {

	jQuery("#submit_button").click(function(){

		var formData = {
			email_default :   jQuery("#email_default").val(),
			mobile_phone_default :  jQuery("#mobile_phone_default").val(),
			internal_phone_default :  jQuery("#internal_phone_default").val()
		}

		// console.log('profile_store: ');
		// console.log(formData);
		$.ajax({
			url:  BASE_URL + "user/profile_store",
			type: 'POST',
			dataType: 'json',
			data: formData,
			success: function (res){

				// console.log(res);
				toastr['success']("ปรับปรุงข้อมูลเรียบร้อย", "Booking notification");
				// location.reload();
			}
		});
	});
});


