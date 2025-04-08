
<div class="modal fade" id="teacherSearchModal" tabindex="-1" role="dialog" aria-labelledby="teacherSearchModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLabel">
						<span class="flaticon-user icon-xl mr-2 "></span>อาจารย์ผู้สอน
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<form class="form" method="POST">

						<div class="form-group row">
							<div class="col-lg-9">
								<label>ค้นหา:</label>
								<input type="text" class="form-control" placeholder="" id="md_teacher_searchkey" name="md_teacher_searchkey" value=""  />
							</div>
							<div class="col-lg-3">
								<button type="button" class="btn btn-light-success font-weight-bold mt-8" name="md_teacher_search_button" id="md_teacher_search_button">
									<span class="navi-icon mr-2">
										<span class="svg-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"></polygon>
													<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
													<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</span>
									<span class="navi-text font-size-lg">ค้นหารายชื่อ</span>
								</button>
							</div>

						</div>

						<div class="table-responsive">
							<table class="table table-hover" id="modal-teacher-search-result" style="display:none">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">ชื่อ-นามสกุล</th>
										<th scope="col">สังกัด</th>
										<th scope="col">ACTIONS</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>


					</form>

				</div>
			</div>
		</div>
</div>

<div class="modal fade" id="subjectSearchModal" tabindex="-1" role="dialog" aria-labelledby="subjectSearchModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLabel">
						<span class="flaticon-user icon-xl mr-2 "></span>รายวิชา
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<form class="form" method="POST">

						<div class="form-group row">
							<div class="col-lg-9">
								<label>ค้นหา: (รหัสวิชา / ชื่อวิชา)</label>
								<input type="text" class="form-control" placeholder="" id="md_subject_searchkey" name="md_subject_searchkey" value=""  />
							</div>
							<div class="col-lg-3">
								<button type="button" class="btn btn-light-success font-weight-bold mt-8" name="md_subject_search_button" id="md_subject_search_button">
									<span class="navi-icon mr-2">
										<i class="flaticon-book"></i>
									</span>
									<span class="navi-text font-size-lg">ค้นหารายวิชา</span>
								</button>
							</div>

						</div>

						<div class="table-responsive">
							<table class="table table-hover" id="modal-subject-search-result" style="display:none">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">ชื่อวิชา</th>
										<th scope="col">หน่วยกิจ</th>
										<th scope="col">ACTIONS</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>


					</form>

				</div>
			</div>
		</div>
</div>

<div class="modal fade" id="bookingInfoModal" tabindex="-1" role="dialog" aria-labelledby="bookingInfoModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLabel">
						<span class="flaticon-technology-2 icon-xl mr-2 "></span>รายละเอียดการจองห้อง
						<span id="md_room_name"></span>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">


					<form class="form" id="FormBookingModal"  method="post" accept-charset="utf-8">
						<div class="card-body">
							<div class="row row-for-reason" style="display: none;">
								<div class="col-lg-12">
									<div class="alert alert-custom alert-danger" id="md_booking_status_reason"></div>
								</div>
							</div>

							<div class="row">
									<div class="col-lg-6">
										<label>ชื่อผู้จอง: <span id="md_booking_name"></span></label>
									</div>
							</div>
							<div class="row">
									<div class="col-lg-12">
										<label>หน่วยงาน: <span id="md_booking_department"></span></label>
									</div>
							</div>
							<div class="row">
									<div class="col-lg-5">
										<label>อีเมล์: <span id="md_booking_email"></span></label>
									</div>
									<div class="col-lg-4">
										<label>เบอร์โทรศัพท์มือถือ: <span id="md_booking_phone"></span></label>
									</div>
									<div class="col-lg-3">
										<label>เบอร์โทรศัพท์ภายใน: <span id="md_internal_phone"></span></label>
									</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-lg-6">
									<label>ลักษณะการใช้งาน	: <span id="md_usage_category"></span> </label>
								</div>

							</div>

							<div class="row row-for-training">
								<div class="col-lg-12">
									<label>วัตถุประสงค์ในการใช้งาน:</label>
									<div class="alert alert-custom alert-default" id="md_objective"></div>
								</div>
								<div class="col-lg-6">
									<label>จำนวนผู้เข้าร่วม: <span id="md_participant"></span> คน</label>
								</div>
							</div>

							<div class="row row-for-teaching" >
								<div class="col-lg-8">
									<label>ชื่อวิชา: </label>
									<div class="alert alert-custom alert-default" id="md_subject_name"></div>
								</div>
								<div class="col-lg-4">
									<label>อาจารย์ผู้สอน: <span id="participant_Error" ></span> </label>
									<div class="alert alert-custom alert-default" id="md_teacher_fullname"></div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<label for="">ช่วงเวลาที่ต้องการจอง: <span id="md_booking_date_range"></span> </label>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<label for="">หมายเหตุ:  </label>
									<div class="alert alert-custom alert-default" id="md_booking_remark"></div>
								</div>
							</div>

						</div>

					</form>

				</div>
			</div>
		</div>
</div>
