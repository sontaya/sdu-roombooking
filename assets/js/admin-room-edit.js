"use strict";

jQuery(document).ready(function() {

	// console.log();
	// var staff_grants = ["2020-052"];
	// staff_grants.push("2020-010");
	// console.log(staff_grants);

	$('[data-switch=true]').bootstrapSwitch({
		onSwitchChange: function(e, state){
			if(state === false){
				$('#active-desc-box').fadeIn("slow");
				$('#active_desc').focus();
			}
			if(state === true){
				$('#active-desc-box').hide();
			}
		}
	});

	jQuery("#room_save").click(function(){
		jQuery("#FrmRoom").submit();
	});


	jQuery(".search-profile").click(function(){

		console.log('[debug] .search-profile ');

		jQuery("#md_searchkey").focus();
		jQuery("#UserSearchModal").modal('show');

	});



	jQuery("#md_search_button").click(function(){

		console.log('[debug] #md_search_buttion:click ');

		var apiFormData = {
			'search_key': jQuery("#md_searchkey").val()
		}
		jQuery.ajax({
			url:  BASE_URL + 'user/list_internal_json',
			header:{
				'Access-Control-Allow-Origin': '*',
				'Access-Control-Allow-Methods' : 'GET, POST, OPTIONS',
			},
			type: 'POST',
			dataType: 'json',
			data: apiFormData,
			success: function (resProfile){

				console.log(resProfile);

				var profiles = resProfile;

				console.log("list_internal_user : [success]");
				jQuery.each(profiles, function(i, row){

					var $tr = jQuery('<tr>').append(

						jQuery('<td class="text-left">').text("#"),
						jQuery('<td class="text-left">').text(row.name + " " + row.surname),
						jQuery('<td class="text-left">').text(row.name_faculty),
						jQuery('<td class="text-center">').html("<a href=\"javascript:;\"  onclick=\"modal_promote_roomstaff_selected('"+row.user_id+"')\"  class=\"btn btn-light-success modal-external-selected\">กำหนดเป็นผู้ดูแลห้อง</a>")
					);

					jQuery("#modal-search-result").append($tr);
				});

				jQuery("#modal-search-result").fadeIn("slow");

			}
		});

	});



});



function modal_promote_roomstaff_selected(user_id){
	console.log('[debug] modal_promote_roomstaff_selected:click ' + user_id);

	// var obj = JSON.parse("['2020-052']");
	// console.log(obj);
	// var staff_grants = JSON.parse(jQuery('#room_staff_grant').val());
	// staff_grants.push(user_id);
	// console.log(staff_grants);

	var apiFormData = {
		'user_id': user_id
	}

	jQuery.ajax({
		url:  BASE_URL + 'user/list_internal_json',
		header:{
			'Access-Control-Allow-Origin': '*',
			'Access-Control-Allow-Methods' : 'GET, POST, OPTIONS',
		},
		type: 'POST',
		dataType: 'json',
		data: apiFormData,
		success: function (resProfile){

			// console.log(resProfile);

			var profiles = resProfile;

			// console.log("list_internal_user : [success]");
			jQuery.each(profiles, function(i, row){

				// var $tr = jQuery('<tr>').append(

				// 	jQuery('<td class="text-left">').text("#"),
				// 	jQuery('<td class="text-left">').text(row.name + " " + row.surname),
				// 	jQuery('<td class="text-left">').text(row.name_faculty),
				// 	jQuery('<td class="text-center">').html("<a href=\"javascript:;\"  onclick=\"modal_promote_roomstaff_selected('"+row.user_id+"')\"  class=\"btn btn-light-success modal-external-selected\">กำหนดเป็นผู้ดูแลห้อง</a>")
				// );



				var htmlResult = '';
					htmlResult += '<div class="d-flex" >';
					htmlResult += '		<div class="flex-grow-1">';
					htmlResult += '			<div class="d-flex align-items-center justify-content-between flex-wrap mt-2">';
					htmlResult += '				<div class="mr-3">';
					htmlResult += '					<a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">'+ row.name + ' ' + row.surname ;
					htmlResult += '					<i class="flaticon2-correct text-success icon-md ml-2"></i></a>';
					htmlResult += '					<div class="d-flex flex-wrap text-muted my-2">';
					htmlResult += '						'+ row.name_department ;
					htmlResult += '					</div>';
					htmlResult += '				</div>';
					htmlResult += '				<div class="my-lg-0 my-1">';
					htmlResult += '					<a href="#" class="btn btn-sm btn-danger font-weight-bolder text-uppercase">ลบ</a>';
					htmlResult += '				</div>';
					htmlResult += '			</div>';
					htmlResult += '		</div>';
					htmlResult += '	</div>';
					var tag = jQuery('#room-staff-result').append(htmlResult);

			// 	jQuery("#modal-search-result").append($tr);
			});

			// jQuery("#modal-search-result").fadeIn("slow");

		}

	});



}



