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
											<label>ลักษณะการใช้งาน: <span id="md_usage_category"></span> </label>
										</div>
										<div class="col-lg-6">
											<label>ซอฟต์แวร์ที่ใช้งาน: <span id="md_usage_software"></span> </label>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<label>วัตถุประสงค์ในการใช้งาน:</label>
											<div class="alert alert-custom alert-default" id="md_objective"></div>

										</div>
									</div>

									<div class="row">

										<div class="col-lg-6">
											<label>จำนวนผู้เข้าร่วม: <span id="md_participant"></span> คน</label>
										</div>
										<div class="col-lg-6">
											<label>เจ้าหน้าที่ประจำห้อง: <span id="md_require_staff"></span></label>
										</div>

									</div>

									<div class="row">
										<div class="col-lg-12">
											<label for="">ช่วงเวลาที่ต้องการจอง: <span id="md_booking_date_range"></span> </label>
										</div>
									</div>

								</div>

						</div>
					</div>
				</div>
		</div>
