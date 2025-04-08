						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Details-->
								<div class="d-flex align-items-center flex-wrap mr-2">
									<!--begin::Title-->
									<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Edit User</h5>
									<!--end::Title-->
									<!--begin::Separator-->
									<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
									<!--end::Separator-->
									<!--begin::Search Form-->
									<div class="d-flex align-items-center" id="kt_subheader_search">
										<span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?= $profile['user_id']  ?> - <?= $profile["name"] ?>&nbsp;<?= $profile["surname"] ?></span>
									</div>
									<!--end::Search Form-->
								</div>
								<!--end::Details-->
								<!--begin::Toolbar-->
								<div class="d-flex align-items-center">

									<!--begin::Dropdown-->
										<a href="<?php echo base_url('admin/user_revoke/').$profile["user_id"]; ?>" class="btn btn-block btn-sm btn-light-danger font-weight-bolder ">ลบสิทธิผู้ดูแลระบบ</a>
										<button type="button" id="user_save" class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base ml-2">บันทึก</button>

									<!--end::Dropdown-->
								</div>
								<!--end::Toolbar-->
							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Card-->
								<div class="card card-custom">
									<!--begin::Card header-->
									<div class="card-header card-header-tabs-line nav-tabs-line-3x">
										<!--begin::Toolbar-->
										<div class="card-toolbar">
											<ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
												<!--begin::Item-->
												<li class="nav-item mr-3">
													<a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1">
														<span class="nav-icon">
															<span class="svg-icon">
																<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24" />
																		<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																	</g>
																</svg>
																<!--end::Svg Icon-->
															</span>
														</span>
														<span class="nav-text font-size-lg">Profile</span>
													</a>
												</li>
												<!--end::Item-->

												<!--begin::Item-->
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_4">
														<span class="nav-icon">
															<i class="flaticon2-user-1"></i>
														</span>
														<span class="nav-text font-size-lg">กำหนดสิทธิรายห้อง</span>
													</a>
												</li>
												<!--end::Item-->
											</ul>
										</div>
										<!--end::Toolbar-->
									</div>
									<!--end::Card header-->
									<!--begin::Card body-->
									<div class="card-body px-0">
										<form class="form" id="FrmUser" action="<?php echo base_url('admin/user_edit_store'); ?>" method="post" accept-charset="utf-8">
											<input type="hidden" name="user_id" id="user_id" value="<?= $profile['user_id']  ?>">
											<?php
												$room_grants = json_decode($profile['control_room_grant'],true);
											?>
											<div class="tab-content">
												<!--begin::Tab-->
												<div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
													<!--begin::Row-->
													<div class="row">
														<div class="col-xl-2"></div>
														<div class="col-xl-7 my-2">

															<!--begin::Group-->
															<div class="form-group row">
																<label class="col-form-label col-3 text-lg-right text-left">ชื่อ</label>
																<div class="col-9">
																	<input class="form-control form-control-lg form-control-solid" type="text" name="name" value="<?= $profile['name'] ?>" />
																</div>
															</div>
															<!--end::Group-->
															<!--begin::Group-->
															<div class="form-group row">
																<label class="col-form-label col-3 text-lg-right text-left">นามสกุล</label>
																<div class="col-9">
																	<input class="form-control form-control-lg form-control-solid" type="text" name="surname" value="<?= $profile['surname'] ?>" />
																</div>
															</div>
															<!--end::Group-->
															<!--begin::Group-->
															<div class="form-group row">
																<label class="col-form-label col-3 text-lg-right text-left">หน่วยงาน</label>
																<div class="col-9">
																	<input class="form-control form-control-lg form-control-solid" type="text" value="<?= $profile['name_faculty'] ?>" />
																</div>
															</div>
															<!--end::Group-->
															<!--begin::Group-->
															<div class="form-group row">
																<label class="col-form-label col-3 text-lg-right text-left">เบอร์โทรศัพท์มือถือ</label>
																<div class="col-9">
																	<div class="input-group input-group-lg input-group-solid">
																		<div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-mobile"></i>
																			</span>
																		</div>
																		<input type="text" class="form-control form-control-lg form-control-solid" name="mobile_phone_default" value="<?= $profile['mobile_phone_default'] ?>" placeholder="" />
																	</div>
																</div>
															</div>
															<!--end::Group-->
															<!--begin::Group-->
															<div class="form-group row">
																<label class="col-form-label col-3 text-lg-right text-left">เบอร์โทรศัพท์ภายใน</label>
																<div class="col-9">
																	<div class="input-group input-group-lg input-group-solid">
																		<div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-phone"></i>
																			</span>
																		</div>
																		<input type="text" class="form-control form-control-lg form-control-solid" name="internal_phone_default" value="<?= $profile['internal_phone_default'] ?>" placeholder="" />
																	</div>
																</div>
															</div>
															<!--end::Group-->
															<!--begin::Group-->
															<div class="form-group row">
																<label class="col-form-label col-3 text-lg-right text-left">อีเมล</label>
																<div class="col-9">
																	<div class="input-group input-group-lg input-group-solid">
																		<div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-at"></i>
																			</span>
																		</div>
																		<input type="text" class="form-control form-control-lg form-control-solid" name="email_default" value="<?= $profile['email_default'] ?>" placeholder="Email" />
																	</div>
																</div>
															</div>
															<!--end::Group-->

														</div>
													</div>
													<!--end::Row-->
												</div>
												<!--end::Tab-->

												<!--begin::Tab-->
												<div class="tab-pane px-7" id="kt_user_edit_tab_4" role="tabpanel">
													<div class="row">
														<div class="col-xl-12">

															<div class="alert alert-custom alert-notice alert-light-primary fade show" role="alert">
																<div class="alert-icon"><i class="flaticon-technology-2 icon-xl"></i></div>
																<div class="alert-text">SDU Online Learning</div>
															</div>

														</div>
													</div>
													<div class="separator separator-dashed mb-10"></div>
													<div class="form-group row">


														<?php
															foreach ($room_online_info as $ol) {
                                                                if ($room_grants != "") {
                                                                    if (in_array($ol["id"], $room_grants)) {
                                                                        $room_checked = "checked='checked'";
                                                                    } else {
                                                                        $room_checked = "";
                                                                    }
                                                                }
														?>
															<div class="col-md-4 col-xs-12">
																<div class="checkbox-single mb-2">
																	<label class="checkbox">
																		<input type="checkbox" name="room_online[]" value="<?= $ol["id"] ?>" <?= $room_checked ?> /><?= $ol["name"] ?>
																	<span></span></label>
																</div>
															</div>
														<?php
															}
														?>
													</div>
													<div class="separator separator-dashed mb-10"></div>
													<div class="row">
														<div class="col-xl-12">

															<div class="alert alert-custom alert-notice alert-light-info fade show" role="alert">
																<div class="alert-icon"><i class="flaticon-technology-2 icon-xl"></i></div>
																<div class="alert-text">Hybrid Learning</div>
															</div>

														</div>
													</div>
													<div class="form-group row">


														<?php
															foreach ($room_hybrid_info as $hb) {
                                                                if ($room_grants != "") {
                                                                    if (in_array($hb["id"], $room_grants)) {
                                                                        $room_checked = "checked='checked'";
                                                                    } else {
                                                                        $room_checked = "";
                                                                    }
                                                                }
														?>
															<div class="col-md-4 col-xs-12">
																<div class="checkbox-single mb-2">
																	<label class="checkbox checkbox-info">
																		<input type="checkbox" name="room_hybrid[]" value="<?= $hb["id"] ?>" <?= $room_checked ?> /><?= $hb["shortname"] ?>
																	<span></span></label>
																</div>
															</div>
														<?php
															}
														?>
													</div>
													<div class="separator separator-dashed mb-10"></div>
													<div class="row">
														<div class="col-xl-12">

															<div class="alert alert-custom alert-notice alert-teal-info fade show" role="alert">
																<div class="alert-icon"><i class="flaticon-technology-2 icon-xl"></i></div>
																<div class="alert-text">Meeting</div>
															</div>

														</div>
													</div>
													<div class="form-group row">


														<?php
															foreach ($room_meeting_info as $mt) {
                                                                if ($room_grants != "") {
                                                                    if (in_array($mt["id"], $room_grants)) {
                                                                        $room_checked = "checked='checked'";
                                                                    } else {
                                                                        $room_checked = "";
                                                                    }
                                                                }
														?>
															<div class="col-md-4 col-xs-12">
																<div class="checkbox-single mb-2">
																	<label class="checkbox checkbox-info">
																		<input type="checkbox" name="room_hybrid[]" value="<?= $mt["id"] ?>" <?= $room_checked ?> /><?= $mt["shortname"] ?>
																	<span></span></label>
																</div>
															</div>
														<?php
															}
														?>
													</div>
												</div>
												<!--end::Tab-->
											</div>
										</form>
									</div>
									<!--begin::Card body-->
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
