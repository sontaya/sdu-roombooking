	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">

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
																<?= $r['name'] ?> - <?= $r['place'] ?>
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

			<!--begin::Result-->
			<div class="card card-custom mt-3">
				<div class="card-header flex-wrap border-0 pt-6 pb-0">
					<div class="card-title">
						<h3 class="card-label">รายการจองห้อง
					</div>
					<div class="card-toolbar">
						<!--begin::Dropdown-->
						<div class="dropdown dropdown-inline mr-2">
							<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="svg-icon svg-icon-md">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
										<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>Export</button>
							<!--begin::Dropdown Menu-->
							<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
								<!--begin::Navigation-->
								<ul class="navi flex-column navi-hover py-2">
									<li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
									<li class="navi-item">
										<a href="javascript:;" class="navi-link export-xlsx-tag">
											<span class="navi-icon">
												<i class="la la-file-excel-o"></i>
											</span>
											<span class="navi-text">Excel</span>
										</a>
									</li>
									<li class="navi-item">
										<a hhref="javascript:;" class="navi-link export-roomreserve-tag">
											<span class="navi-icon">
												<i class="la la-file-pdf-o"></i>
											</span>
											<span class="navi-text">PDF</span>
										</a>
									</li>
								</ul>
								<!--end::Navigation-->
							</div>
							<!--end::Dropdown Menu-->
						</div>
						<!--end::Dropdown-->

					</div>
				</div>
				<div class="card-body">

					<?php if($booking_lists != false){ ?>

						<!--begin: Datatable-->
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th scope="col">
													<div class="checkbox-single mb-2">
														<label class="checkbox checkbox-info checkbox-all">
															<input type="checkbox" name="room_selected_all" value="" />
														<span style="width: 25px; height: 25px; top: -5px;"></span></label>
													</div>
											</th>
											<th scope="col">#</th>
											<th scope="col">ชื่อห้อง</th>
											<th scope="col">ข้อมูลผู้จอง</th>
											<th scope="col">ลักษณะการใช้งาน</th>
											<th scope="col">วันที่เริ่มต้น</th>
											<th scope="col">วันที่สิ้นสุด</th>
											<th scope="col">วันที่ทำรายการ</th>
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
												<td >
													<div class="checkbox-single mb-2">
														<label class="checkbox checkbox-info">
															<input type="checkbox" name="room_selected" value="<?= $booking['id'] ?>" class="room_selected" />
														<span style="width: 25px; height: 25px; top: -5px;"></span></label>
													</div>
												</td>
												<td scope="row">
													<div class="symbol symbol-40 symbol-light-info flex-shrink-0">
														<span class="symbol-label font-size-h5 font-weight-bold"><?= $booking["room_tag"] ?></span>
													</div>

												</td>
												<td class="align-middle"><?= $booking["room_shortname"] ?></td>
												<td class="align-middle"><?= $booking["academic_fullname"] ?></td>
												<td class="align-middle"><?= $booking["usage_category_desc"] ?></td>
												<td class="align-middle"><?= get_thai_datetime($booking["booking_date_start"],1,true); ?></td>
												<td class="align-middle"><?= get_thai_datetime($booking["booking_date_end"],1,true); ?></td>
												<td class="align-middle"><?= get_thai_datetime($booking["created_at"],1,true); ?></td>
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

																<li class="navi-item">
																	<a href="javascript:;" onclick="booking_approve('<?php echo $booking['id']; ?>','approved');return false;" data-id="<?php echo $booking['id']; ?>" class="navi-link booking-approve">
																		<span class="navi-icon"><i class="flaticon2-calendar-5 text-success"></i></span>
																		<span class="navi-text">อนุมัติ</span>
																	</a>
																</li>
																<li class="navi-item">
																	<a href="javascript:;" data-id="<?php echo $booking['id']; ?>" class="navi-link booking-reject">
																		<span class="navi-icon"><i class="flaticon-cancel text-warning"></i></span>
																		<span class="navi-text">ไม่อนุมัติ</span>
																	</a>
																</li>
																<li class="navi-item">
																	<a href="javascript:;" data-id="<?= $booking["id"] ?>" class="navi-link booking-cancel">
																		<span class="navi-icon"><i class="flaticon2-cancel text-light-dark"></i></span>
																		<span class="navi-text">ยกเลิกโดยผู้จอง</span>
																	</a>
																</li>
																<li class="navi-item">
																	<a href="<?php echo base_url('hybridbackoffice/form_admin/').$booking["id"]; ?>" data-id="<?= $booking["id"] ?>" class="navi-link booking-edit">
																		<span class="navi-icon"><i class="la la-edit text-primary"></i></span>
																		<span class="navi-text">แก้ไข</span>
																	</a>
																</li>
																<li class="navi-item">
																	<a href="javascript:;" onclick="booking_delete('<?php echo $booking['id']; ?>');return false;" data-id="<?php echo $booking['id']; ?>" class="navi-link booking-delete">
																		<span class="navi-icon"><i class="flaticon-delete-1 text-danger"></i></span>
																		<span class="navi-text">ลบ</span>
																	</a>
																</li>

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
						<!--end: Datatable-->

					<?php }else{ ?>

						<div class="alert alert-danger text-center">ไม่พบข้อมูลการจอง</div>

					<?php } ?>
				</div>
			</div>
			<!--end::Card-->

		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->

<?php
	include("_inc_hybridbackoffice_modal.php");
?>

