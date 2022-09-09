						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Details-->
								<div class="d-flex align-items-center flex-wrap mr-2">
									<!--begin::Title-->
									<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">จัดการห้อง</h5>
									<!--end::Title-->
									<!--begin::Separator-->
									<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
									<!--end::Separator-->
									<!--begin::Search Form-->
									<div class="d-flex align-items-center" id="kt_subheader_search">
										<span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?= $room["name"] ?></span>
									</div>
									<!--end::Search Form-->
								</div>
								<!--end::Details-->
								<!--begin::Toolbar-->
								<div class="d-flex align-items-center">

									<!--begin::Dropdown-->

										<button type="button" id="room_save" class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base ml-2">บันทึก</button>

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
													<a class="nav-link active" data-toggle="tab" href="#kt_room_edit_tab1">
														<span class="nav-icon">
														<i class="flaticon-technology-2"></i>
														</span>
														<span class="nav-text font-size-lg">ข้อมูลห้อง</span>
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
										<form class="form" id="FrmRoom" action="<?php echo base_url('admin/room_edit_store'); ?>" method="post" accept-charset="utf-8">
											<input type="hidden" name="room_id" id="room_id" value="<?= $room['id']  ?>">
											<input type="hidden" name="room_app" id="room_app" value="<?= $room_app  ?>">
											<div class="tab-content">
												<!--begin::Tab-->
												<div class="tab-pane show active px-7" id="kt_room_edit_tab1" role="tabpanel">
													<!--begin::Row-->
													<div class="row">
														<div class="col-xl-2"></div>
														<div class="col-xl-7 my-2">

															<!--begin::Group-->
															<div class="form-group row">
																<label class="col-form-label col-3 text-lg-right text-left">ประเภทห้อง</label>
																<div class="col-9">
																	<input class="form-control form-control-lg form-control-solid" type="text" name="room_desc" value="<?= $room['room_desc'] ?>" />
																</div>
															</div>
															<!--end::Group-->
															<!--begin::Group-->
															<div class="form-group row">
																<label class="col-form-label col-3 text-lg-right text-left">ความจุห้อง</label>
																<div class="col-9">
																	<input class="form-control form-control-lg form-control-solid" type="text" name="capacity" value="<?= $room['capacity'] ?>" />
																</div>
															</div>
															<!--end::Group-->
															<!--begin::Group-->
															<div class="form-group row">
																<label class="col-form-label col-3 text-lg-right text-left">เจ้าหน้าที่ประจำห้อง</label>
																<div class="col-9">
																	<input class="form-control form-control-lg form-control-solid" type="text" name="room_staff" value="<?= $room['room_staff'] ?>" />
																</div>
															</div>
															<!--end::Group-->
															<!--begin::Group-->
															<div class="form-group row">
																<label class="col-form-label col-3 text-lg-right text-left">สถานะ</label>
																<div class="col-9">
																	<input data-switch="true" type="checkbox" <?php if($room['active'] == "Y"){echo "checked='checked'";} ?>
																		data-on-color="success"
																		data-off-color="warning"
																		name="room_active" id="room_active" value="Y" />

																</div>
															</div>
															<!--end::Group-->
															<!--begin::Group-->
															<div class="form-group row" id="active-desc-box" style="display: none;">
																<label class="col-form-label col-3 text-lg-right text-left">ข้อความแจ้งเตือน</label>
																<div class="col-9">
																	<input class="form-control form-control-lg form-control-solid" type="text" name="active_desc" value="<?= $room['active_desc'] ?>" />
																</div>
															</div>
															<!--end::Group-->

														</div>
													</div>
													<!--end::Row-->
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

<div class="modal fade" id="UserSearchModal" tabindex="-1" role="dialog" aria-labelledby="UserSearchModal" aria-hidden="true">
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
