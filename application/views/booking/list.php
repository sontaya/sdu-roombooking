

		<!--begin::Content-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--begin::Entry-->

			<!--begin::Search-->
			<div class="card card-custom">
				<div class="card-header flex-wrap border-0 pt-6 pb-0">
					<div class="card-title">
						<h3 class="card-label">จัดการรายการจองห้อง</h3>
					</div>
				</div>
				<div class="card-body">

					<!--begin::Search Form-->
					<div class="mb-7">
						<form id="FormSearch" class="form" role="form" method="post">
							<div class="form-group row">
								<div class="col-lg-12 col-xl-12">
									<div class="row align-items-center">

										<div class="col-lg-4 col-md-9 col-sm-12">

												<label for="">เลือกห้อง</label>
												<select class="form-control" id="bm_search_room" name="bm_search_room">
													<option value="">ห้องทั้งหมด</option>
													<?php
														// $room_info = get_room_all();
														foreach ($room_info as $r) {
													?>
															<option value="<?= $r['id'] ?>" <?php if($criterias["room_id"] == $r["id"]){ echo "selected"; } ?>>
																<?= $r['name'] ?>
															</option>
													<?php } ?>
												</select>

										</div>
										<div class="col-lg-2 col-md-6 col-sm-12">

												<label for="">เลือกสถานะการจอง</label>
												<select class="form-control" id="bm_search_status" name="bm_search_status">
													<option value="" <?php if($criterias["booking_status"] == ""){ echo "selected"; } ?>>ทั้งหมด</option>
													<option value="pending" <?php if($criterias["booking_status"] == "pending"){ echo "selected"; } ?>>ขออนุมัติ</option>
													<option value="approved" <?php if($criterias["booking_status"] == "approved"){ echo "selected"; } ?>>อนุมัติ</option>
													<option value="rejected" <?php if($criterias["booking_status"] == "rejected"){ echo "selected"; } ?>>ไม่อนุมัติ</option>
												</select>

										</div>

										<div class="col-lg-4 col-md-9 col-sm-12">
											<label for="">ระบุช่วงวันที่</label>
											<div class="input-daterange input-group" id="bm_search_date">
												<input type="text" class="form-control"
													name="start" id="bm_searh_date_start"
													value="<?php if(isset($criterias)){echo $criterias["booking_date_start"];} ?>" />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-ellipsis-h"></i>
													</span>
												</div>
												<input type="text" class="form-control"
													name="end" id="bm_search_date_end"
													value="<?php if(isset($criterias)){echo $criterias["booking_date_end"];} ?>" />
											</div>
										</div>

									</div>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0 mt-4 ">
									<input type="hidden" name="md_search" id="md_search" value="1">
									<button type="submit" id="bm_search_button" class="btn btn-primary mr-2">Search</button>
								</div>
							</div>

						</form>

					</div>
					<!--end::Search Form-->

				</div>
			</div>
			<!--end::Card-->


				<!--begin::Card-->
				<div class="card card-custom">
					<div class="card-header">
						<h3 class="card-title">รายการข้อมูลการจองห้อง</h3>

					</div>
					<div class="card-body">
						<?php if($booking_lists != false){ ?>

							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">ชื่อห้อง</th>
											<th scope="col">ลักษณะการใช้งาน</th>
											<th scope="col">วันที่เริ่มต้น</th>
											<th scope="col">วันที่สิ้นสุด</th>
											<th scope="col">ACTIONS</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 0;
											foreach ($booking_lists as $booking) {
												$i++;
										?>
											<tr>
												<th scope="row">
													<div class="symbol symbol-40 symbol-light-success flex-shrink-0">
															<span class="symbol-label font-size-h5 font-weight-bold"><?= $booking["room_tag"] ?></span>
													</div>

												</th>
												<td class="align-middle"><?= $booking["room_name"] ?></td>
												<td class="align-middle"><?= $booking["usage_category_desc"] ?></td>
												<td class="align-middle"><?= get_thai_datetime($booking["booking_date_start"],1,true); ?></td>
												<td class="align-middle"><?= get_thai_datetime($booking["booking_date_end"],1,true); ?></td>
												<td class="text-right">
													<?php

														switch ($booking['booking_status']) {
															case 'pending':
																$label_class = "label-light-warning";
																break;
															case 'approved':
																$label_class = "label-light-success";
																break;
															case 'rejected':
																$label_class = "label-light-danger";
																break;

														}
													?>
													<span class="label label-inline <?php echo $label_class; ?> font-weight-bold">
														<?= $booking["booking_status"] ?>
													</span>

													<div class="dropdown dropdown-inline">
														<a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">
															<span class="flaticon2-gear"></span>
														</a>
														<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
															<ul class="navi flex-column navi-hover py-2">
																<li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2"> Choose an action:
																</li>
																<li class="navi-item">
																<a href="javascript:;" onclick="booking_view('<?php echo $booking['id']; ?>');return false;" data-id="<?php echo $booking['id'] ?>" class="navi-link booking-view">
																		<span class="navi-icon"><i class="flaticon-eye"></i></span>
																		<span class="navi-text">View</span>
																	</a>
																</li>

																<?php
																	if($booking['booking_status'] != 'approved'){
																?>
																	<li class="navi-item">
																		<a href="<?php echo base_url('booking/form/').$booking["id"]; ?>" data-id="<?= $booking["id"] ?>" class="navi-link booking-edit">
																			<span class="navi-icon"><i class="la la-edit text-primary"></i></span>
																			<span class="navi-text">Edit</span>
																		</a>
																	</li>
																	<li class="navi-item">
																		<a href="javascript:;" data-id="<?= $booking["id"] ?>" class="navi-link booking-delete">
																			<span class="navi-icon"><i class="la la-trash text-danger"></i></span>
																			<span class="navi-text">Delete</span>
																		</a>
																	</li>
																<?php
																	}
																?>
															</ul>
														</div>
													</div>

												</td>
											</tr>
										<?php
											}
										?>

									</tbody>
								</table>
							</div>

						<?php }else{ ?>

							<div class="alert alert-danger text-center">ไม่พบข้อมูลการจอง</div>

						<?php } ?>
					</div>

				</div>
				<!--end::Card-->

			<!--end::Entry-->
		</div>
		<!--end::Content-->


		<div class="modal fade" id="bookingInfoModal" tabindex="-1" role="dialog" aria-labelledby="bookingInfoModal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">

							<h5 class="modal-title" id="exampleModalLabel">
								<span class="flaticon-technology-2 icon-xl mr-2 "></span>รายละเอียดการจองห้อง
								<span id="md_room_name"></span>
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<i aria-hidden="true" class="ki ki-close"></i>
							</button>
						</div>
						<div class="modal-body">

								<div class="card-body">
									<div class="row">
											<div class="col-lg-6">
												<label>ชื่อผู้จอง: <span id="md_booking_name"></span></label>
											</div>
									</div>

									<div class="row">
											<div class="col-lg-5">
												<label>อีเมล์: <span id="md_booking_email"></span></label>
											</div>
											<div class="col-lg-4">
												<label>เบอร์โทรศัพท์มือถือ: <span id="md_booking_phone"></span></label>
											</div>
											<div class="col-lg-3">
												<label>เบอร์โทรศัพท์ภายใน: <span id="md_internal_phone"></span></label>
											</div>
									</div>

									<hr>

									<div class="row">
										<div class="col-lg-12">
											<label>ลักษณะการใช้งาน	: <span id="md_usage_category"></span> </label>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<label>วัตถุประสงค์ในการใช้งาน:</label>
											<div class="alert alert-custom alert-default" id="md_objective"></div>

										</div>
									</div>

									<div class="row">

										<div class="col-lg-6">
											<label>จำนวนผู้เข้าร่วม: <span id="md_participant"></span> คน</label>
										</div>
										<div class="col-lg-6">
											<label>เจ้าหน้าที่ประจำห้อง: <span id="md_require_staff"></span></label>
										</div>

									</div>

									<div class="row">
										<div class="col-lg-12">
											<label for="">ช่วงเวลาที่ต้องการจอง: <span id="md_booking_date_range"></span> </label>
										</div>
									</div>

								</div>

						</div>
					</div>
				</div>
		</div>
