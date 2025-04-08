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

							<div class="row">
									<div class="col-lg-12">
										<h5 class="text-success">ข้อมูลผู้จอง</h5>
									</div>
							</div>
							<hr>

							<div class="row">
									<div class="col-lg-6">
										<label><strong>ชื่อผู้จอง:</strong> <span id="md_booking_name"></span></label>
									</div>
							</div>
							<div class="row">
									<div class="col-lg-12">
										<label><strong>สังกัด:</strong> <span id="md_booking_department"></span></label>
									</div>
							</div>

							<div class="row">
									<div class="col-lg-5">
										<label><strong>อีเมล์:</strong> <span id="md_booking_email"></span></label>
									</div>
									<div class="col-lg-4">
										<label><strong>เบอร์โทรศัพท์มือถือ:</strong> <span id="md_booking_phone"></span></label>
									</div>
									<div class="col-lg-3">
										<label><strong>เบอร์โทรศัพท์ภายใน:</strong> <span id="md_internal_phone"></span></label>
									</div>
							</div>
							<div class="row">
									<div class="col-lg-12">
										<h5 class="text-success">ข้อมูลกิจกรรม</h5>
									</div>
							</div>
							<hr>

							<div class="row">
								<div class="col-lg-12">
									<label><strong>ชื่อกิจกรรม: &nbsp;</strong> <span id="md_event_name"></span></label>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<label><strong>บริการที่ใช้งาน: &nbsp;</strong><span id="md_service_names"></span></label>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<label><strong>พื้นที่จัดกิจกรรม: &nbsp;</strong><span id="md_place_names"></span></label>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<label><strong>เจ้าหน้าที่ปฏิบัติงาน: &nbsp;</strong><span id="md_staff_names"></span></label>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-4">
									<label><strong>จำนวนคน: &nbsp;</strong><span id="md_usage_person"></span></label>
								</div>

							</div>


							<div class="row">
								<div class="col-lg-12">
									<label for=""><strong>ช่วงเวลาที่ต้องการจอง:</strong> &nbsp;<span id="md_booking_date_range"></span> </label>
								</div>

							</div>

							<div class="row">
								<div class="col-lg-12">
									<label for=""><strong>หมายเหตุ:</strong> &nbsp;<span id="md_event_note"></span> </label>
								</div>
							</div>

						</div>
						<div class="card-footer">
							<div class="form-group row">
								<div class="col-lg-8">
									<input type="text" class="form-control" name="md_reason" id="md_reason" value="" placeholder="ระบุเหตุผลในการยกเลิก/ไม่อนุมัติ">
								</div>
								<div class="col-lg-4">
									<button type="button" id="md_button_reject" class="btn btn-lg btn-default disabled">ไม่อนุมัติ</button>
									<button type="button" id="md_button_approve" class="btn btn-success btn-lg mr-2">อนุมัติ</button>
									<input type="hidden" name="md_id" id="md_id" value="">
								</div>
							</div>

						</div>
					</form>

				</div>
			</div>
		</div>
</div>

