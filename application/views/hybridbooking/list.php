

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
															<?= $r["name"] ?> - <?= $r["place"] ?>
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
												<option value="canceled" <?php if($criterias["booking_status"] == "canceled"){ echo "selected"; } ?>>ยกเลิกโดยผู้จอง</option>
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
										<th scope="col">ข้อมูลผู้จอง/ผู้สอน</th>
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
											if($booking["user_id"]==$booking["teacher_id"] and $booking["usage_category"]=="1"){
												$all_owner =  $booking["academic_fullname"];
											}elseif($booking["user_id"]!=$booking["teacher_id"] and $booking["usage_category"]=="1"){
												$all_owner =  $booking["academic_fullname"] ."<hr class='all-owner' />".$booking["teacher_fullname"];
											}else{
												$all_owner =  $booking["academic_fullname"];
											}
									?>
										<tr>
											<th scope="row">
												<div class="symbol symbol-40 symbol-light-info flex-shrink-0">
														<span class="symbol-label font-size-h5 font-weight-bold"><?= $booking["room_tag"] ?></span>
												</div>

											</th>
											<td class="align-middle"><?= $booking["room_shortname"] ?></td>
											<td class="align-middle"><?= $all_owner ?></td>
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
														case 'canceled':
															$label_class = "label-light-dark-75";
															break;

													}
												?>
												<span class="label label-inline <?php echo $label_class; ?> font-weight-bold">
													<?= $booking["booking_status_desc"] ?>
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
																	<span class="navi-text">ดูข้อมูล</span>
																</a>
															</li>
															<?php
																if(
																	// and $booking['booking_status'] != 'rejected'
																	$this->session->userdata('auth')['hrcode']==$booking['user_id']
																	and $booking['booking_status'] != 'canceled'
																	and $booking['booking_status'] != 'pending'
																){
															?>
																<li class="navi-item">
																	<a href="javascript:;" data-id="<?= $booking["id"] ?>" class="navi-link booking-cancel">
																		<span class="navi-icon"><i class="flaticon2-cancel text-light-dark"></i></span>
																		<span class="navi-text">ยกเลิกโดยผู้จอง</span>
																	</a>
																</li>
															<?php
																}
															?>

															<?php
																if($booking['booking_status'] != 'approved'
																	and $booking['booking_status'] != 'rejected'
																	and $booking['booking_status'] != 'canceled'
																	and $this->session->userdata('auth')['hrcode']==$booking['user_id']
																){
															?>
																<li class="navi-item">
																	<a href="<?php echo base_url('hybrid/form/').$booking["id"]; ?>" data-id="<?= $booking["id"] ?>" class="navi-link booking-edit">
																		<span class="navi-icon"><i class="la la-edit text-primary"></i></span>
																		<span class="navi-text">แก้ไข</span>
																	</a>
																</li>
															<?php
																}
															?>
															<?php
																if($booking['booking_status'] != 'approved'
																	and $booking['booking_status'] != 'rejected'
																	and $booking['booking_status'] != 'canceled'
																	and $this->session->userdata('auth')['hrcode']==$booking['user_id']
																){
															?>
																<li class="navi-item">
																	<a href="javascript:;" data-id="<?= $booking["id"] ?>" class="navi-link booking-delete">
																		<span class="navi-icon"><i class="la la-trash text-danger"></i></span>
																		<span class="navi-text">ลบ</span>
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


	<?php
		include("_inc_hybrid_modal.php");
	?>
