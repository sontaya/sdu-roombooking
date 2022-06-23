						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!-- begin::Card-->
								<div class="card card-custom overflow-hidden">
									<div class="card-body p-0">
										<!-- begin: Invoice-->
										<!-- begin: Invoice header-->
										<div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0"
											style="background-image: url(<?= base_url('assets/themes/metronic9/assets/media/bg/bg-6.jpg') ?>);">
											<div class="col-md-9">
												<div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
													<h1 class="display-4 text-white font-weight-boldest mb-10">บันทึกข้อมูลเรียบร้อย</h1>
													<div class="d-flex flex-column align-items-md-end px-0">
														<!--begin::Logo-->
														<a href="#" class="mb-5">
															<img src="<?= base_url('assets/images/sdu-logo-h120.png'); ?>" alt="" />
														</a>
														<!--end::Logo-->
														<span class="text-white d-flex flex-column align-items-md-end opacity-70">

															<span>โครงการจัดหาทุนช่วยเหลือนักศึกษาที่ได้รับผลกระทบจากโควิด 19</span>
															<span>สำนักงานเลขานุการสภามหาวิทยาลัย</span>
														</span>
													</div>
												</div>
												<div class="border-bottom w-100 opacity-20"></div>
												<div class="d-flex justify-content-between text-white pt-6">
													<div class="d-flex flex-column flex-root">
														<span class="font-weight-bolde mb-2r">รายนามผู้บริจาค</span>
														<span class="opacity-70 ">
															<?= $donate_info['firstname']; ?> <?= $donate_info['lastname']; ?>
															<br /><?= $donate_info['receipt_mobile']; ?>
														</span>
													</div>

													<div class="d-flex flex-column flex-root">
														<span class="font-weight-bolder mb-2">ที่อยู่สำหรับระบุบนใบเสร็จ</span>
														<span class="opacity-70"><?= $donate_info['receipt_address']; ?>
														</span>
													</div>
												</div>
											</div>
										</div>
										<!-- end: Invoice header-->

										<!-- begin: Invoice action-->
										<div class="row justify-content-end py-md-12 px-md-8">

												<div class="d-flex justify-content-between">
													<a href="<?=  base_url('main/index') ?>" class="btn btn-primary font-weight-bold" >กลับไปหน้าแรก</a>
												</div>

										</div>
										<!-- end: Invoice action-->
										<!-- end: Invoice-->
									</div>
								</div>
								<!-- end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
