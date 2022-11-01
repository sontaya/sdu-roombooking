"use strict";

var KTCalendarListView = function() {

    return {
        //main function to initiate the module
        init: function() {
			var targetRoom = jQuery("#target_room").val();
			console.log("TargetRoom: " +targetRoom);
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            var calendarEl = document.getElementById('kt_calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

                isRTL: KTUtil.isRTL(),
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },

                height: 800,
                contentHeight: 750,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio
				timeZone: 'local',
				locale: 'th',
                views: {
                    dayGridMonth: { buttonText: 'month' },
                    timeGridWeek: { buttonText: 'week' },
                    timeGridDay: { buttonText: 'day' },
                    listDay: { buttonText: 'list' },
                    listWeek: { buttonText: 'list' }
                },

                defaultView: 'dayGridMonth',
                defaultDate: TODAY,

				editable: true,
				eventDrop: function(info) {
					// alert(info.event.title + " was dropped on " + info.event.start.toISOString());

					var formData = {
						'id': info.event.id,
						'booking_date_start': info.event.start.toISOString(),
						'booking_date_end':info.event.end.toISOString()
					}
					// console.log(formData);

					$.ajax({
						url:  BASE_URL + "hybrid/event_update",
						type: 'POST',
						dataType: 'json',
						data: formData,
						success: function (res){

							if(res.data['booking_status'] == 'approved'){
								info.revert();
								toastr['error']("ไม่อนุญาติให้ย้ายกิจกรรมที่อนุมัติแล้ว", "Booking notification");
							}else{
								toastr['success']("ปรับปรุงวันเวลาของกิจกรรมเรียบร้อย", "Booking notification");
							}


						}
					});

					// if (!confirm("Are you sure about this change?")) {
					//   info.revert();
					// }
					// console.log(info.event);
					// console.log(info.currentStart +' :: ' + info.currentEnd);
				},
				eventResize: function(info) {

					console.log('Resize: ' + info.event.start.toISOString() + ' : ' + info.event.end.toISOString());
					info.revert();
					toastr['error']("ไม่อนุญาติให้ดำเนินการ", "Booking notification");

					// var formData = {
					// 	'id': info.event.id,
					// 	'booking_date_start': info.event.start.toISOString(),
					// 	'booking_date_end':info.event.end.toISOString()
					// }
					// console.log(formData);

					// $.ajax({
					// 	url:  BASE_URL + "booking/event_update",
					// 	type: 'POST',
					// 	dataType: 'json',
					// 	data: formData,
					// 	success: function (res){

					// 		if(res.data['booking_status'] == 'approved'){
					// 			info.revert();
					// 			toastr['error']("ไม่อนุญาติให้ย้ายกิจกรรมที่อนุมัติแล้ว", "Booking notification");
					// 		}else{
					// 			toastr['success']("ปรับปรุงวันเวลาของกิจกรรมเรียบร้อย", "Booking notification");
					// 		}


					// 	}
					// });
				},
				eventClick: function(info) {
					console.log('Event: ' + info.event.title);
					console.log('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
					console.log('View: ' + info.view.type);


					var getTargetURL = BASE_URL + 'hybridbackoffice/get_booking_info/'+info.event.id;
					// console.log(getTargetURL);

					jQuery.get(getTargetURL , function (data) {

						console.log(data);

						jQuery("#md_booking_name").html(data[0].academic_fullname);
						jQuery("#md_room_name").html(data[0].room_name);
						jQuery("#md_booking_email").html(data[0].booking_email);
						jQuery("#md_booking_phone").html(data[0].booking_phone);
						jQuery("#md_internal_phone").html(data[0].internal_phone);
						jQuery("#md_objective").html(data[0].objective);
						jQuery("#md_usage_category").html(data[0].usage_category_desc);
						jQuery("#md_participant").html(data[0].participant);

						jQuery("#md_subject_name").html(data[0].subject_code +" - "+data[0].subject_name);
						jQuery("#md_teacher_fullname").html(data[0].teacher_fullname);

						if(data[0].usage_category == 2){
							jQuery(".row-for-teaching").hide();
						}

						if(data[0].usage_category == 1){
							jQuery(".row-for-training").hide();
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


				},

                eventLimit: true, // allow "more" link when too many events
				navLinks: true,
				eventSources: [
					{
						url: BASE_URL + 'hybrid/view_all_approved_json',
						method: 'POST',
						extraParams: {
							room_id: targetRoom
						},
						failure: function() {
							//   alert('there was an error while fetching events!');
						},
						color: '#C9F7F5',   // a non-ajax option
						textColor: '#1BC5BD' // a non-ajax option
					},
					{
						url: BASE_URL + 'hybrid/view_all_pending_json',
						method: 'POST',
						extraParams: {
							room_id: targetRoom
						},
						failure: function() {
							//   alert('there was an error while fetching events!');
						},
						color: '#FFF4DE',   // a non-ajax option
						textColor: '#FD7E14' // a non-ajax option
					}
				],
                eventRender: function(info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                }
            });

            calendar.render();
        }
    };
}();

jQuery(document).ready(function() {
    KTCalendarListView.init();
});



// events: [
// 	{
// 		title: 'All Day Event',
// 		start: YM + '-01',
// 		description: 'Toto lorem ipsum dolor sit incid idunt ut',
// 		className: "fc-event-danger fc-event-solid-warning"
// 	},
// 	{
// 		title: 'Reporting',
// 		start: YM + '-14T13:30:00',
// 		description: 'Lorem ipsum dolor incid idunt ut labore',
// 		end: YM + '-14',
// 		className: "fc-event-success"
// 	},
// 	{
// 		title: 'Company Trip',
// 		start: YM + '-02',
// 		description: 'Lorem ipsum dolor sit tempor incid',
// 		end: YM + '-03',
// 		className: "fc-event-primary"
// 	},
// 	{
// 		title: 'ICT Expo 2017 - Product Release',
// 		start: YM + '-03',
// 		description: 'Lorem ipsum dolor sit tempor inci',
// 		end: YM + '-05',
// 		className: "fc-event-light fc-event-solid-primary"
// 	},
// 	{
// 		title: 'Dinner',
// 		start: YM + '-12',
// 		description: 'Lorem ipsum dolor sit amet, conse ctetur',
// 		end: YM + '-10'
// 	},
// 	{
// 		id: 999,
// 		title: 'Repeating Event',
// 		start: YM + '-09T16:00:00',
// 		description: 'Lorem ipsum dolor sit ncididunt ut labore',
// 		className: "fc-event-danger"
// 	},
// 	{
// 		id: 1000,
// 		title: 'Repeating Event',
// 		description: 'Lorem ipsum dolor sit amet, labore',
// 		start: YM + '-16T16:00:00'
// 	},
// 	{
// 		title: 'Conference',
// 		start: YESTERDAY,
// 		end: TOMORROW,
// 		description: 'Lorem ipsum dolor eius mod tempor labore',
// 		className: "fc-event-primary"
// 	},
// 	{
// 		title: 'Meeting',
// 		start: TODAY + 'T10:30:00',
// 		end: TODAY + 'T12:30:00',
// 		description: 'Lorem ipsum dolor eiu idunt ut labore'
// 	},
// 	{
// 		title: 'Lunch',
// 		start: TODAY + 'T12:00:00',
// 		className: "fc-event-info",
// 		description: 'Lorem ipsum dolor sit amet, ut labore'
// 	},
// 	{
// 		title: 'Meeting',
// 		start: TODAY + 'T14:30:00',
// 		className: "fc-event-warning",
// 		description: 'Lorem ipsum conse ctetur adipi scing'
// 	},
// 	{
// 		title: 'Happy Hour',
// 		start: TODAY + 'T17:30:00',
// 		className: "fc-event-info",
// 		description: 'Lorem ipsum dolor sit amet, conse ctetur'
// 	},
// 	{
// 		title: 'Dinner',
// 		start: TOMORROW + 'T05:00:00',
// 		className: "fc-event-solid-danger fc-event-light",
// 		description: 'Lorem ipsum dolor sit ctetur adipi scing'
// 	},
// 	{
// 		title: 'Birthday Party',
// 		start: TOMORROW + 'T07:00:00',
// 		className: "fc-event-primary",
// 		description: 'Lorem ipsum dolor sit amet, scing'
// 	},
// 	{
// 		title: 'Click for Google',
// 		url: 'http://google.com/',
// 		start: YM + '-28',
// 		className: "fc-event-solid-info fc-event-light",
// 		description: 'Lorem ipsum dolor sit amet, labore'
// 	}
// ],
