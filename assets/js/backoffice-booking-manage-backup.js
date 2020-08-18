"use strict";
// Class definition

var KTDatatableBooking = function() {
    // Private functions

    // basic demo
    var BookingManageTable = function() {
		console.log(BASE_URL);
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
				type: 'remote',
                source: {
                    read: {
						// url: HOST_URL + '/api/datatables/demos/default.php',
						url: BASE_URL + 'backoffice/get_booking_request',
                        // sample custom headers
                        // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        map: function(raw) {
							console.log(raw);
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
							}
                            return dataSet;
                        },
                    },
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: false,
                footer: false,
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: jQuery('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                selector: false,
                textAlign: 'center',
            }, {
                field: 'Room',
                title: 'Room',
                template: function(row) {
                    return row.room_name;
                },
			},{
                field: 'user_id',
                title: 'UserID',
            },{
                field: 'booking_date_start',
                title: 'BookingStart',
                type: 'date',
                format: 'dd-mm-yyyy',
            },{
                field: 'booking_date_end',
                title: 'BookingEnd',
                type: 'date',
                format: 'dd-mm-yyyy',
            },{
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                overflow: 'visible',
                autoHide: false,
                template: function(row) {
					var status = {
                        'pending': {
                            'title': 'Pending',
                            'class': ' label-light-warning'
                        },
                        'approved': {
                            'title': 'Approved',
                            'class': ' label-light-success'
                        },
                        'rejected': {
                            'title': 'Rejected',
                            'class': ' label-light-danger'
                        },

                    };
					return '\
						<span class="label font-weight-bold label-lg' + status[row.booking_status].class + ' label-inline">' + status[row.booking_status].title + '</span>\
						<div class="dropdown dropdown-inline">\
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">\
							<span class="svg-icon svg-icon-md">\
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"\
									height="24px" viewBox="0 0 24 24" version="1.1">\
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
										<rect x="0" y="0" width="24" height="24">\
										</rect>\
										<path\
											d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"\
											fill="#000000">\
										</path>\
									</g>\
								</svg>\
							</span>\
						</a>\
						<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
							<ul class="navi flex-column navi-hover py-2">\
								<li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2"> Choose an action:\
								</li>\
								<li class="navi-item">\
									<a href="javascript:;" onclick="booking_view('+ row.id +');return false;" data-id="'+ row.id +'" class="navi-link booking-view">\
										<span class="navi-icon"><i class="flaticon-eye"></i></span>\
										<span class="navi-text">View</span>\
									</a>\
								</li>\
								<li class="navi-item">\
									<a href="javascript:;" onclick="booking_approve('+ row.id +',\'approved\');return false;" data-id="'+ row.id +'" class="navi-link booking-approve">\
										<span class="navi-icon"><i class="flaticon2-calendar-5 text-success"></i></span>\
										<span class="navi-text">Approve</span>\
									</a>\
								</li>\
								<li class="navi-item">\
									<a href="javascript:;" onclick="booking_approve('+ row.id +',\'rejected\');return false;" data-id="'+ row.id +'" class="navi-link booking-reject">\
										<span class="navi-icon"><i class="flaticon-cancel text-warning"></i></span>\
										<span class="navi-text">Reject</span>\
									</a>\
								</li>\
								<li class="navi-item">\
									<a href="javascript:;" onclick="booking_delete('+ row.id +');return false;" data-id="'+ row.id +'" class="navi-link booking-delete">\
										<span class="navi-icon"><i class="flaticon-delete-1 text-danger"></i></span>\
										<span class="navi-text">Delete</span>\
									</a>\
								</li>\
							</ul>\
						</div>\
					</div>';
                },
            }],

        });

		$('#kt_datatable_search_room').on('change', function() {
			// console.log($('select[name=kt_datatable_search_room] option').filter(':selected').val());
			console.log("[debug] " + jQuery(this).val().toLowerCase());
            datatable.search(jQuery(this).val(), 'room_id');
        });

        // $('#kt_datatable_search_type').on('change', function() {
        //     datatable.search($(this).val().toLowerCase(), 'Type');
        // });

        // $('#kt_datatable_search_room, #kt_datatable_search_type').selectpicker();
        $('#kt_datatable_search_room').selectpicker();
    };

    return {
        // public functions
        init: function() {
            BookingManageTable();
        },
    };
}();

jQuery(document).ready(function() {

	$('#kt_datatable_search_date1').datetimepicker({
		todayHighlight: true,
		autoclose: true,
		pickerPosition: 'bottom-left',
		todayBtn: true,
		format: 'yyyy/mm/dd hh:ii'
	});

	$('#kt_datatable_search_date2').datetimepicker({
		todayHighlight: true,
		autoclose: true,
		pickerPosition: 'bottom-left',
		todayBtn: true,
		format: 'yyyy/mm/dd hh:ii'
	});

	KTDatatableBooking.init();




	jQuery('#kt_datatable').on('click', '.booking-delete', function(){
	// jQuery(".booking-delete").on("click", function() {
		console.log('[debug] .booking-delete:click ' + jQuery(this).data('id'));

		var id = jQuery(this).data('id');

		// var deleteTargetURL = BASE_URL + 'backoffice/donation_delete/'+id;


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

});

function booking_view(id){
	console.log('[debug] function booking_view() ' + id);


	var getTargetURL = BASE_URL + 'backoffice/get_booking_info/'+id;
	console.log(getTargetURL);

	jQuery.get(getTargetURL , function (data) {

		console.log(data);
			jQuery("#room_name").html(data[0].room_name);
			jQuery("#booking_email").val(data[0].booking_email);
			jQuery("#booking_phone").val(data[0].booking_phone);
			jQuery("#objective").val(data[0].objective);
			jQuery("#participant").val(data[0].participant);
			jQuery("#booking_date_start").val(data[0].booking_date_start);
			jQuery("#booking_date_end").val(data[0].booking_date_end);
			jQuery("input[name=require_staff][value=" + data[0].require_staff + "]").prop('checked', true);

			jQuery.noConflict();
			jQuery("#bookingInfoModal").modal('show');
	});

}

function booking_approve(id,status){

	console.log('[debug] function booking_approve()');

	var formData = {
		'id': id,
		'status' : status
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
