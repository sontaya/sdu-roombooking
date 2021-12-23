		<!--begin::Content-->
			<div class="content d-flex flex-column flex-column-fluid" id="kt_booking_form">
				<!--begin::Entry-->

						<!--begin::Card-->
						<div class="card card-custom gutter-b ">
							<div class="card-header">
								<h3 class="card-title">ฟอร์มบันทึกข้อมูลการจองห้องประชุมสัมมนาและจัดเลี้ยง</h3>

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
									$val_billing_name = "";
									$val_billing_faculty = "";
									$val_room_id = "";
									$val_usage_format = "";
									$val_usage_scale = "";
									$val_usage_person = "";
									$val_event_option1 = "";
									$val_event_option2 = "";
									$val_event_option3 = "";
									$val_event_option4 = "";
									$val_event_option5 = "";
									$val_event_option6 = "";
									$val_event_option7 = "";
									$val_event_option8 = "";
									$val_event_option8_ext = "";
									$val_snack = "";
									$val_booking_date_start = "";
									$val_booking_date_end = "";
									$val_require_staff = "";
								}else{
									$val_id = $booking["id"];
									$val_user_id = $booking["user_id"];
									$val_booking_name = $booking["name"]." ".$booking["surname"];
									$val_booking_faculty = $booking["name_faculty"];
									$val_booking_email = $booking["booking_email"];
									$val_booking_phone = $booking["booking_phone"];
									$val_internal_phone = $booking["internal_phone"];
									$val_billing_name = $booking["billing_name"];
									$val_billing_faculty = $booking["billing_faculty"];
									$val_room_id = $booking["room_id"];
									$val_usage_format = $booking["usage_format"];
									$val_usage_scale = $booking["usage_scale"];
									$val_usage_person = $booking["usage_person"];
									$val_event_option1 = $booking["event_option1"];
									$val_event_option2 = $booking["event_option2"];
									$val_event_option3 = $booking["event_option3"];
									$val_event_option4 = $booking["event_option4"];
									$val_event_option5 = $booking["event_option5"];
									$val_event_option6 = $booking["event_option6"];
									$val_event_option7 = $booking["event_option7"];
									$val_event_option8 = $booking["event_option8"];
									$val_event_option8_ext = $booking["event_option8_ext"];
									$val_snack = $booking["snack"];


									$val_booking_date_start = $booking["booking_date_start"];
									$val_booking_date_end = $booking["booking_date_end"];
									$val_require_staff = $booking["require_staff"];

								}
							?>
							<form class="form" id="FormBooking" action="<?php echo base_url('dp/form_store'); ?>" method="post" accept-charset="utf-8">
								<div class="card-body">

									<div class="row">
											<div class="col-lg-12">
												<h5 class="text-info">ข้อมูลผู้จอง</h5>
											</div>
									</div>
									<hr>

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


									<div class="row mt-2">
											<div class="col-lg-12">
												<h5 class="text-info">ข้อมูลสำหรับออกใบเสร็จ</h5>
											</div>
									</div>
									<hr>

									<div class="form-group row">
											<div class="col-lg-6">
												<label>ชื่อ-นามสกุล:</label>
												<input type="text" class="form-control" placeholder="" id="billing_name" name="billing_name" value="<?= $val_billing_name ?>"  />
												<input type="hidden" name="user_id" id="user_id" value="<?= $val_user_id ?>">
											</div>
											<div class="col-lg-6">
												<label>หน่วยงาน:</label>
												<input type="text" class="form-control" placeholder="" id="billing_faculty" name="billing_faculty" value="<?= $val_billing_faculty ?>"  />
											</div>
									</div>


									<div class="row mt-2">
											<div class="col-lg-12">
												<h5 class="text-info">ข้อมูลการจอง</h5>
											</div>
									</div>
									<hr>

									<div class="form-group row">
										<div class="col-lg-4">
											<label for="exampleSelect1">ชื่อห้อง <span id="room_id_Error" ></span></label>
											<select class="form-control" id="room_id" name="room_id" data-error="#room_id_Error">
												<option value="">กรุณาเลือกห้อง</option>
												<?php
													$room_info = get_dproom_all();
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
											<label for="usage_scale">จำนวนผู้ใช้ (ช่วง) <span id="usage_scale_Error" ></span></label>
											<select class="form-control" id="usage_scale" name="usage_scale" data-error="#usage_scale_Error">
											</select>
										</div>
										<div class="col-lg-3">
											<label for="usage_format">รูปแบบห้อง <span id="usage_format_Error" ></span></label>
											<select class="form-control" id="usage_format" name="usage_format" data-error="#usage_format_Error">
											</select>
										</div>
										<div class="col-lg-2">
												<label>จำนวนผู้ใช้งาน <span id="usage_person_Error" ></span></label>
												<input type="text" class="form-control" placeholder="" id="usage_person" name="usage_person" value="<?= $val_usage_person ?>" data-error="#usage_person_Error" />
										</div>
									</div>


									<div class="form-group row">
										<div class="checkbox-single col-lg-4">
												<label class="checkbox checkbox-primary">
													<input type="checkbox" name="event_option1" id="event_option1" value="Y" <?php if($val_event_option1 == "Y"){echo "checked";} ?> /> ห้องประชุม
													<span></span>
												</label>
										</div>
									</div>

									<div class="form-group row">
										<div class="checkbox-single col-lg-4">
												<label class="checkbox checkbox-primary">
													<input type="checkbox" name="event_option2" id="event_option2" value="Y" <?php if($val_event_option2 == "Y"){echo "checked";} ?> /> อาหารว่างและเครื่องดื่ม
													<span></span>
												</label>
										</div>

										<div class="col-lg-8">

											<div class="radio">
												<label class="radio radio-solid">
													<input type="radio" name="snack"  value="1" <?php if($val_snack == "1"){echo "checked";} ?> />1 มื้อ
													<span></span>
												</label>
												<label class="radio radio-solid">
													<input type="radio" name="snack" value="2" <?php if($val_snack == "2"){echo "checked";} ?> />2 มื้อ
													<span></span>
												</label>
											</div>

										</div>
									</div>

									<div class="form-group row">
										<div class="checkbox-single col-lg-4">
												<label class="checkbox checkbox-primary">
													<input type="checkbox" name="event_option3" id="event_option3" value="Y" <?php if($val_event_option3 == "Y"){echo "checked";} ?> /> อาหารเช้า
													<span></span>
												</label>
										</div>


										<div class="checkbox-single col-lg-4">
												<label class="checkbox checkbox-primary">
													<input type="checkbox" name="event_option4" id="event_option4" value="Y" <?php if($val_event_option4 == "Y"){echo "checked";} ?> /> อาหารกลางวัน
													<span></span>
												</label>
										</div>


										<div class="checkbox-single col-lg-4">
											<label class="checkbox checkbox-primary">
												<input type="checkbox" name="event_option5" id="event_option5" value="Y" <?php if($val_event_option5 == "Y"){echo "checked";} ?> /> อาหารเย็น
												<span></span>
											</label>
										</div>

									</div>

									<div class="form-group row">
										<div class="checkbox-single col-lg-4">
												<label class="checkbox checkbox-primary">
													<input type="checkbox" name="event_option6" id="event_option6" value="Y" <?php if($val_event_option6 == "Y"){echo "checked";} ?> /> คอกเทล
													<span></span>
												</label>
										</div>


										<div class="checkbox-single col-lg-4">
												<label class="checkbox checkbox-primary">
													<input type="checkbox" name="event_option7" id="event_option7" value="Y" <?php if($val_event_option7 == "Y"){echo "checked";} ?> /> งานฉลองมงคลสมรส
													<span></span>
												</label>
										</div>


										<div class="checkbox-single col-lg-4">
											<label class="checkbox checkbox-primary">
												<input type="checkbox" name="event_option8" id="event_option8" value="Y" <?php if($val_event_option8 == "Y"){echo "checked";} ?> /> อื่นๆ
												<span></span>
											</label>
										</div>

									</div>

									<div class="form-group row">
										<div class="col-lg-12">
											<label>อื่นๆ โปรดระบุ: <span id="event_option8_ext_Error" ></span></label>
											<input type="text" class="form-control" placeholder="" id="event_option8_ext" name="event_option8_ext"
												value="<?= $val_event_option8_ext; ?>" data-error="#event_option8_ext_Error" />
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
											<input type="hidden" name="hid_usage_scale" id="hid_usage_scale" value="<?= $val_usage_scale; ?>">
											<input type="hidden" name="hid_usage_format" id="hid_usage_format" value="<?= $val_usage_format; ?>">
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
