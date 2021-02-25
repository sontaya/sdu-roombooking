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
									$val_objective = "";
									$val_participant = "";
									$val_booking_date_start = "";
									$val_booking_date_end = "";
									$val_require_staff = "";
									$val_booking_status ="approved";
								}else{
									$val_id = $booking["id"];
									$val_user_id = $booking["user_id"];
									$val_booking_name = $booking["name"]." ".$booking["surname"];
									$val_booking_faculty = $booking["name_faculty"];
									$val_booking_email = $booking["booking_email"];
									$val_booking_phone = $booking["booking_phone"];
									$val_internal_phone = $booking["internal_phone"];
									$val_room_id = $booking["room_id"];
									$val_usage_category = $booking["usage_category"];
									$val_objective = $booking["objective"];
									$val_participant = $booking["participant"];
									$val_booking_date_start = $booking["booking_date_start"];
									$val_booking_date_end = $booking["booking_date_end"];
									$val_require_staff = $booking["require_staff"];
									$val_booking_status = $booking["booking_status"];

								}
							?>
							<form class="form" id="FormBookingAdmin" action="<?php echo base_url('backoffice/form_admin_store'); ?>" method="post" accept-charset="utf-8">
								<div class="card-body">

									<div class="form-group row">
											<div class="col-lg-5">
												<label>ชื่อผู้จอง:</label>
												<input type="text" class="form-control" placeholder="" id="booking_name" name="booking_name" value="<?= $val_booking_name ?>" disabled="disabled" />
												<input type="hidden" name="user_id" id="user_id" value="<?= $val_user_id ?>">
											</div>
											<div class="col-lg-5">
												<label>หน่วยงาน:</label>
												<input type="text" class="form-control" placeholder="" id="booking_faculty" name="booking_faculty" value="<?= $val_booking_faculty ?>" disabled="disabled" />
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
										<div class="col-lg-6">
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



<div class="modal fade" id="bookingSearchModal" tabindex="-1" role="dialog" aria-labelledby="bookingInfoModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLabel">
						<span class="flaticon-user icon-xl mr-2 "></span>ค้นหาบุคลากร
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
								<input type="text" class="form-control" placeholder="" id="md_searchkey" name="md_searchkey" value=""  />
							</div>
							<div class="col-lg-3">
								<button type="button" class="btn btn-light-success font-weight-bold mt-8" name="md_search_button" id="md_search_button">
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
							<table class="table table-hover" id="modal-search-result" style="display:none">
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
