"use strict";

jQuery(document).ready(function() {



	jQuery('.booking-cancel').click(function(){

		console.log('[debug] .booking-cancel:click ' + jQuery(this).data('id'));

		var targetID = jQuery(this).data('id');

		Swal.fire({
			title: 'กรุณาระบุเหตุผลในการยกเลิกโดยผู้จอง',
			input: 'text',
			inputAttributes: {
			  autocapitalize: 'off'
			},
			showCancelButton: true,
			confirmButtonText: 'ยกเลิกรายการจอง',
			preConfirm: (targetReason) => {
				// console.log(targetReason);
				booking_cancel(targetID,'canceled',targetReason);
			},
		});

	});


});


function booking_cancel(id,status,reason=""){

	console.log('[debug] function booking_cancel()');

	var formData = {
		'id': id,
		'status' : status,
		'status_reason': reason
	}
	console.log(formData);

	$.ajax({
		url:  BASE_URL + "hybridbackoffice/booking_cancel",
		type: 'POST',
		dataType: 'json',
		data: formData,
		success: function (res){
			// console.log(res);
			booking_line_notify(id);
			// location.reload();
		}
	});

}

function booking_line_notify(id){

	console.log('[debug] function booking_line_notify(' + id + ')');

	var formData = {
		'booking_info_id': id,
	}
	// console.log(formData);

	$.ajax({
		url:  BASE_URL + "lineapi/bot_notify_hybrid",
		type: 'POST',
		dataType: 'json',
		data: formData,
		success: function (res){
			console.log(res);
		}
	});

}


