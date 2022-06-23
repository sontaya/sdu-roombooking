	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">

			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header flex-wrap border-0 pt-6 pb-0">
					<div class="card-title">
						<h3 class="card-label">Booking Manage</h3>
					</div>
					<div class="card-toolbar">
						<!--begin::Dropdown-->
						<div class="dropdown dropdown-inline mr-2">
							<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="svg-icon svg-icon-md">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
										<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>Export</button>
							<!--begin::Dropdown Menu-->
							<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
								<!--begin::Navigation-->
								<ul class="navi flex-column navi-hover py-2">
									<li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>

									<li class="navi-item">
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="la la-file-excel-o"></i>
											</span>
											<span class="navi-text">Excel</span>
										</a>
									</li>

								</ul>
								<!--end::Navigation-->
							</div>
							<!--end::Dropdown Menu-->
						</div>
						<!--end::Dropdown-->

					</div>
				</div>
				<div class="card-body">
					<!--begin: Search Form-->
					<!--begin::Search Form-->
					<div class="mb-7">
						<div class="row">
							<div class="col-lg-9 col-xl-8">
								<div class="row align-items-center">

									<div class="col-lg-4 col-md-9 col-sm-12">

											<label for="">เลือกห้อง</label>
											<select class="form-control" id="kt_datatable_search_room" name="kt_datatable_search_room">
												<option value="">ห้องทั้งหมด</option>
												<?php
													$room_info = get_room_all();
													foreach ($room_info as $r) {
												?>
														<option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
												<?php } ?>
											</select>

									</div>

									<div class="col-lg-4 col-md-9 col-sm-12">
										<label for="">ระบุวันที่เริ่มต้น</label>
										<div class="input-group date">
											<input type="text" class="form-control" readonly="readonly" value="2020-07-09 08:30" id="kt_datatable_search_date1" name="kt_datatable_search_date1" />
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar glyphicon-th"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<label for="">ระบุวันที่สิ้นสุด</label>
										<div class="input-group date">
											<input type="text" class="form-control" readonly="readonly" value="2020-07-09 08:30" id="kt_datatable_search_date2" name="kt_datatable_search_date2" />
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar glyphicon-th"></i>
												</span>
											</div>
										</div>
									</div>


								</div>
							</div>

							<!-- <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0 mt-4 ">
								<a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
							</div>
						-->
						</div>

					</div>
					<!--end::Search Form-->
					<!--end: Search Form-->
					<!--begin: Datatable-->
					<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
					<!--end: Datatable-->
				</div>
			</div>
			<!--end::Card-->

		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->


<div class="modal fade" id="bookingInfoModal" tabindex="-1" role="dialog" aria-labelledby="bookingInfoModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLabel">
						<span class="flaticon-technology-2 icon-xl mr-2 "></span>ข้อมูลการจองห้อง
						<span id="room_name"></span>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">


					<form class="form" id="FormBookingModal"  method="post" accept-charset="utf-8">
						<div class="card-body">

							<div class="form-group row">
									<div class="col-lg-6">
										<label>ชื่อผู้จอง:</label>
										<input type="text" class="form-control" placeholder="" id="booking_name" name="booking_name" value="<?= $this->session->userdata('auth')['displayname'] ?>" readonly="readonly" />
									</div>

							</div>

							<div class="form-group row">
									<div class="col-lg-6">
									<label>อีเมล์สำหรับติดต่อ:</label>
										<input type="email" class="form-control" placeholder="" id="booking_email" name="booking_email" />
									</div>
									<div class="col-lg-6">
									<label>เบอร์โทรศัพท์สำหรับติดต่อ:</label>
										<input type="text" class="form-control" placeholder="" id="booking_phone" name="booking_phone" />
									</div>
							</div>

							<hr>

							<div class="form-group row">
								<div class="col-lg-10">
									<label>วัตถุประสงค์ในการใช้งาน:</label>
									<input type="text" class="form-control" placeholder="" id="objective" name="objective" />
								</div>
								<div class="col-lg-2">
									<label>จำนวนผู้เข้าร่วม:</label>
									<input type="text" class="form-control" placeholder="" id="participant" name="participant" />
								</div>

							</div>

							<div class="form-group row">
								<div class="col-lg-4 col-md-9 col-sm-12">
									<label for="">ระบุวันที่ เวลาเริ่ม</label>
									<div class="input-group date">
										<input type="text" class="form-control" readonly="readonly" value="2020-07-09 08:30" id="booking_date_start" name="booking_date_start" />
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="la la-calendar glyphicon-th"></i>
											</span>
										</div>
									</div>
								</div>

								<div class="col-lg-4 col-md-9 col-sm-12">
									<label for="">ระบุวันที่ เวลาสิ้นสุด</label>
									<div class="input-group date">
										<input type="text" class="form-control" readonly="readonly" value="2020-07-09 12:00" id="booking_date_end" name="booking_date_end" />
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="la la-calendar glyphicon-th"></i>
											</span>
										</div>
									</div>
								</div>

								<div class="col-lg-4 col-md-9 col-sm-12">
									<label>เจ้าหน้าที่ประจำห้อง:</label>
									<div class="radio-inline">
										<label class="radio radio-solid">
										<input type="radio" name="require_staff" checked="checked" value="Y" />ต้องการ
										<span></span></label>
										<label class="radio radio-solid">
										<input type="radio" name="require_staff" value="N" />ไม่ต้องการ
										<span></span></label>
									</div>

								</div>
							</div>


						</div>
						<div class="card-footer d-flex justify-content-end">
									<button type="button" class="btn btn-success btn-lg mr-2">อนุมัติ</button>
									<button type="reset" class="btn btn-danger btn-lg">ไม่อนุมัติ</button>
						</div>
					</form>

				</div>
			</div>
		</div>
</div>
