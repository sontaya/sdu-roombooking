						<!--begin::Entry-->
						<!--begin::Hero-->
						<div class="d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url('assets/media/bg/bg-9.jpg')">
							<div class="container">

								<div class="d-flex align-items-stretch text-center flex-column py-10">
									<!--begin::Heading-->
									<h3 class="display3 font-weight-bolder my-7 text-dark" style="color: #986923;">ระบบ Room Booking</h3>
									<!-- <h3 class="display5 font-weight-bolder my-7 text-dark" style="color: #986923;">สำหรับจองห้อง SDU Online Learning เพื่อใช้ในการสอนออนไลน์และการประชุมออนไลน์</h3> -->
									<!--end::Heading-->

								</div>
							</div>
						</div>
						<!--end::Hero-->
						<!--begin::Section-->
						<div class="container py-8">

							<div class="row">
									<div class="col-lg-6">
										<!--begin::Callout-->
										<div class="card card-custom p-6 mb-8 mb-lg-0">
											<div class="card-body">
												<div class="row">
													<!--begin::Content-->
													<div class="col-sm-8">
														<h2 class="text-dark mb-4">SDU Online Learning</h2>
														<h5 class="text-dark-50">สำหรับใช้ในการสอนออนไลน์และการประชุมออนไลน์</h5>
													</div>
													<!--end::Content-->
													<!--begin::Button-->
													<div class="col-sm-4 d-flex align-items-center justify-content-sm-end">
														<a href="<?php echo base_url('page/set_active_template/OL') ?>" class="btn font-weight-bolder text-uppercase font-size-lg btn-primary py-3 px-6">เริ่มจองห้อง</a>
													</div>
													<!--end::Button-->
												</div>

												<div class="separator separator-dashed mt-2 mb-2"></div>
												<div class="row row-paddingless mb-4 mt-5">
													<!--begin::Item-->
													<div class="col">
														<div class="d-flex align-items-center mr-2">
															<!--begin::Symbol-->
															<div class="symbol symbol-45 symbol-light-success mr-4 flex-shrink-0">
																<div class="symbol-label">
																	<span class="navi-icon"><i class="flaticon2-calendar-5 text-success icon-lg"></i></span>

																</div>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div>
																<div class="font-size-h4 text-success font-weight-bolder"><?php echo $ol_summary[0]->count_approved; ?> รายการ</div>
																<div class="font-size-sm text-muted font-weight-bold mt-1">Success</div>
															</div>
															<!--end::Title-->
														</div>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="col">
														<div class="d-flex align-items-center mr-2">
															<!--begin::Symbol-->
															<div class="symbol symbol-45 symbol-light-primary mr-4 flex-shrink-0">
																<div class="symbol-label">
																	<span class="navi-icon"><i class="flaticon2-hourglass-1 text-primary icon-lg"></i></span>
																</div>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div>
																<div class="font-size-h4 text-primary font-weight-bolder"><?php echo $ol_summary[0]->count_pending; ?> รายการ</div>
																<div class="font-size-sm text-muted font-weight-bold mt-1">Pending</div>
															</div>
															<!--end::Title-->
														</div>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="col">
														<div class="d-flex align-items-center mr-2">
															<!--begin::Symbol-->
															<div class="symbol symbol-45 symbol-light-warning mr-4 flex-shrink-0">
																<div class="symbol-label">
																	<span class="navi-icon"><i class="flaticon-cancel text-warning"></i></span>
																</div>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div>
																<div class="font-size-h4 text-warning font-weight-bolder"><?php echo $ol_summary[0]->count_rejected; ?> รายการ</div>
																<div class="font-size-sm text-muted font-weight-bold mt-1">Rejected</div>
															</div>
															<!--end::Title-->
														</div>
													</div>
													<!--end::Item-->
												</div>

											</div>
										</div>
										<!--end::Callout-->
									</div>
									<div class="col-lg-6">
										<!--begin::Callout-->
										<div class="card card-custom p-6">
											<div class="card-body">
												<div class="row">
													<!--begin::Content-->
													<div class="col-sm-8">
														<h2 class="text-dark mb-4">The Suan Dusit Place</h2>
														<h5 class="text-dark-50">ห้องประชุมสัมมนาและห้องจัดเลี้ยง </h5>
													</div>
													<!--end::Content-->
													<!--begin::Button-->
													<div class="col-sm-4 d-flex align-items-center justify-content-sm-end">
														<a href="<?php echo base_url('page/set_active_template/DP') ?>" class="btn font-weight-bolder text-uppercase font-size-lg btn-success py-3 px-6">เริ่มจองห้อง</a>
													</div>
													<!--end::Button-->
												</div>
												<div class="separator separator-dashed mt-2 mb-2"></div>

												<div class="row row-paddingless mb-4 mt-5">

													<div class="col">
														<div class="d-flex align-items-center mr-2">
															<div class="symbol symbol-45 symbol-light-success mr-4 flex-shrink-0">
																<div class="symbol-label">
																	<span class="navi-icon"><i class="flaticon2-calendar-5 text-success icon-lg"></i></span>
																</div>
															</div>
															<div>
																<div class="font-size-h4 text-success font-weight-bolder"><?php echo $dp_summary[0]->count_approved; ?> รายการ</div>
																<div class="font-size-sm text-muted font-weight-bold mt-1">Success</div>
															</div>
														</div>
													</div>
													<div class="col">
														<div class="d-flex align-items-center mr-2">
															<div class="symbol symbol-45 symbol-light-primary mr-4 flex-shrink-0">
																<div class="symbol-label">
																	<span class="navi-icon"><i class="flaticon2-hourglass-1 text-primary icon-lg"></i></span>
																</div>
															</div>

															<div>
																<div class="font-size-h4 text-primary font-weight-bolder"><?php echo $dp_summary[0]->count_pending; ?> รายการ</div>
																<div class="font-size-sm text-muted font-weight-bold mt-1">Pending</div>
															</div>
														</div>
													</div>
													<div class="col">
														<div class="d-flex align-items-center mr-2">
															<!--begin::Symbol-->
															<div class="symbol symbol-45 symbol-light-warning mr-4 flex-shrink-0">
																<div class="symbol-label">
																	<span class="navi-icon"><i class="flaticon-cancel text-warning"></i></span>
																</div>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div>
																<div class="font-size-h4 text-warning font-weight-bolder"><?php echo $dp_summary[0]->count_rejected; ?> รายการ</div>
																<div class="font-size-sm text-muted font-weight-bold mt-1">Rejected</div>
															</div>
															<!--end::Title-->
														</div>
													</div>
													<!--end::Item-->
												</div>
												<div class="row">
													<div class="col">
														<!-- <p class="text-danger text-center font-size-lg">--- เปิดการใช้งานเร็วๆนี้ ---</p> -->
													</div>
												</div>
											</div>
										</div>
										<!--end::Callout-->
									</div>
							</div>
							<div class="row mt-4">
									<div class="col-lg-6">
										<!--begin::Callout-->
										<div class="card card-custom p-6 mb-8 mb-lg-0">
											<div class="card-body">
												<div class="row">
													<!--begin::Content-->
													<div class="col-sm-8">
														<h2 class="text-dark mb-4">Hybrid Learning</h2>
														<h5 class="text-dark-50">สำหรับใช้ในการสอนออนไลน์ในรูปแบบ Hybrid</h5>
													</div>
													<!--end::Content-->
													<!--begin::Button-->
													<div class="col-sm-4 d-flex align-items-center justify-content-sm-end">
														<a href="<?php echo base_url('page/set_active_template/HB') ?>" class="btn font-weight-bolder text-uppercase font-size-lg btn-info py-3 px-6">เริ่มจองห้อง</a>
													</div>
													<!--end::Button-->
												</div>

												<div class="separator separator-dashed mt-2 mb-2"></div>
												<div class="row row-paddingless mb-4 mt-5">
													<!--begin::Item-->
													<div class="col">
														<div class="d-flex align-items-center mr-2">
															<!--begin::Symbol-->
															<div class="symbol symbol-45 symbol-light-success mr-4 flex-shrink-0">
																<div class="symbol-label">
																	<span class="navi-icon"><i class="flaticon2-calendar-5 text-success icon-lg"></i></span>

																</div>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div>
																<div class="font-size-h4 text-success font-weight-bolder"><?php echo $hb_summary[0]->count_approved; ?> รายการ</div>
																<div class="font-size-sm text-muted font-weight-bold mt-1">Success</div>
															</div>
															<!--end::Title-->
														</div>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="col">
														<div class="d-flex align-items-center mr-2">
															<!--begin::Symbol-->
															<div class="symbol symbol-45 symbol-light-primary mr-4 flex-shrink-0">
																<div class="symbol-label">
																	<span class="navi-icon"><i class="flaticon2-hourglass-1 text-primary icon-lg"></i></span>
																</div>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div>
																<div class="font-size-h4 text-primary font-weight-bolder"><?php echo $hb_summary[0]->count_pending; ?> รายการ</div>
																<div class="font-size-sm text-muted font-weight-bold mt-1">Pending</div>
															</div>
															<!--end::Title-->
														</div>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="col">
														<div class="d-flex align-items-center mr-2">
															<!--begin::Symbol-->
															<div class="symbol symbol-45 symbol-light-warning mr-4 flex-shrink-0">
																<div class="symbol-label">
																	<span class="navi-icon"><i class="flaticon-cancel text-warning"></i></span>
																</div>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div>
																<div class="font-size-h4 text-warning font-weight-bolder"><?php echo $hb_summary[0]->count_rejected; ?> รายการ</div>
																<div class="font-size-sm text-muted font-weight-bold mt-1">Rejected</div>
															</div>
															<!--end::Title-->
														</div>
													</div>
													<!--end::Item-->
												</div>

											</div>
										</div>
										<!--end::Callout-->
									</div>

							</div>

						</div>
						<!--end::Section-->

						<!--end::Entry-->
