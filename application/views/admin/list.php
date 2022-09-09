		<!--begin::Content-->
		<div class="content d-flex flex-column flex-column-fluid" id="list_content">
			<!--begin::Entry-->

			<!--begin::Search-->
			<div class="card card-custom">
				<div class="card-header flex-wrap border-0 pt-6 pb-0">
					<div class="card-title">
						<h3 class="card-label">รายการข้อมูลผู้ดูแลระบบ (Delegate Admin)</h3>
					</div>
				</div>
				<div class="card-body">

					<!--begin::Form-->
					<form class="form" id="FormDelegateAdmin" action="<?php echo base_url('admin/list'); ?>" method="post" accept-charset="utf-8" novalidate="novalidate">
							<input type="hidden" name="do_search" id="do_search" value="1">
							<div class="form-group row">
									<div class="col-lg-8">
										<label>ค้นหารายชื่อ:</label>
										<input type="text" class="form-control" placeholder="" id="search_key" name="search_key" value="<?= $criteria['search_key'] ?>" />
									</div>

									<div class="col-lg-4">

										<a href="javascript:;"  class="btn btn-light-success font-weight-bold mt-8 search-admin">
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


										<a href="javascript:;"  class="btn btn-light-warning font-weight-bold mt-8 search-profile">
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
											<span class="navi-text font-size-lg">เพิ่มผู้ดูแลระบบ</span>
										</a>
									</div>

							</div>

					</form>
					<!--end::Form-->

				</div>
			</div>
			<!--end::Card-->

		</div>

		<div class="content d-flex flex-column flex-column-fluid" id="list_content">

			<?php if($admin_lists != false){ ?>

				<!--begin::Row-->
				<div class="row">
					<?php
						foreach ($admin_lists as $admin) {
							?>

						<!--begin::Col-->
						<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
							<!--begin::Card-->
							<div class="card card-custom gutter-b card-stretch">
								<!--begin::Body-->
								<div class="card-body pt-4">

									<!--begin::User-->
									<div class="d-flex align-items-center mb-7">
										<!--begin::Pic-->
										<div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">

											<div class="symbol symbol-lg-75 symbol-circle symbol-primary">
												<span class="symbol-label font-size-h3 font-weight-boldest">
													<?php
														$explode_uid_admin = explode("_", $admin['uid']);
							$short_uid_admin = substr($explode_uid_admin[0], 0, 1).substr($explode_uid_admin[1], 0, 1);
							echo strtoupper($short_uid_admin); ?>

												</span>
											</div>
										</div>
										<!--end::Pic-->
										<!--begin::Title-->
										<div class="d-flex flex-column">
											<a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">
												<?= $admin["name"]?>&nbsp;<?= $admin["surname"]?>
											</a>
											<span class="text-muted font-weight-bold"><?= $admin["user_id"]?></span>
										</div>
										<!--end::Title-->
									</div>
									<!--end::User-->
									<!--begin::Desc-->
									<?php
										$rooms = get_room_grant($admin["user_id"]);
							if ($rooms != false) {
								foreach ($rooms as $rg) {
									if ($rg["room_group"] == "OL") {
										$room_label_class = "btn-light-success";
									}
									if ($rg["room_group"] == "HB") {
										$room_label_class = "btn-light-info";
									} ?>

											<a href="#" class="btn btn-sm btn-icon <?= $room_label_class ?> mr-2 mb-2" >
												<?= $rg["room_tag"] ?>
											</a>
									<?php
								}
							} ?>
									<!--end::Desc-->
									<!--begin::Info-->
									<div class="mb-4 mt-2">
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-dark-75 font-weight-bolder mr-2">Email:</span>
											<a href="#" class="text-muted text-hover-primary"><?= $admin["email_default"]?></a>
										</div>
										<div class="d-flex justify-content-between align-items-cente my-2">
											<span class="text-dark-75 font-weight-bolder mr-2">Phone:</span>
											<a href="#" class="text-muted text-hover-primary"><?= $admin["mobile_phone_default"]?></a>
										</div>
										<div class="d-flex justify-content-between align-items-cente my-2">
											<span class="text-dark-75 font-weight-bolder mr-2">หน่วยงาน:</span>
											<a href="#" class="text-muted text-hover-primary"><?= $admin["name_faculty"]?></a>
										</div>

									</div>

									<!--end::Info-->

									<div class="d-flex">
											<a href="<?php echo base_url('admin/user_edit/').$admin["user_id"]; ?>" class="btn btn-block btn-sm btn-light-primary font-weight-bolder ">จัดการสิทธิ</a>

									</div>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Card-->
						</div>
						<!--end::Col-->

					<?php
						}
					?>

				</div>
				<!--end::Row-->

			<?php }else{  ?>
				<div class="alert alert-danger text-center">ไม่พบข้อมูล</div>

			<?php } ?>
		</div>





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
