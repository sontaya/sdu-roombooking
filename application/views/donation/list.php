	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">

			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header flex-wrap border-0 pt-6 pb-0">
					<div class="card-title">

						<h3 class="card-label">โครงการจัดหาทุนช่วยเหลือนักศึกษาที่ได้รับผลกระทบจากโควิด 19
						<span class="d-block text-muted pt-2 font-size-sm">สำนักงานเลขานุการสภามหาวิทยาลัย</span></h3>
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
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="la la-file-excel-o"></i>
											</span>
											<span class="navi-text">Excel</span>
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
					<!--begin: Search Form-->
					<!--begin::Search Form-->
					<div class="mb-7">
						<div class="row align-items-center">
							<div class="col-lg-9 col-xl-8">
								<div class="row align-items-center">
									<div class="col-md-6 my-2 my-md-0">
										<div class="input-icon">
											<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
											<span>
												<i class="flaticon2-search-1 text-muted"></i>
											</span>
										</div>
									</div>
									<div class="col-md-6 my-2 my-md-0">
										<div class="d-flex align-items-center">
											<label class="mr-3 mb-0 d-none d-md-block">Process Status:</label>
											<select class="form-control" id="kt_datatable_search_process_status" name="kt_datatable_search_process_status">
												<option value="">All</option>
												<option value="1">Pending</option>
												<option value="2">Success</option>
												<option value="3">Canceled</option>
											</select>
										</div>
									</div>

								</div>
							</div>
							<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
								<a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
							</div>
						</div>
					</div>
					<!--end::Search Form-->
					<!--end: Search Form-->
					<!--begin: Datatable-->
					<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
					<!--end: Datatable-->
				</div>
			</div>
			<!--end::Card-->

		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->


<div class="modal fade" id="donationInfoModal" tabindex="-1" role="dialog" aria-labelledby="donationInfoModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ข้อมูลการบริจาค</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button>
			</div>
			<div class="modal-body">
				<h5 id="mdiFullname"></h5>
				<div class="row">
					<div class="col-md-6">
						<div class="py-4">
							<div class="d-flex align-items-center justify-content-between mb-2 ml-4">
								<span class="font-weight-bold mr-2">จำนวนเงินที่บริจาค:</span>
								<span class="text-muted text-hover-primary" id="mdiDonateAmount"></span>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-2 ml-4">
								<span class="font-weight-bold mr-2">ธนาคาร:</span>
								<span class="text-muted" id="mdiDonateBank"></span>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-4 ml-4">
								<span class="font-weight-bold mr-2">วันเวลาที่โอน:</span>
								<span class="text-muted" id="mdiDonateDate"></span>
							</div>

							<h6 class="mb-2">ข้อมูลใบเสร็จ</h6>
							<div class="d-flex align-items-center justify-content-between mb-2 ml-4">
								<span class="font-weight-bold mr-2">ชื่อ นามสกุล:</span>
								<span class="text-muted text-hover-primary" id="mdiReceiptFullname"></span>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-2 ml-4">
								<span class="font-weight-bold mr-2">เลขประจำตัวประชาชน:</span>
								<span class="text-muted" id="mdiReceiptIdCard"></span>
							</div>
							<div class="d-flex align-items-center justify-content-between ml-4">
								<span class="font-weight-bold mr-2">เบอร์โทรศัพท์มือถือ:</span>
								<span class="text-muted" id="mdiReceiptMobile"></span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<img src="" class="img-fluid" alt="Evidence Image" id="mdiDonateEvidence">
						<div class="d-flex align-items-center justify-content-end mt-2">
							<a href="#" class="btn btn-light-primary font-weight-bold btn-sm" target="_blank" id="mdiDonateEvidenceURL"> ดูภาพขนาดเต็ม</a>
						</div>
					</div>
				</div>

				<hr>
				<div class="row">
					<div class="col-md-9">
						<h6>ที่อยู่สำหรับระบุบนใบเสร็จ</h6>
						<div class="text-muted" id="mdiReceiptAddress"></div>

						<h6 class="mt-2">ที่อยู่สำหรับจัดส่งใบเสร็จ </h6>
						<div class="text-muted" id="mdiDeliveryAddress"></div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Process Status</label>
							<div class="radio-list">
								<label class="radio radio-warning text-warning">
									<input type="radio" name="process_status" value="1">Pending
									<span></span>
								</label>
								<label class="radio radio-success text-success">
									<input type="radio" name="process_status" value="2">Success
									<span></span>
								</label>
								<label class="radio radio-danger text-danger">
									<input type="radio" name="process_status" value="3">Canceled
									<span></span>
								</label>
							</div>
						</div>
					</div>
				</div>


					<div class="modal-footer">
						<input type="hidden" name="mdiID" id="mdiID" value="">
						<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary font-weight-bold" id="btnModalSave">Save changes</button>
					</div>
					<!--end::Card-->
					<!--end::Row-->
				</hr>
			</div>
		</div>
	</div>
</div>
