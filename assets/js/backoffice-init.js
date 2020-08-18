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

	jQuery("#md_reason").on('change keyup paste mouseup', function(){
		if(jQuery.trim(jQuery(this).val()).length > 0){
			jQuery("#md_button_reject").removeClass("btn-default disabled").addClass("btn-danger");
		}else{
			jQuery("#md_button_reject").removeClass("btn-danger").addClass("btn-default disabled");
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
		url:  BASE_URL + "backoffice/booking_approve",
		type: 'POST',
		dataType: 'json',
		data: formData,
		success: function (res){

			location.reload();
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
				url:  BASE_URL + "backoffice/booking_delete",
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
