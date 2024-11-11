		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
			<div class="container">
				<!--begin::Row-->
				<div class="row">
					<?php
						// $room_info1 = get_mtroom_all();
						foreach ($rooms as $r1) {
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

							$gallery_target = "gallery-".$r1["id"];
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
										<!--begin::Desc-->
										<p class="mb-7">
											<a href="<?= base_url('assets/images/room_cover/'.$r1["cover_image"]); ?>"  data-toggle="lightbox" data-gallery="<?= $gallery_target ?>">
												<img src="<?php echo base_url('assets/images/room_cover/').$r1["cover_image"]; ?>" alt="<?= $r1["name"] ?>" class="img-fluid">
											</a>
										</p>
										<!--end::Desc-->

										<div class="row">
											<?php
													$thumbs = json_decode($r1["room_thumbs"]);
												foreach ($thumbs as $thumb){
											?>
												<a href="<?php echo base_url('assets/images/room_gallery/').$thumb; ?>" data-toggle="lightbox" data-gallery="<?= $gallery_target ?>" class="col-md-3" style="padding-left: 3px; padding-right: 3px;">
													<img src="<?= base_url('assets/images/room_gallery/').$thumb; ?>" class="img-fluid rounded">
												</a>
											<?php
												}
											?>
										</div>

										<!--begin::Info-->
										<div class="mb-7 mt-2">
											<div class="d-flex justify-content-between align-items-center">
												<span class="text-dark-75 font-weight-bolder mr-2">ประเภทห้อง:</span>
												<a href="#" class="text-muted text-hover-primary"><?= $r1["room_desc"] ?></a>
											</div>
											<div class="d-flex justify-content-between align-items-center">
												<span class="text-dark-75 font-weight-bolder mr-2">ความจุห้อง:</span>
												<a href="#" class="text-muted text-hover-primary"><?= $r1["capacity"] ?></a>
											</div>

											<?php if($r1["active"]!="Y"){ ?>
												<div class="d-flex justify-content-center align-items-center ">
													<span class="font-weight-bolder" style="color: <?= $style_color1 ?>;" ><?= $r1["active_desc"] ?></span>
												</div>
											<?php } ?>

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
