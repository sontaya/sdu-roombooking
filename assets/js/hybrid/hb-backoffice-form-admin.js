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


	jQuery("#FormBookingAdmin").validate({
	  errorClass: 'custom-error',
	  rules: {
		room_id: "required",
		booking_phone: "required",
		booking_name: "required",
		// objective: "required",
		// participant: "required",
		usage_software: "required",
		usage_category: "required",
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

	jQuery(".search-profile").click(function(){

		console.log('[debug] .search-profile ');

		jQuery("#md_searchkey").focus();
		jQuery("#bookingSearchModal").modal('show');

	});

	jQuery("#md_search_button").click(function(){

		console.log('[debug] #md_search_buttion:click ');

		var apiFormData = {
			'search_key': jQuery("#md_searchkey").val()
		}
		jQuery.ajax({
			url:  "https://personnel.dusit.ac.th/app/api/get_personnel_profile",
			header:{
				'Access-Control-Allow-Origin': '*',
				'Access-Control-Allow-Methods' : 'GET, POST, OPTIONS',
			},
			type: 'POST',
			dataType: 'json',
			data: apiFormData,
			success: function (resProfile){

				// console.log(resProfile);

				var profiles = resProfile["profile"];

				// console.log("api->get_personnel_profile : [success]");

				jQuery.each(profiles, function(i, row){

					var $tr = jQuery('<tr>').append(

						jQuery('<td class="text-left">').text("#"),
						jQuery('<td class="text-left">').text(row.ACADEMIC_FULLNAME_TH),
						jQuery('<td class="text-left">').text(row.NAME_FACULTY),
						jQuery('<td class="text-center">').html("<a href=\"javascript:;\"  onclick=\"modal_selected('"+row.CODE_PERSON+"')\"  class=\"btn btn-light-success modal-selected\">เลือก​</a>")
					);

					jQuery("#modal-search-result").append($tr);
				});

				jQuery("#modal-search-result").fadeIn("slow");

			}
		});

	});


	jQuery(".search-teacher").click(function(){

		console.log('[debug] .search-teacher ');

		jQuery("#md_teacher_searchkey").focus();
		jQuery("#teacherSearchModal").modal('show');

	});

	jQuery(".search-subject").click(function(){

		console.log('[debug] .search-subject ');

		jQuery("#md_subject_searchkey").focus();
		jQuery("#subjectSearchModal").modal('show');

	});


	jQuery("#md_teacher_search_button").click(function(){

		console.log('[debug] #md_teacher_search_buttion:click ');

		var apiFormData = {
			'search_key': jQuery("#md_teacher_searchkey").val()
		}
		jQuery.ajax({
			url:  "https://personnel.dusit.ac.th/app/api/get_personnel_profile",
			header:{
				'Access-Control-Allow-Origin': '*',
				'Access-Control-Allow-Methods' : 'GET, POST, OPTIONS',
			},
			type: 'POST',
			dataType: 'json',
			data: apiFormData,
			success: function (resProfile){

				// console.log(resProfile);

				var profiles = resProfile["profile"];

				// console.log("api->get_personnel_profile : [success]");

				jQuery.each(profiles, function(i, row){

					var $tr = jQuery('<tr>').append(

						jQuery('<td class="text-left">').text("#"),
						jQuery('<td class="text-left">').text(row.ACADEMIC_FULLNAME_TH),
						jQuery('<td class="text-left">').text(row.NAME_FACULTY),
						jQuery('<td class="text-center">').html("<a href=\"javascript:;\"  onclick=\"modal_teacher_selected('"+row.CODE_PERSON+"')\"  class=\"btn btn-light-success modal-teacher-selected\">เลือก​</a>")
					);

					jQuery("#modal-teacher-search-result").append($tr);
				});

				jQuery("#modal-teacher-search-result").fadeIn("slow");

			}
		});

	});

	jQuery("#md_subject_search_button").click(function(){

		console.log('[debug] #md_subject_search_buttion:click ');

		var apiFormData = {
			'search_key': jQuery("#md_subject_searchkey").val()
		}

		console.log(apiFormData);
		jQuery(".subject-row-result").remove();

		jQuery.ajax({
			url:  BASE_URL + "api/get_subject",
			header:{
				'Access-Control-Allow-Origin': '*',
				'Access-Control-Allow-Methods' : 'GET, POST, OPTIONS',
			},
			type: 'POST',
			dataType: 'json',
			data: apiFormData,
			success: function (resSubject){

				// console.log(resSubject);

				var subjects = resSubject;

				jQuery.each(subjects, function(i, row){

					var $tr = jQuery('<tr class="subject-row-result">').append(

						jQuery('<td class="text-center">').text(row.subject_code),
						jQuery('<td class="text-left">').text(row.subject_name_th),
						jQuery('<td class="text-center">').text(row.credit_full),
						jQuery('<td class="text-center">').html("<a href=\"javascript:;\"  onclick=\"modal_subject_selected('"+row.subject_id+"')\"  class=\"btn btn-light-success modal-subject-selected\">เลือก​</a>")
					);

					jQuery("#modal-subject-search-result").append($tr);
				});

				jQuery("#modal-subject-search-result").fadeIn("slow");

			}
		});

	});


	jQuery("#usage_category").change(function() {

		var usage_category_target= jQuery(this).val();

		if(usage_category_target == 1){
			jQuery(".row-for-training").hide();
			jQuery(".row-for-teaching").fadeIn("slow");
		}else if(usage_category_target == 2){
			jQuery(".row-for-training").fadeIn("slow");
			jQuery(".row-for-teaching").hide();
		}

	});

	jQuery("#teacher_flag").change(function() {

		if(jQuery(this).is(':checked')){

			var booking_name_target = jQuery("#booking_name").val();
			var user_id_target = jQuery("#user_id").val();

			jQuery("#teacher_fullname").val(booking_name_target);
			jQuery("#teacher_id").val(user_id_target);
		}else{

			jQuery("#teacher_fullname").val("");
			jQuery("#teacher_id").val("");
		}

	});


	// jQuery(".modal-selected").click(function(){
	// 	console.log('[debug] .modal-selected:click ' + jQuery(this).data('id'));


	// });

});


function modal_selected(hrcode){
	console.log('[debug] .modal-selected:click ' + hrcode);

	var apiFormData = {
		'code_person': hrcode
	}
	jQuery.ajax({
		url:  "https://personnel.dusit.ac.th/app/api/get_personnel_profile",
		header:{
			'Access-Control-Allow-Origin': '*',
			'Access-Control-Allow-Methods' : 'GET, POST, OPTIONS',
		},
		type: 'POST',
		dataType: 'json',
		data: apiFormData,
		success: function (resProfile){

			var profile = resProfile["profile"][0];
			console.log(profile);


			//--::Begin Store Local User
				var FormLoginData = {

					'uid' : '',
					'user_id' : profile.CODE_PERSON,
					'citizencode' : profile.CITIZEN_CODE,
					'name' : profile.FIRST_NAME_THA,
					'surname' : profile.LAST_NAME_THA,
					'staff_type' : profile.STAFF_TYPE,
					'staff_type_name' : profile.STAFF_TYPE_NAME,
					'substaff_type' : profile.SUBSTAFF_TYPE,
					'substaff_type_name' : profile.SUBSTAFF_TYPE_NAME,
					'code_faculty' : profile.CODE_FACULTY,
					'name_faculty' : profile.NAME_FACULTY,
					'code_department' : profile.CODE_DEPARTMENT,
					'name_department' : profile.NAME_DEPARTMENT,
					'code_site' : profile.CODE_SITE,
					'name_site' : profile.NAME_SITE


				}
				jQuery.ajax({
					url:  BASE_URL + "user/check_local_user",
					type: 'POST',
					dataType: 'json',
					data: FormLoginData,
					success: function (resSession){

						console.log("user/check_local_user : [success]");
					}
				});
			//--::End Store Local User

			jQuery("#booking_name").val(profile.ACADEMIC_FULLNAME_TH);
			jQuery("#booking_faculty").val(profile.NAME_FACULTY);
			jQuery("#user_id").val(profile.CODE_PERSON);
			jQuery("#bookingSearchModal").modal('toggle');
		}
	});

}

function modal_teacher_selected(hrcode){
	console.log('[debug] .modal-teacher-selected:click ' + hrcode);

	var apiFormData = {
		'code_person': hrcode
	}
	jQuery.ajax({
		url:  "https://personnel.dusit.ac.th/app/api/get_personnel_profile",
		header:{
			'Access-Control-Allow-Origin': '*',
			'Access-Control-Allow-Methods' : 'GET, POST, OPTIONS',
		},
		type: 'POST',
		dataType: 'json',
		data: apiFormData,
		success: function (resProfile){

			var profile = resProfile["profile"][0];
			console.log(profile);


			//--::Begin Store Local User
				var FormLoginData = {

					'uid' : '',
					'user_id' : profile.CODE_PERSON,
					'citizencode' : profile.CITIZEN_CODE,
					'name' : profile.FIRST_NAME_THA,
					'surname' : profile.LAST_NAME_THA,
					'staff_type' : profile.STAFF_TYPE,
					'staff_type_name' : profile.STAFF_TYPE_NAME,
					'substaff_type' : profile.SUBSTAFF_TYPE,
					'substaff_type_name' : profile.SUBSTAFF_TYPE_NAME,
					'code_faculty' : profile.CODE_FACULTY,
					'name_faculty' : profile.NAME_FACULTY,
					'code_department' : profile.CODE_DEPARTMENT,
					'name_department' : profile.NAME_DEPARTMENT,
					'code_site' : profile.CODE_SITE,
					'name_site' : profile.NAME_SITE


				}
				jQuery.ajax({
					url:  BASE_URL + "user/check_local_user",
					type: 'POST',
					dataType: 'json',
					data: FormLoginData,
					success: function (resSession){

						console.log("user/check_local_user : [success]");
					}
				});
			//--::End Store Local User

			jQuery("#teacher_fullname").val(profile.ACADEMIC_FULLNAME_TH);
			jQuery("#teacher_code").val(profile.CODE_PERSON);
			jQuery("#teacherSearchModal").modal('toggle');
		}
	});

}

function modal_subject_selected(subject_id){
	console.log('[debug] .modal-subject-selected:click ' + subject_id);

	var apiFormData = {
		'subject_id': subject_id
	}
	jQuery.ajax({
		url:  BASE_URL + "api/get_subject_byid",
		header:{
			'Access-Control-Allow-Origin': '*',
			'Access-Control-Allow-Methods' : 'GET, POST, OPTIONS',
		},
		type: 'POST',
		dataType: 'json',
		data: apiFormData,
		success: function (resSubject){

			var subject = resSubject[0];
			console.log(subject);


			jQuery("#subject_name").val(subject.subject_name_th);
			jQuery("#subject_id").val(subject.subject_id);
			jQuery("#subject_code").val(subject.subject_code);
			jQuery("#subjectSearchModal").modal('toggle');
		}
	});

}
