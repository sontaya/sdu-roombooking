		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
			<div class="container">
				<!--begin::Row-->
				<div class="row">
					<?php
						$room_info1 = get_room_bytype('1');
						foreach ($room_info1 as $r1) {
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
											<div class="d-flex justify-content-between align-items-cente my-1">
												<span class="text-dark-75 font-weight-bolder mr-2">เจ้าหน้าที่ประจำห้อง:</span>

													<?php
														echo $r1["room_staff"];
													?>

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

				<!--begin::Row-->
				<div class="row">
					<?php
						$room_info2 = get_room_bytype('2');
						foreach ($room_info2 as $r2) {

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
												<a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0"><?= $r2["name"] ?></a>
												<span class="text-muted font-weight-bold"><?= $r2["place"] ?></span>
											</div>
											<!--end::Title-->
										</div>
										<!--end::User-->
										<!--begin::Desc-->
										<p class="mb-7">
											<img src="<?php echo base_url('assets/images/room_cover/').$r2["cover_image"]; ?>" alt="<?= $r2["name"] ?>" class="img-fluid" >
										</p>
										<!--end::Desc-->
										<!--begin::Info-->
										<div class="mb-7">
											<div class="d-flex justify-content-between align-items-center">
												<span class="text-dark-75 font-weight-bolder mr-2">ประเภทห้อง:</span>
												<a href="#" class="text-muted text-hover-primary"><?= $r2["room_desc"] ?></a>
											</div>
											<div class="d-flex justify-content-between align-items-center">
												<span class="text-dark-75 font-weight-bolder mr-2">ความจุห้อง:</span>
												<a href="#" class="text-muted text-hover-primary"><?= $r2["capacity"] ?></a>
											</div>
											<div class="d-flex justify-content-between align-items-center">
												<span class="text-dark-75 font-weight-bolder mr-2">HUB500 Account:</span>
												<a href="#" class="text-muted text-hover-primary"><?= $r2["hub500_account"] ?></a>
											</div>
											<div class="d-flex justify-content-between align-items-cente my-1">
												<span class="text-dark-75 font-weight-bolder mr-2">เจ้าหน้าที่ประจำห้อง:</span>
												<!-- <a href="#" class="text-muted text-hover-primary"></a> -->
												<?php
													echo $r2["room_staff"];
												?>
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
