						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Details-->
								<div class="d-flex align-items-center flex-wrap mr-2">
									<!--begin::Title-->
									<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">จัดการห้อง</h5>
									<!--end::Title-->

								</div>
								<!--end::Details-->

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
													<a class="nav-link active" data-toggle="tab" href="#tab-target-ol">
														<span class="nav-icon">
															<i class="flaticon-technology-2"></i>
														</span>
														<span class="nav-text font-size-lg">SDU Online Learning</span>
													</a>
												</li>
												<!--end::Item-->

												<!--begin::Item-->
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab-target-hb">
														<span class="nav-icon">
															<i class="flaticon-technology-2"></i>
														</span>
														<span class="nav-text font-size-lg">Hybrid Learning</span>
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
											<div class="tab-content">
												<!--begin::Tab-->
												<div class="tab-pane show active px-7" id="tab-target-ol" role="tabpanel">


													<div class="d-flex flex-column-fluid">
														<!--begin::Container-->
														<div class="container">
															<!--begin::Row-->
															<div class="row">
																<?php
																	$room_info1 = get_room_bytype('1');
																	foreach ($room_info1 as $r1) {
																		if($r1["active"]=="Y"){
																			$style_icon1 = "flaticon-technology-2";
																			$style_color1= "#1BC5BD";
																		}elseif($r1["active"]=="C"){
																			$style_icon1 = "flaticon-close";
																			$style_color1= "#FFA800";
																		}else{
																			$style_icon1 = "flaticon-technology-2";
																			$style_color1= "#1BC5BD";
																		}
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
																								<div class="symbol-label" style="background-color: <?= $style_color1 ?>;">
																									<span class="<?= $style_icon1 ?> icon-xl"></span>
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

																					<!--begin::Info-->
																					<div class="mb-7">
																						<div class="d-flex justify-content-between align-items-center">
																							<span class="text-dark-75 font-weight-bolder mr-2">ประเภทห้อง:</span>
																							<span class="text-muted"><?= $r1["room_desc"] ?></span>
																						</div>
																						<div class="d-flex justify-content-between align-items-center">
																							<span class="text-dark-75 font-weight-bolder mr-2">ความจุห้อง:</span>
																							<span class="text-muted"><?= $r1["capacity"] ?></span>
																						</div>
																						<div class="d-flex justify-content-between align-items-center my-1">
																							<span class="text-dark-75 font-weight-bolder mr-2">เจ้าหน้าที่ประจำห้อง:</span>
																							<span  class="text-muted"><?= $r1["room_staff"] ?></span>
																						</div>
																						<?php if($r1["active"]!="Y"){ ?>
																							<div class="d-flex justify-content-center align-items-center ">
																								<span class="font-weight-bolder" style="color: <?= $style_color1 ?>;" ><?= $r1["active_desc"] ?></span>
																							</div>
																						<?php } ?>

																					</div>
																					<!--end::Info-->
																					<div class="d-flex">
																						<a href="<?php echo base_url('admin/room_edit/').$r1["id"]; ?>" class="btn btn-block btn-sm btn-light-primary font-weight-bolder ">จัดการห้อง</a>
																					</div>
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
																		if($r2["active"]=="Y"){
																			$style_icon2 = "flaticon-technology-2";
																			$style_color2= "#1BC5BD";
																		}elseif($r2["active"]=="C"){
																			$style_icon2 = "flaticon-close";
																			$style_color2= "#FFA800";
																		}else{
																			$style_icon2 = "flaticon-technology-2";
																			$style_color2= "#1BC5BD";
																		}

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
																								<div class="symbol-label" style="background-color: <?= $style_color2 ?>;">
																									<span class="<?= $style_icon2 ?> icon-xl"></span>
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

																					<!--begin::Info-->
																					<div class="mb-7">
																						<div class="d-flex justify-content-between align-items-center">
																							<span class="text-dark-75 font-weight-bolder mr-2">ประเภทห้อง:</span>
																							<span class="text-muted"><?= $r2["room_desc"] ?></span>
																						</div>
																						<div class="d-flex justify-content-between align-items-center">
																							<span class="text-dark-75 font-weight-bolder mr-2">ความจุห้อง:</span>
																							<span class="text-muted"><?= $r2["capacity"] ?></span>
																						</div>
																						<div class="d-flex justify-content-between align-items-center my-1">
																							<span class="text-dark-75 font-weight-bolder mr-2">HUB500 Account:</span>
																							<span  class="text-muted"><?= $r2["hub500_account"] ?></span>
																						</div>
																						<div class="d-flex justify-content-between align-items-center my-1">
																							<span class="text-dark-75 font-weight-bolder mr-2">เจ้าหน้าที่ประจำห้อง:</span>
																							<span  class="text-muted"><?= $r2["room_staff"] ?></span>
																						</div>


																						<?php if($r2["active"]!="Y"){ ?>
																							<div class="d-flex justify-content-center align-items-center ">
																								<span class="font-weight-bolder" style="color: <?= $style_color2 ?>;" ><?= $r2["active_desc"] ?></span>
																							</div>
																						<?php } ?>

																					</div>
																					<!--end::Info-->
																					<div class="d-flex">
																						<a href="<?php echo base_url('admin/room_edit/').$r2["id"]; ?>" class="btn btn-block btn-sm btn-light-primary font-weight-bolder ">จัดการห้อง</a>
																					</div>
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


												</div>
												<!--end::Tab-->

												<!--begin::Tab-->
												<div class="tab-pane px-7" id="tab-target-hb" role="tabpanel">

												<div class="d-flex flex-column-fluid">
														<!--begin::Container-->
														<div class="container">
															<!--begin::Row-->
															<div class="row">
																<?php
																	$room_hb = get_hbroom_all();
																	foreach ($room_hb as $hb) {
																		if($hb["active"]=="Y"){
																			$style_icon_hb = "flaticon-technology-2";
																			$style_color_hb= "#8743f473";
																		}elseif($hb["active"]=="C"){
																			$style_icon_hb = "flaticon-close";
																			$style_color_hb= "#FFA800";
																		}else{
																			$style_icon_hb = "flaticon-technology-2";
																			$style_color_hb= "#8743f473";
																		}
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
																								<div class="symbol-label" style="background-color: <?= $style_color_hb ?>;">
																									<span class="<?= $style_icon_hb ?> icon-xl"></span>
																								</div>

																							</div>
																						</div>
																						<!--end::Pic-->
																						<!--begin::Title-->
																						<div class="d-flex flex-column">
																							<a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0"><?= $hb["name"] ?></a>
																							<span class="text-muted font-weight-bold"><?= $hb["place"] ?></span>
																						</div>
																						<!--end::Title-->
																					</div>
																					<!--end::User-->

																					<!--begin::Info-->
																					<div class="mb-7">
																						<div class="d-flex justify-content-between align-items-center">
																							<span class="text-dark-75 font-weight-bolder mr-2">ประเภทห้อง:</span>
																							<span class="text-muted"><?= $hb["room_desc"] ?></span>
																						</div>
																						<div class="d-flex justify-content-between align-items-center">
																							<span class="text-dark-75 font-weight-bolder mr-2">ความจุห้อง:</span>
																							<span class="text-muted"><?= $hb["capacity"] ?></span>
																						</div>
																						<div class="d-flex justify-content-between align-items-center my-1">
																							<span class="text-dark-75 font-weight-bolder mr-2">เจ้าหน้าที่ประจำห้อง:</span>
																							<span  class="text-muted"><?= $hb["room_staff"] ?></span>
																						</div>
																						<?php if($hb["active"]!="Y"){ ?>
																							<div class="d-flex justify-content-center align-items-center ">
																								<span class="font-weight-bolder" style="color: <?= $style_color1 ?>;" ><?= $hb["active_desc"] ?></span>
																							</div>
																						<?php } ?>

																					</div>
																					<!--end::Info-->
																					<div class="d-flex">
																						<a href="<?php echo base_url('admin/room_edit/').$hb["id"]; ?>" class="btn btn-block btn-sm btn-light-primary font-weight-bolder ">จัดการห้อง</a>
																					</div>
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

												</div>
												<!--end::Tab-->
											</div>

									</div>
									<!--begin::Card body-->
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->


