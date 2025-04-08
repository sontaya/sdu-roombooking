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

									$val_event_name = "";
									$val_event_note = "";
									$val_room_id = "";

									$val_booking_date_start = "";
									$val_booking_date_end = "";
									$val_require_staff = "";
									$val_booking_status ="approved";
								}else{
									$val_id = $booking["id"];
									$val_user_id = $booking["user_id"];
									$val_booking_name = $booking["academic_fullname"];
									$val_booking_faculty = $booking["name_faculty"];
									$val_booking_email = $booking["booking_email"];
									$val_booking_phone = $booking["booking_phone"];
									$val_internal_phone = $booking["internal_phone"];
									$val_event_name = $booking["event_name"];
									$val_event_note = $booking["event_note"];
									$val_room_id = $booking["room_id"];


									$val_booking_date_start = $booking["booking_date_start"];
									$val_booking_date_end = $booking["booking_date_end"];
									$val_booking_status = $booking["booking_status"];
									$val_require_staff = $booking["require_staff"];

								}
							?>
							<form class="form" id="FormBookingAdmin" action="<?php echo base_url('spacebackoffice/form_admin_store'); ?>" method="post" accept-charset="utf-8">
								<div class="card-body">
										<div class="row">
												<div class="col-lg-12">
													<h5 class="text-success">ข้อมูลผู้จอง</h5>
												</div>
										</div>
										<hr>
										<div class="form-group row">
											<div class="col-lg-4">
												<label>ชื่อผู้จอง:</label>
												<input type="text" class="form-control" placeholder="" id="booking_name" name="booking_name" value="<?= $val_booking_name ?>" disabled="disabled" />
												<input type="hidden" name="user_id" id="user_id" value="<?= $val_user_id ?>">
											</div>
											<div class="col-lg-5">
												<label>หน่วยงาน:</label>
												<input type="text" class="form-control" placeholder="" id="booking_faculty" name="booking_faculty" value="<?= $val_booking_faculty ?>" disabled="disabled" />
											</div>
											<div class="col-lg-3">

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


												<a href="javascript:;"  class="btn btn-light-warning font-weight-bold mt-8 add-profile">
													<span class="navi-icon mr-2">
														<span class="svg-icon">
															<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24"></polygon>
																		<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
																		<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
																	</g>
																</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
													<span class="navi-text font-size-lg">เพิ่มรายชื่อ</span>
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

									<div class="row mt-2">
											<div class="col-lg-12">
												<h5 class="text-success">ข้อมูลกิจกรรม</h5>
											</div>
									</div>
									<hr>
									<div class="form-group row">
											<div class="col-lg-12">
												<label>ชื่อกิจกรรม:<span id="event_name_Error" ></span></label>
												<input type="text" class="form-control" placeholder="" id="event_name" name="event_name" value="<?= $val_event_name ?>" data-error="#event_name_Error" />
											</div>
									</div>
									<div class="row">
										<div class="col-xl-12">
												<label>บริการที่ใช้งาน:</label>
										</div>
									</div>
									<div class="form-group row">


										<?php
											foreach ($service_info as $sv) {
												// if ($room_grants != "") {
												// 	if (in_array($sv["id"], $room_grants)) {
												// 		$room_checked = "checked='checked'";
												// 	} else {
												// 		$room_checked = "";
												// 	}
												// }



										?>
											<div class="col-md-2 col-xs-12">
												<div class="checkbox-single mb-2">
													<label class="checkbox checkbox-primary">
														<input type="checkbox" name="service_info[]" value="<?= $sv["id"] ?>" <?php	echo (isset($selected_service) && in_array($sv['id'], $selected_service)) ? 'checked' : ''; ?> />
															<?= $sv["name"] ?>
													<span></span></label>
												</div>
											</div>
										<?php
											}
										?>
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
											<label>จำนวนผู้เข้าร่วม <span id="usage_person_Error" ></span></label>
											<input type="text" class="form-control" placeholder="" id="usage_person" name="usage_person" value="<?= $val_usage_person ?>" data-error="#usage_person_Error" />
										</div>

									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="alert alert-success" role="alert">
												สถานที่จัดกิจกรรม
											</div>
											<select id="duallistbox_place" name="space_id[]" multiple="multiple"
												data-available-title="สถานที่ทั้งหมด"
												data-selected-title="สถานที่เลือก">
												<?php foreach($place_info as $pmi): ?>
													<option value="<?php echo $pmi['id']; ?>"
														<?php echo (isset($selected_spaces) && in_array($pmi['id'], $selected_spaces)) ? 'selected' : ''; ?>>
														<?php echo $pmi["name"]; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-md-6">
											<div class="alert alert-success" role="alert">
												ผู้ปฏิบัติงาน
											</div>
											<select id="duallistbox" name="selected_staff[]" multiple="multiple"
												data-available-title="รายการผู้ใช้งานทั้งหมด"
												data-selected-title="รายการที่เลือก">
												<?php foreach($arit_members as $member): ?>
													<option value="<?php echo $member['user_id']; ?>"
														<?php echo (isset($selected_staff) && in_array($member['user_id'], $selected_staff)) ? 'selected' : ''; ?>>
														<?php echo $member["academic_fullname"]; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="form-group row mt-1">
										<label for="event_note">หมายเหตุ</label>
										<textarea class="form-control" id="event_note" name="event_note" rows="3"><?php echo $val_event_note; ?></textarea>
									</div>

									<div class="row mt-2">
											<div class="col-lg-12">
												<h5 class="text-success">สถานะการอนุมัติ</h5>
											</div>
									</div>
									<hr>

									<div class="form-group row">
										<div class="col-lg-4 col-md-9 col-sm-12">
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
						<div class="radio-inline">
							<label class="radio">
								<input type="radio" name="search_group" class="search_group"  value="1" checked="checked" /> บุคลากรมหาวิทยาลัย (ฐานข้อมูลกองบริหารงานบุคคล)
								<span></span>
							</label>
							<label class="radio">
								<input type="radio" name="search_group" class="search_group"  value="2"/> สำนักกิจการพิเศษ / บุคคลภายนอก
								<span></span>
							</label>
						</div>

					</div>

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

<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLabel">
						<span class="flaticon-user icon-xl mr-2 "></span>เพิ่มข้อมูลผู้ติดต่อ (บุคคลภายนอก)
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<form class="form" method="POST" id="FormNewUser">

								<div class="card-body">

									<div class="form-group row">
											<div class="col-lg-3">
												<label>ชื่อ:</label>
												<input type="text" class="form-control" placeholder="" id="mod_user_name" name="mod_user_name" value="" />
											</div>
											<div class="col-lg-3">
												<label>นามสกุล:</label>
												<input type="text" class="form-control" placeholder="" id="mod_user_surname" name="mod_user_surname" value="" />
											</div>
											<div class="col-lg-6">
												<label>หน่วยงาน:</label>
												<input type="text" class="form-control" placeholder="" id="mod_user_faculty" name="mod_user_faculty" value="" />
											</div>

									</div>

									<div class="form-group row">
											<div class="col-lg-6">
											<label>อีเมลสำหรับติดต่อ:</label>
												<input type="text" class="form-control" placeholder="" id="mod_email_default" name="mod_email_default" value="" />
											</div>
											<div class="col-lg-3">
												<label>เบอร์โทรศัพท์มือถือ: <span id="mod_mobile_phone_default_Error" ></span></label>
												<input type="text" class="form-control" placeholder="" id="mod_mobile_phone_default" name="mod_mobile_phone_default"
													value="" data-error="#mod_mobile_phone_default_Error" />
											</div>
											<div class="col-lg-3">
												<label>เบอร์โทรศัพท์ภายใน: <span id="mod_internal_phone_default_Error" ></span></label>
												<input type="text" class="form-control" placeholder="" id="mod_internal_phone_default_default" name="mod_internal_phone_default_default"
													value="" data-error="#mod_internal_phone_default_Error" />
											</div>
									</div>


								</div>
								<div class="card-footer">
									<div class="row">
										<div class="col-lg-6">
											<button type="submit" id="submit_button" class="btn btn-primary mr-2">บันทึก</button>
										</div>
									</div>
								</div>

					</form>

				</div>
			</div>
		</div>
</div>
