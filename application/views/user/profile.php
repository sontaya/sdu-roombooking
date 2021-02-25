		<!--begin::Content-->
			<div class="content d-flex flex-column flex-column-fluid" id="kt_booking_form">
				<!--begin::Entry-->

						<!--begin::Card-->
						<div class="card card-custom gutter-b ">
							<div class="card-header">
								<h3 class="card-title">ข้อมูลส่วนบุคคล</h3>

							</div>
							<!--begin::Form-->
							<?php


									$val_user_id = $profile["user_id"];
									$val_profile_fullname = $profile["name"]." ".$profile["surname"];
									$val_profile_faculty = $profile["name_faculty"];
									$val_email_default = $profile["email_default"];
									$val_mobile_phone_default = $profile["mobile_phone_default"];
									$val_internal_phone_default = $profile["internal_phone_default"];


							?>
							<form class="form" id="FormProfile" accept-charset="utf-8">
								<div class="card-body">

									<div class="form-group row">
											<div class="col-lg-6">
												<label>ชื่อผู้จอง:</label>
												<input type="text" class="form-control" placeholder="" id="booking_name" name="booking_name" value="<?= $val_profile_fullname ?>" disabled="disabled" />
												<input type="hidden" name="user_id" id="user_id" value="<?= $val_user_id ?>">
											</div>
											<div class="col-lg-6">
												<label>หน่วยงาน:</label>
												<input type="text" class="form-control" placeholder="" id="booking_faculty" name="booking_faculty" value="<?= $val_profile_faculty ?>" disabled="disabled" />
											</div>

									</div>

									<div class="form-group row">
											<div class="col-lg-6">
											<label>อีเมลสำหรับติดต่อ:</label>
												<input type="email" class="form-control" placeholder="" id="email_default" name="email_default" value="<?= $val_email_default; ?>" />
											</div>
											<div class="col-lg-3">
												<label>เบอร์โทรศัพท์มือถือ: <span id="mobile_phone_default_Error" ></span></label>
												<input type="text" class="form-control" placeholder="" id="mobile_phone_default" name="mobile_phone_default"
													value="<?= $val_mobile_phone_default; ?>" data-error="#mobile_phone_default_Error" />
											</div>
											<div class="col-lg-3">
												<label>เบอร์โทรศัพท์ภายใน: <span id="internal_phone_Error" ></span></label>
												<input type="text" class="form-control" placeholder="" id="internal_phone_default" name="internal_phone_default"
													value="<?= $val_internal_phone_default; ?>" data-error="#internal_phone_Error" />
											</div>
									</div>


								</div>
								<div class="card-footer">
									<div class="row">
										<div class="col-lg-6">
											<button type="button" id="submit_button" class="btn btn-primary mr-2">บันทึก</button>
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
