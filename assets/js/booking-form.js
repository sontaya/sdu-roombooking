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


	$("#FormBooking").validate({
	  errorClass: 'custom-error',
	  rules: {
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
	  errorPlacement: function(error, element) {
		var placement = $(element).data('error');
		if (placement) {
		  $(placement).append(error)
		} else {
		  error.insertAfter(element);
		}
	  }
	});

});

