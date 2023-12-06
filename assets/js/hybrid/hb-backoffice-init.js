"use strict";

jQuery(document).ready(function() {


	jQuery("#md_button_approve").click(function(){
		var targetID = jQuery("#md_id").val();
		booking_approve(targetID,'approved');
	});

	jQuery("#md_button_reject").click(function(){
		var targetID = jQuery("#md_id").val();
		var targetReason = jQuery("#md_reason").val();
		booking_approve(targetID,'rejected',targetReason);
	});

	jQuery("#md_button_cancel").click(function(){
		var targetID = jQuery("#md_id").val();
		var targetReason = jQuery("#md_reason").val();
		booking_approve(targetID,'canceled',targetReason);
	});

	jQuery("#md_reason").on('change keyup paste mouseup', function(){
		if(jQuery.trim(jQuery(this).val()).length > 0){
			jQuery("#md_button_reject").removeClass("btn-default disabled").addClass("btn-danger");
			jQuery("#md_button_cancel").removeClass("btn-default disabled").addClass("btn-warning");
		}else{
			jQuery("#md_button_reject").removeClass("btn-danger").addClass("btn-default disabled");
			jQuery("#md_button_cancel").removeClass("btn-warning").addClass("btn-default disabled");
		}
	});


	jQuery('.booking-reject').click(function(){

		console.log('[debug] .booking-reject:click ' + jQuery(this).data('id'));

		var targetID = jQuery(this).data('id');

		Swal.fire({
			title: 'กรุณาระบุเหตุผลในการยกเลิก',
			input: 'text',
			inputAttributes: {
			  autocapitalize: 'off'
			},
			showCancelButton: true,
			confirmButtonText: 'ยกเลิกรายการจอง',
			preConfirm: (targetReason) => {
				// console.log(targetReason);
				booking_approve(targetID,'rejected',targetReason);
			},
		});

	});

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

function booking_approve(id,status,reason=""){

	console.log('[debug] function booking_approve()');

	var formData = {
		'id': id,
		'status' : status,
		'status_reason': reason
	}
	console.log(formData);

	$.ajax({
		url:  BASE_URL + "hybridbackoffice/booking_approve",
		type: 'POST',
		dataType: 'json',
		data: formData,
		success: function (res){
			 console.log(res);
			booking_line_notify(id);
			// location.reload();

			// setTimeout(function(){
			// 	toastr['success']("ทำรายการเรียบร้อย", "Booking notification");
			// 	location.reload();
			// },2000);
		}
	});

}

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
			location.reload();

			// setTimeout(function(){
			// 	toastr['success']("ทำรายการเรียบร้อย", "Booking notification");
			// 	location.reload();
			// },2000);
		}
	});

}

function booking_line_notify(id){

	console.log('[debug] function booking_line_notify()');

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
			// console.log(res);
		}
	});

}


function booking_delete(id){
	console.log('[debug] function booking_delete()');

	var formData = {
		'id': id
	}

	Swal.fire({
		title: "Are you sure?",
		text: "Delete",
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: "Yes, delete it!"
	}).then(function(result) {
		if (result.value) {

			$.ajax({
				url:  BASE_URL + "hybridbackoffice/booking_delete",
				type: 'POST',
				dataType: 'json',
				data: formData,
				success: function (res){

					location.reload();

				}
			});

		}
	});
}
