		<!--begin::Content-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_booking_form">
				<!--begin::Entry-->

						<!--begin::Card-->
						<div class="card card-custom gutter-b ">
							<div class="card-header">
								<h3 class="card-title">ฟอร์มบันทึกข้อมูลการจองห้องโดยเจ้าหน้าที่</h3>

							</div>
							<!--begin::Form-->
							<?php
								if($form_mode == "insert"){
									$val_id = "";
									$val_user_id = "";
									$val_booking_name = "";
									$val_booking_faculty = "";
									$val_booking_email = "";
									$val_booking_phone = "";
									$val_internal_phone = "";
									$val_room_id = "";
									$val_usage_category = "";
									$val_subject_id = "";
									$val_subject_code = "";
									$val_subject_name = "";
									$val_teacher_id = "";
									$val_teacher_fullname = "";
									$val_teacher_flag = "";

									$val_objective = "";
									$val_participant = "";
									$val_booking_date_start = "";
									$val_booking_date_end = "";

									$val_booking_remark = "";
									$val_booking_status ="approved";
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
									$val_subject_id = $booking["subject_id"];
									$val_subject_code = $booking["subject_code"];
									$val_subject_name = $booking["subject_name"];
									$val_teacher_id = $booking["teacher_id"];
									$val_teacher_fullname = $booking["teacher_fullname"];
									$val_teacher_flag = $booking["teacher_flag"];

									$val_objective = $booking["objective"];
									$val_participant = $booking["participant"];
									$val_booking_date_start = $booking["booking_date_start"];
									$val_booking_date_end = $booking["booking_date_end"];

									$val_booking_remark = $booking["booking_remark"];
									$val_booking_status = $booking["booking_status"];

								}
							?>
							<form class="form" id="FormBookingAdmin" action="<?php echo base_url('hybridbackoffice/form_admin_store'); ?>" method="post" accept-charset="utf-8">
								<div class="card-body">

									<div class="form-group row">
											<div class="col-lg-5">
												<label>ชื่อผู้จอง: <span id="booking_name_Error" ></span></label>
												<input type="text" class="form-control custom-readonly" readonly id="booking_name" name="booking_name" value="<?= $val_booking_name ?>" data-error="#booking_name_Error" />
												<input type="hidden" name="user_id" id="user_id" value="<?= $val_user_id ?>">
											</div>
											<div class="col-lg-5">
												<label>หน่วยงาน:</label>
												<input type="text" class="form-control custom-readonly" readonly id="booking_faculty" name="booking_faculty" value="<?= $val_booking_faculty ?>"  />
											</div>
											<div class="col-lg-2">

												<a href="javascript:;"  class="btn btn-light-success font-weight-bold mt-8 search-profile">
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
												</a>
											</div>

									</div>

									<div class="form-group row">
											<div class="col-lg-6">
											<label>อีเมล์สำหรับติดต่อ:</label>
												<input type="email" class="form-control" placeholder="" id="booking_email" name="booking_email" value="<?= $val_booking_email; ?>" />
											</div>
											<div class="col-lg-2">
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
													//$room_info = get_room_all();
													foreach ($room_info as $r) {
												?>
													<option value="<?= $r["id"] ?>" <?php if($val_room_id == $r["id"]){echo "selected";} ?>>
														<?= $r["name"] ?> - <?= $r["place"] ?>
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
														จัดการเรียนการสอน
													</option>
													<option value="2" <?php if($val_usage_category == 2){echo "selected";} ?>>
														จัดอบรม
													</option>

											</select>
										</div>

									</div>

									<?php
										if($form_mode == "update" && $val_usage_category =="1"){
											$row_style1_value = "";
										}else{
											$row_style1_value = "style='display: none;'";
										}
									?>

									<div class="form-group row row-for-teaching" <?= $row_style1_value ?>  >
										<div class="col-lg-6">
											<label>ชื่อวิชา: <span id="subject_name_Error" ></span></label>
											<div class="input-group">
												<input type="text" class="form-control custom-readonly" id="subject_name" name="subject_name" readonly
													value="<?= $val_subject_name; ?>" data-error="#subject_name_Error" />
												<input type="hidden" id="subject_id" name="subject_id" value="<?= $val_subject_id; ?>" />
												<input type="hidden" id="subject_code" name="subject_code" value="<?= $val_subject_code; ?>" />
												<div class="input-group-append">
													<a href="javascript:;"  class="btn btn-light-success search-subject">
														<i class="flaticon-book"></i>
													</a>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<label>อาจารย์ผู้สอน: <span id="teacher_fullname_Error" ></span> </label>
											<label class="checkbox">
												<input type="checkbox" name="teacher_flag" id="teacher_flag" value="Y" <?php if($val_teacher_flag == "Y"){echo "checked";} ?> /> ข้อมูลเดียวกับผู้จอง
												<span></span>
											</label>
											<div class="input-group">
												<input type="text" class="form-control custom-readonly" id="teacher_fullname" name="teacher_fullname" readonly
													value="<?= $val_teacher_fullname; ?>" data-error="#teacher_fullname_Error"  />
												<input type="hidden" id="teacher_id" name="teacher_id" value="<?= $val_teacher_id; ?>" />
												<div class="input-group-append">
													<a href="javascript:;"  class="btn btn-light-success search-teacher">
														<i class="flaticon2-user"></i>
													</a>
												</div>
											</div>
										</div>
									</div>


									<?php
										if($form_mode == "update" && $val_usage_category =="2"){
											$row_style2_value = "";
										}else{
											$row_style2_value = "style='display: none;'";
										}
									?>
									<div class="form-group row row-for-training" <?= $row_style2_value ?>  >
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

									</div>
									<div class="form-group row " >
										<div class="col-lg-10">
											<label>หมายเหตุ: <span id="booking_remark_Error" ></span></label>
											<input type="text" class="form-control" placeholder="" id="booking_remark" name="booking_remark"
												value="<?= $val_booking_remark; ?>" data-error="#booking_remark_Error" />
										</div>
									</div>

									<div class="form-group row">
										<div class="col-lg-4 col-md-9 col-sm-12">
											<label>สถานะการอนุมัติ:</label>
											<div class="radio-inline">
												<label class="radio radio-solid">
												<input type="radio" name="booking_status"  value="approved"  <?php if($val_booking_status == "approved"){echo "checked";} ?> />อนุมัติ
												<span></span></label>
												<label class="radio radio-solid">
												<input type="radio" name="booking_status" value="pending"  <?php if($val_booking_status == "pending"){echo "checked";} ?>/>ขออนุมัติ
												<span></span></label>
												<label class="radio radio-solid">
												<input type="radio" name="booking_status" value="rejected"  <?php if($val_booking_status == "rejected"){echo "checked";} ?>/>ไม่อนุมัติ
												<span></span></label>
												<label class="radio radio-solid">
												<input type="radio" name="booking_status" value="canceled"  <?php if($val_booking_status == "canceled"){echo "checked";} ?>/>ยกเลิกโดยผู้จอง
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
											<input type="hidden" name="teacher_code" id="teacher_code" value="<?= $teacher_code; ?>">
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



<?php
	include("_inc_hybridbackoffice_modal.php");
?>
