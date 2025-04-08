"use strict";

jQuery(document).ready(function() {

		var arrows;
		if (KTUtil.isRTL()) {
			arrows = {
				leftArrow: '<i class="la la-angle-right"></i>',
				rightArrow: '<i class="la la-angle-left"></i>'
			}
		} else {
			arrows = {
				leftArrow: '<i class="la la-angle-left"></i>',
				rightArrow: '<i class="la la-angle-right"></i>'
			}
		}


		jQuery('#bm_search_date').datepicker({
			// todayHighlight: true,
			// autoclose: true,
			// pickerPosition: 'bottom-left',
			// todayBtn: true,
			// format: 'yyyy/mm/dd'
			rtl: KTUtil.isRTL(),
			todayHighlight: true,
			templates: arrows,
			format: 'dd/mm/yyyy'
		});






	jQuery('.booking-edit').click(function(){


		console.log('[debug] .booking-edit:click ' + jQuery(this).data('id'));

		var id = jQuery(this).data('id');

		// var deleteTargetURL = BASE_URL + 'meetingbackoffice/donation_delete/'+id;


		// 	Swal.fire({
		// 		title: "Are you sure?",
		// 		text: "Delete",
		// 		icon: "warning",
		// 		showCancelButton: true,
		// 		confirmButtonText: "Yes, delete it!"
		// 	}).then(function(result) {
		// 		if (result.value) {
		// 			jQuery.get(deleteTargetURL , function (data) {
		// 				location.reload();
		// 			});
		// 		}
		// 	});



	});

	jQuery('.booking-delete').click(function(){

		console.log('[debug] .booking-delete:click ' + jQuery(this).data('id'));

		var id = jQuery(this).data('id');

		// var deleteTargetURL = BASE_URL + 'meetingbackoffice/donation_delete/'+id;


		var formData = {
			'id': id
		}

		Swal.fire({
			title: "ยืนยันการลบข้อมูลรายการจอง",
			text: "",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, delete it!"
		}).then(function(result) {
			if (result.value) {

				$.ajax({
					url:  BASE_URL + "meetingbackoffice/booking_delete",
					type: 'POST',
					dataType: 'json',
					data: formData,
					success: function (res){

						location.reload();

					}
				});

			}
		});


	});

	jQuery('.booking-cancel').click(function(){

		console.log('[debug] .booking-cancel:click ' + jQuery(this).data('id'));

		var id = jQuery(this).data('id');


		var formData = {
			'id': id,
			'status': 'canceled',
			'status_reason': 'ยกเลิกโดยผู้จอง'
		}

		Swal.fire({
			title: "ยืนยันการยกเลิกข้อมูลรายการจอง",
			text: "",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, cancel it!"
		}).then(function(result) {
			if (result.value) {

				$.ajax({
					url:  BASE_URL + "meetingbackoffice/booking_cancel",
					type: 'POST',
					dataType: 'json',
					data: formData,
					success: function (res){

						location.reload();

					}
				});

			}
		});


	});
});

function booking_view(id){
	console.log('[debug] function booking_view() ' + id);

	var getTargetURL = BASE_URL + 'meetingbackoffice/get_booking_info/'+id;
	// console.log(getTargetURL);

	jQuery.get(getTargetURL , function (data) {

		console.log(data);

		jQuery("#md_booking_name").html(data[0].academic_fullname);
		jQuery("#md_booking_department").html(data[0].name_faculty + ' (' +data[0].name_department + ')' );
		jQuery("#md_room_name").html(data[0].room_name);
		jQuery("#md_booking_email").html(data[0].booking_email);
		jQuery("#md_booking_phone").html(data[0].booking_phone);
		jQuery("#md_internal_phone").html(data[0].internal_phone);
		jQuery("#md_usage_category").html(data[0].usage_category_desc);
		jQuery("#md_usage_software").html(data[0].usage_software_desc);
		jQuery("#md_objective").html(data[0].objective);
		jQuery("#md_participant").html(data[0].participant);


		if(data[0].booking_status == "rejected" || data[0].booking_status == "canceled" ){
			jQuery(".row-for-reason").show();
			jQuery("#md_booking_status_reason").html(data[0].booking_status_desc + " : " + data[0].booking_status_reason);
		}else{
			jQuery(".row-for-reason").hide();
			jQuery("#md_booking_status_reason").html("");
		}

		jQuery("#md_booking_date_range").html(data[0].booking_date_start+ " ถึง " + data[0].booking_date_end);
		jQuery("#md_reason").val(data[0].booking_status_reason);
		jQuery("#md_id").val(data[0].id);

		if(data[0].booking_status == "approved"){
			jQuery("#md_button_approve").hide();
		}

		// jQuery.noConflict();
		jQuery("#bookingInfoModal").modal('show');

	});

}

