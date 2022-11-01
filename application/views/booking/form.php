		<!--begin::Content-->
			<div class="content d-flex flex-column flex-column-fluid" id="kt_booking_form">
				<!--begin::Entry-->

						<!--begin::Card-->
						<div class="card card-custom gutter-b ">
							<div class="card-header">
								<h3 class="card-title">ฟอร์มบันทึกข้อมูลการจองห้อง</h3>

							</div>
							<!--begin::Form-->
							<?php
								if($form_mode == "insert"){
									$val_id = "";
									$val_user_id = $this->session->userdata('auth')['hrcode'];
									$val_booking_name = $this->session->userdata('auth')['displayname'];
									$val_booking_faculty = $this->session->userdata('auth')['name_faculty'];
									$val_booking_email = $default_contact["email_default"];
									$val_booking_phone = $default_contact["mobile_phone_default"];
									$val_internal_phone = $default_contact["internal_phone_default"];
									$val_room_id = "";
									$val_usage_category = "";
									$val_usage_software = "";
									$val_objective = "";
									$val_participant = "";
									$val_booking_date_start = "";
									$val_booking_date_end = "";
									$val_require_staff = "";
								}else{
									$val_id = $booking["id"];
									$val_user_id = $booking["user_id"];
									$val_booking_name = $booking["academic_fullname"];
									$val_booking_faculty = $booking["name_faculty"];
									$val_booking_email = $booking["booking_email"];
									$val_booking_phone = $booking["booking_phone"];
									$val_internal_phone = $booking["internal_phone"];
									$val_room_id = $booking["room_id"];
									$val_usage_category = $booking["usage_category"];
									$val_usage_software = $booking["usage_software"];
									$val_objective = $booking["objective"];
									$val_participant = $booking["participant"];
									$val_booking_date_start = $booking["booking_date_start"];
									$val_booking_date_end = $booking["booking_date_end"];
									$val_require_staff = $booking["require_staff"];
								}
							?>
							<form class="form" id="FormBooking" action="<?php echo base_url('booking/form_store'); ?>" method="post" accept-charset="utf-8">
								<div class="card-body">

									<div class="form-group row">
											<div class="col-lg-6">
												<label>ชื่อผู้จอง:</label>
												<input type="text" class="form-control" placeholder="" id="booking_name" name="booking_name" value="<?= $val_booking_name ?>" disabled="disabled" />
												<input type="hidden" name="user_id" id="user_id" value="<?= $val_user_id ?>">
											</div>
											<div class="col-lg-6">
												<label>หน่วยงาน:</label>
												<input type="text" class="form-control" placeholder="" id="booking_faculty" name="booking_faculty" value="<?= $val_booking_faculty ?>" disabled="disabled" />
											</div>

									</div>

									<div class="form-group row">
											<div class="col-lg-6">
											<label>อีเมลสำหรับติดต่อ:</label>
												<input type="email" class="form-control" placeholder="" id="booking_email" name="booking_email" value="<?= $val_booking_email; ?>" />
											</div>
											<div class="col-lg-3">
												<label>เบอร์โทรศัพท์มือถือ: <span id="booking_phone_Error" ></span></label>
												<input type="text" class="form-control" placeholder="" id="booking_phone" name="booking_phone"
													value="<?= $val_booking_phone; ?>" data-error="#booking_phone_Error" />
											</div>
											<div class="col-lg-3">
												<label>เบอร์โทรศัพท์ภายใน: <span id="internal_phone_Error" ></span></label>
												<input type="text" class="form-control" placeholder="" id="internal_phone" name="internal_phone"
													value="<?= $val_internal_phone; ?>" data-error="#internal_phone_Error" />
											</div>
									</div>

									<hr>

									<div class="form-group row">
										<div class="col-lg-6">
											<label for="exampleSelect1">ชื่อห้อง <span id="room_id_Error" ></span></label>
											<select class="form-control" id="room_id" name="room_id" data-error="#room_id_Error">
												<option value="">กรุณาเลือกห้อง</option>
												<?php
													$room_info = get_room_all();
													foreach ($room_info as $r) {
												?>
													<option value="<?= $r["id"] ?>" <?php if($val_room_id == $r["id"]){echo "selected";} ?>>
														<?= $r["name"] ?>
													</option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="col-lg-3">
											<label for="exampleSelect1">ลักษณะการใช้งาน <span id="usage_category_Error" ></span></label>
											<select class="form-control" id="usage_category" name="usage_category" data-error="#usage_category_Error">
												<option value="">กรุณาเลือกลักษณะการใช้งาน</option>

													<option value="1" <?php if($val_usage_category == 1){echo "selected";} ?>>
														ออนไลน์ - การสอน (Live)
													</option>
													<option value="2" <?php if($val_usage_category == 2){echo "selected";} ?>>
														ออนไลน์ - การประชุม (Live)
													</option>
													<option value="3" <?php if($val_usage_category == 3){echo "selected";} ?>>
														ออนแอร์ (ถ่ายทำรายการในสตูดิโอ)
													</option>

											</select>
										</div>
										<div class="col-lg-3">
											<label for="exampleSelect1">ซอฟต์แวร์ที่ต้องการใช้งาน <span id="usage_software_Error" ></span></label>
											<select class="form-control" id="usage_software" name="usage_software" data-error="#usage_software_Error">
												<option value="">กรุณาเลือกซอฟต์แวร์ที่ต้องการใช้งาน</option>

													<option value="None" <?php if($val_usage_software == 'None'){echo "selected";} ?>>
														ไม่ได้ใช้งาน
													</option>
													<option value="Team" <?php if($val_usage_software == 'Team'){echo "selected";} ?>>
														Microsoft Team
													</option>
													<option value="Zoom" <?php if($val_usage_software == 'Zoom'){echo "selected";} ?>>
														Zoom
													</option>
													<option value="DingTalk" <?php if($val_usage_software == 'DingTalk'){echo "selected";} ?>>
														DingTalk
													</option>
													<option value="Meet" <?php if($val_usage_software == 'Meet'){echo "selected";} ?>>
														Google Meet
													</option>
													<option value="WebEx" <?php if($val_usage_software == 'WebEx'){echo "selected";} ?>>
														WebEx
													</option>

											</select>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-lg-10">
											<label>ชื่อกิจกรรม: <span id="objective_Error" ></span></label>
											<input type="text" class="form-control" placeholder="" id="objective" name="objective"
												value="<?= $val_objective; ?>" data-error="#objective_Error" />
										</div>
										<div class="col-lg-2">
											<label>จำนวนผู้เข้าร่วม: <span id="participant_Error" ></span></label>
											<input type="text" class="form-control" placeholder="" id="participant" name="participant"
												value="<?= $val_participant; ?>" data-error="#participant_Error" />
										</div>

									</div>

									<div class="form-group row">
										<div class="col-lg-4 col-md-9 col-sm-12">
											<label for="">ระบุวันที่ เวลาเริ่ม <span id="booking_date_start_Error" ></span></label>
											<div class="input-group date">
												<input type="text" class="form-control" readonly="readonly"
													value="<?= $val_booking_date_start; ?>" data-error="#booking_date_start_Error"
													id="booking_date_start" name="booking_date_start" />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar glyphicon-th"></i>
													</span>
												</div>
											</div>
										</div>

										<div class="col-lg-4 col-md-9 col-sm-12">
											<label for="">ระบุวันที่ เวลาสิ้นสุด <span id="booking_date_end_Error" ></span></label>
											<div class="input-group date">
												<input type="text" class="form-control" readonly="readonly"
													value="<?= $val_booking_date_end; ?>" data-error="#booking_date_end_Error"
													id="booking_date_end" name="booking_date_end" />
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
												<input type="radio" name="require_staff"  value="Y"  <?php if($val_require_staff == "Y"){echo "checked";} ?> />ต้องการ
												<span></span></label>
												<label class="radio radio-solid">
												<input type="radio" name="require_staff" value="N"  <?php if($val_require_staff == "N"){echo "checked";} ?>/>ไม่ต้องการ
												<span></span></label>
											</div>

										</div>
									</div>

								</div>
								<div class="card-footer">
									<div class="row">
										<div class="col-lg-6">
											<button type="submit" class="btn btn-primary mr-2">บันทึก</button>
											<button type="reset" class="btn btn-secondary">ยกเลิก</button>
											<input type="hidden" name="form_mode" id="form_mode" value="<?= $form_mode; ?>">
											<input type="hidden" name="form_id" id="form_id" value="<?= $val_id; ?>">
										</div>
									</div>
								</div>
							</form>
							<!--end::Form-->
						</div>
						<!--end::Card-->

				<!--end::Entry-->
			</div>
		<!--end::Content-->
