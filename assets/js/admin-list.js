"use strict";

jQuery(document).ready(function() {


	jQuery(".search-profile").click(function(){

		console.log('[debug] .search-profile ');

		jQuery("#md_searchkey").focus();
		jQuery("#UserSearchModal").modal('show');

	});

	jQuery(".search-admin").click(function(){

		console.log('[debug] .search-admin ');
		jQuery("#FormDelegateAdmin").submit();

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
						jQuery('<td class="text-center">').html("<a href=\"javascript:;\"  onclick=\"modal_promote_selected('"+row.user_id+"')\"  class=\"btn btn-light-success modal-external-selected\">กำหนดเป็นผู้ดูแลระบบ</a>")
					);

					jQuery("#modal-search-result").append($tr);
				});

				jQuery("#modal-search-result").fadeIn("slow");

			}
		});

	});


});

function modal_promote_selected(user_id){
	console.log('[debug] modal_promote_selected:click ' + user_id);

	var apiFormData = {
		'user_id': user_id
	}

	jQuery.ajax({
		url:  BASE_URL + 'admin/user_promote',
		type: 'POST',
		dataType: 'text',
		data: apiFormData,
		success: function (resPromote){

			// console.log(resPromote)
			// jQuery("#UserSearchModal").modal('toggle');
			var editUserURL = BASE_URL + 'admin/user_edit/'+user_id;
			window.location = editUserURL;
		}
	});



}
