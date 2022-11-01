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

	jQuery("input[name='room_selected_all']").click(function(){

		if(jQuery(this).is(':checked')){
			console.log('room_selected_all:checked');

			jQuery('.room_selected').each(function(){
				this.checked = true;
			});

		}else{

			jQuery('.room_selected').each(function(){
				this.checked = false;
			});

		}
	});

	jQuery('.export-roomreserve-tag').click(function(){

		console.log('[debug] .export-roomreserve-tag:click ');

		var arrayRoomSelect = [];
		$("input:checkbox[name='room_selected']:checked").each(function() {
			arrayRoomSelect.push(jQuery(this).val());
		});

		console.log(arrayRoomSelect);


	});

	jQuery('.export-xlsx-tag').click(function(){

		console.log('[debug] .export-xlsx-tag:click ');

		var arrayRowSelect = [];
		$("input:checkbox[name='room_selected']:checked").each(function() {
			arrayRowSelect.push(jQuery(this).val());
		});

		//  console.log(arrayRowSelect);

		console.log(arrayRowSelect.length)
		if(arrayRowSelect.length > 0){

			var apiFormData = {
				'objects': arrayRowSelect
			}

			jQuery.ajax({
				url:  BASE_URL + 'export/prepare_xlsx',
				type: 'POST',
				dataType: 'text',
				data: apiFormData,
				success: function (res){

					console.log(res)
					// jQuery("#UserSearchModal").modal('toggle');
					var xlsxURL = BASE_URL + 'export/xlsx';
					window.open(xlsxURL,'_blank');
				}
			});

		}else{

			toastr['info']("ไม่มีรายการจองที่ถูกเลือกสำหรับทำรายการ", "Booking notification");

		}




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
					url:  BASE_URL + "backoffice/booking_cancel",
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

	var getTargetURL = BASE_URL + 'backoffice/get_booking_info/'+id;
	// console.log(getTargetURL);

	jQuery.get(getTargetURL , function (data) {

		console.log(data);

		jQuery("#md_booking_name").html(data[0].academic_fullname);
		jQuery("#md_room_name").html(data[0].room_name);
		jQuery("#md_booking_email").html(data[0].booking_email);
		jQuery("#md_booking_phone").html(data[0].booking_phone);
		jQuery("#md_internal_phone").html(data[0].internal_phone);
		jQuery("#md_usage_category").html(data[0].usage_category_desc);
		jQuery("#md_usage_software").html(data[0].usage_software_desc);
		jQuery("#md_objective").html(data[0].objective);
		jQuery("#md_participant").html(data[0].participant);
		if(data[0].require_staff == "Y"){
			jQuery("#md_require_staff").html("ต้องการ");
		}else{
			jQuery("#md_require_staff").html("ไม่ต้องการ");
		}

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

