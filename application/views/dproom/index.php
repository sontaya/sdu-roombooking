		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
			<div class="container">
				<!--begin::Row-->
				<div class="row">
					<?php
						$room_info = get_dproom_all();
						foreach ($room_info as $r1) {
					?>

							<!--begin::Col-->
							<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
								<!--begin::Card-->
								<div class="card card-custom gutter-b card-stretch">
									<!--begin::Body-->
									<div class="card-body pt-4">
										<!--begin::User-->
										<div class="d-flex align-items-center mb-7">
											<!--begin::Pic-->
											<div class="flex-shrink-0 mr-4">
												<div class="symbol symbol-circle symbol-lg-75">
													<div class="symbol-label">
														<span class="flaticon-technology-2 icon-xl"></span>
													</div>

												</div>
											</div>
											<!--end::Pic-->
											<!--begin::Title-->
											<div class="d-flex flex-column">
												<a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0"><?= $r1["name"] ?></a>
												<span class="text-muted font-weight-bold"><?= $r1["place"] ?></span>
											</div>
											<!--end::Title-->
										</div>
										<!--end::User-->
										<!--begin::Desc-->
										<p class="mb-7">
											<img src="<?php echo base_url('assets/images/room_cover/').$r1["cover_image"]; ?>" alt="<?= $r1["name"] ?>" class="img-fluid" >
										</p>

										<!--end::Desc-->
										<!--begin::Info-->
										<div class="mb-7">
											<div class="d-flex justify-content-between align-items-center">
												<span class="text-dark-75 font-weight-bolder mr-2">ประเภทห้อง:</span>
												<a href="#" class="text-muted text-hover-primary"><?= $r1["room_desc"] ?></a>
											</div>
											<div class="d-flex justify-content-between align-items-center">
												<span class="text-dark-75 font-weight-bolder mr-2">ความจุห้อง:</span>
												<a href="#" class="text-muted text-hover-primary"><?= $r1["capacity"] ?></a>
											</div>


										</div>
										<!--end::Info-->
									</div>
									<!--end::Body-->
								</div>
								<!--end:: Card-->
							</div>
							<!--end::Col-->

					<?php
						}
					?>
				</div>
				<!--end::Row-->




			</div>
			<!--end::Container-->
		</div>
		<!--end::Entry-->
