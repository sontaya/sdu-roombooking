
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<?php echo $header; ?>
	<!--end::Head-->

	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile bg-primary header-mobile-fixed">
			<!--begin::Logo-->
			<a href="<?php echo base_url('page/landing'); ?>">
				<img alt="Logo" src="<?= base_url('assets/themes/metronic7/assets/media/logos/logo-letter-9.png'); ?>" class="max-h-30px" />
			</a>
			<!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
			<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header flex-column header-fixed">
						<!--begin::Top-->
						<div class="header-top">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Left-->
								<div class="d-none d-lg-flex align-items-center mr-3">
									<!--begin::Logo-->
									<a href="i<?php echo base_url('page/home'); ?>" class="mr-20">
										<img alt="Logo" src="<?= base_url('assets/themes/metronic7/assets/media/logos/logo-letter-9.png'); ?>" class="max-h-35px" />
									</a>
									<!--end::Logo-->

								</div>
								<!--end::Left-->
								<!--begin::Topbar-->
								<div class="topbar bg-primary">


									<!--begin::User-->
									<?php
										if($this->session->userdata('auth')['uid'] != null){
									?>
											<div class="topbar-item">
												<div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
													<div class="d-flex flex-column text-right pr-3">
														<span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline">
															<?= $this->session->userdata('auth')['displayname']; ?>
														</span>
													</div>
													<span class="symbol symbol-35">
														<?php
															$explode_uid = explode("_",$this->session->userdata('auth')['uid']);
															$short_uid = substr($explode_uid[0],0,1).substr($explode_uid[1],0,1);
														?>
														<span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30">
															<?php echo strtoupper($short_uid); ?>
														</span>
													</span>
												</div>
											</div>
									<?php
										}
									?>
									<!--end::User-->


								</div>
								<!--end::Topbar-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Top-->

					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Dashboard-->

								<?php echo $content; ?>

								<!--end::Dashboard-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted font-weight-bold mr-2"><?php echo date("Y"); ?> &COPY; </span>
								<a href="http://www.dusit.ac.th" target="_blank" class="text-dark-75 text-hover-primary">มหาวิทยาลัยสวนดุสิต</a>
							</div>
							<!--end::Copyright-->

						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
		<!-- begin::User Panel-->
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">User Profile</h3>
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content pr-5 mr-n5">
				<!--begin::Header-->
				<div class="d-flex align-items-center mt-5">
					<div class="symbol symbol-100 mr-5">
						<?php
							$profile_url = "https://personnel.dusit.ac.th/eprofile/main/files/bio_data_file/". $this->session->userdata('auth')['bio_pic_file'];
						?>
						<div class="symbol-label" style="background-image:url('<?php echo $profile_url; ?>'); background-position-y:top;"></div>
						<!-- <div class="symbol-label" style="background-color:darkgoldenrod"></div> -->
						<i class="symbol-badge bg-success"></i>
					</div>
					<div class="d-flex flex-column">
						<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= $this->session->userdata('auth')['displayname']; ?></a>
						<div class="text-muted mt-1"><?php echo $this->session->userdata('auth')['name_faculty'] ?></div>
						<div class="navi mt-2">
							<a href="<?php echo base_url('user/logout'); ?>" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
						</div>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Separator-->
				<div class="separator separator-dashed mt-8 mb-5"></div>
				<!--end::Separator-->
				<div class="navi navi-spacer-x-0 p-0">
					<!--begin::Item-->
					<a href="<?php echo base_url('user/profile'); ?>" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-success">
										<!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
												<circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</div>
							</div>
							<div class="navi-text">

									<div class="font-weight-bold">
										ช่องทางสำหรับติดต่อ
									</div>
								<!-- <div class="text-muted">
									Account settings and more
								</div> -->
							</div>
						</div>
					</a>
					<!--end:Item-->

				</div>

			</div>
			<!--end::Content-->
		</div>
		<!-- end::User Panel-->



		<?php echo $footer; ?>


	</body>
	<!--end::Body-->
</html>