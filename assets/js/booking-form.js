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

	$('#booking_date_start').datetimepicker({
		todayHighlight: true,
		autoclose: true,
		pickerPosition: 'bottom-left',
		todayBtn: true,
		format: 'yyyy/mm/dd hh:ii'
	});

	$('#booking_date_end').datetimepicker({
		todayHighlight: true,
		autoclose: true,
		pickerPosition: 'bottom-left',
		todayBtn: true,
		format: 'yyyy/mm/dd hh:ii'
	});

	$.extend( $.validator.messages, {
		required: "โปรดระบุ",
		remote: "โปรดแก้ไขให้ถูกต้อง",
		email: "โปรดระบุที่อยู่อีเมล์ที่ถูกต้อง",
		url: "โปรดระบุ URL ที่ถูกต้อง",
		date: "โปรดระบุวันที่ ที่ถูกต้อง",
		dateISO: "โปรดระบุวันที่ ที่ถูกต้อง (ระบบ ISO).",
		number: "โปรดระบุทศนิยมที่ถูกต้อง",
		digits: "โปรดระบุจำนวนเต็มที่ถูกต้อง",
		creditcard: "โปรดระบุรหัสบัตรเครดิตที่ถูกต้อง",
		equalTo: "โปรดระบุค่าเดิมอีกครั้ง",
		extension: "โปรดระบุค่าที่มีส่วนขยายที่ถูกต้อง",
		maxlength: $.validator.format( "โปรดอย่าระบุค่าที่ยาวกว่า {0} อักขระ" ),
		minlength: $.validator.format( "โปรดอย่าระบุค่าที่สั้นกว่า {0} อักขระ" ),
		rangelength: $.validator.format( "โปรดอย่าระบุค่าความยาวระหว่าง {0} ถึง {1} อักขระ" ),
		range: $.validator.format( "โปรดระบุค่าระหว่าง {0} และ {1}" ),
		max: $.validator.format( "โปรดระบุค่าน้อยกว่าหรือเท่ากับ {0}" ),
		min: $.validator.format( "โปรดระบุค่ามากกว่าหรือเท่ากับ {0}" )
	} );


	// $("#FormBooking").validate({
	//   errorClass: 'custom-error',
	//   rules: {
	// 	room_id: "required",
	// 	booking_phone: "required",
	// 	booking_name: "required",
	// 	objective: "required",
	// 	participant: "required",
	// 	booking_date_start: "required",
	// 	booking_date_end: "required"

	//   },
	//   messages:{

	//   },
	//   errorPlacement: function(error, element) {
	// 	var placement = $(element).data('error');
	// 	if (placement) {
	// 	  $(placement).append(error)
	// 	} else {
	// 	  error.insertAfter(element);
	// 	}
	//   }
	// });


	$("#FormBooking").validate({
		onkeyup: false,
		onclick: false,
		onfocusout: false,
		errorClass: 'custom-error',
		rules:{
			room_id: "required",
			booking_phone: "required",
			booking_name: "required",
			objective: "required",
			participant: "required",
			booking_date_start: "required",
			booking_date_end: "required"
		},
		messages:{

		},
		invalidHandler: function(form, validator) {
		  submitted = true;
		},
		errorPlacement: function(error, element) {
			var placement = $(element).data('error');
			if (placement) {
			$(placement).append(error)
			} else {
				error.insertAfter(element);
			}
		},
		submitHandler: function(form, event) {

		  console.log("[debug] submitHandler");

		  event.preventDefault();


		//   var formFields = jQuery("#FormBooking").serializeArray();

		//   var form_data = new FormData();
		//   $.each(formFields, function( i, field ) {
		// 	form_data.append(field.name, field.value);
		// 	console.log(field.name + ' : ' + field.value);
		//   });


		  var freeroomConditionData = {
			'room_id': jQuery("#room_id").val(),
			'free_date_start': jQuery("#booking_date_start").val(),
			'free_date_end': jQuery("#booking_date_end").val()
		 }

		 console.log(freeroomConditionData);

		  $.ajax({
			url: BASE_URL + 'booking/check_free_room',
			dataType: 'json',
			data: freeroomConditionData,
			type: 'post',
			success: function (res)
			{
				console.log(res);
				if (res !== false){
					toastr['error']("ไม่สามารถจองห้องในช่วงเวลานี้ได้", "Booking notification");
				}else{
					form.submit();
				}
			},
			error: function (request, status, message) {
				console.log('Ajax Error!! ' + status + ' : ' + message);
			},
	  	});


		//   form.submit();


			//   var file_data = $('#chf_file1').prop('files')[0];
			//   form_data.append('chf_file1', file_data);

			//   $.ajax({
			// 	  url: 'contract_history_file_save.php',
			// 	  dataType: 'text',
			// 	  cache: false,
			// 	  contentType: false,
			// 	  processData: false,
			// 	  data: form_data,
			// 	  type: 'post',
			// 	  success: function (ReturnData)
			// 	  {

			// 	  },
			// 	  error: function (request, status, message) {
			// 		  console.log('Ajax Error!! ' + status + ' : ' + message);
			// 	  },
			//   });

		}
	  });

});


