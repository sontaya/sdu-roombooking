<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<?php echo $header; ?>
	<!--end::Head-->

	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile bg-teal header-mobile-fixed">
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
						<div class="header-top bg-teal">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Left-->
								<div class="d-none d-lg-flex align-items-center mr-3">
									<!--begin::Logo-->
									<a href="<?php echo base_url('page/landing'); ?>" class="mr-20">
										<img alt="Logo" src="<?= base_url('assets/themes/metronic7/assets/media/logos/logo-letter-9.png'); ?>" class="max-h-35px" />
									</a>
									<!--end::Logo-->
									<!--begin::Tab Navs(for desktop mode)-->
									<ul class="header-tabs nav align-self-end font-size-lg" role="tablist" id="main-desktop-menu">
										<!--begin::Item-->
										<li class="nav-item">
											<a href="<?php echo base_url("meeting/home"); ?>" class="nav-link py-4 px-6 <?php if($this->session->userdata('menu')['active'] == '100'){ echo "active";} ?>" >หน้าแรก</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="nav-item mr-3">
											<a href="<?php echo base_url("meeting/room_info"); ?>" class="nav-link py-4 px-6 <?php if($this->session->userdata('menu')['active'] == '200'){ echo "active";} ?>" >รายละเอียดห้อง</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="nav-item mr-3">
											<a href="#" class="nav-link py-4 px-6 <?php if($this->session->userdata('menu')['active'] == '300'){ echo "active";} ?>" data-toggle="tab" data-target="#kt_header_tab_booking" role="tab">จองห้อง</a>
										</li>
										<!--end::Item-->
										<?php
											 if( ($this->session->userdata('auth')['role'] == "admin") || ($this->session->userdata('auth')['role'] == "delegate_admin")){
												if (in_array("hybrid", $this->session->userdata('auth')['manage_app'])) {
										?>
											<!--begin::Item-->
											<li class="nav-item mr-2">
												<a href="#" class="nav-link py-4 px-6 <?php if ($this->session->userdata('menu')['active'] == '500') {
												    echo "active";
												} ?>" data-toggle="tab" data-target="#kt_header_tab_bookingadmin" role="tab">สำหรับเจ้าหน้าที่</a>
											</li>
											<!--end::Item-->
										<?php
												}
											}
										?>

									</ul>
									<!--begin::Tab Navs-->
								</div>
								<!--end::Left-->
								<!--begin::Topbar-->
								<div class="topbar bg-teal">

									<!--begin::User-->
										<?php echo $user_profile; ?>
									<!--end::User-->

								</div>
								<!--end::Topbar-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Top-->
						<!--begin::Bottom-->
						<div class="header-bottom">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Header Menu Wrapper-->
								<div class="header-navs header-navs-left" id="kt_header_navs">
									<!--begin::Tab Navs(for tablet and mobile modes)-->
									<ul class="header-tabs p-5 p-lg-0 d-flex d-lg-none nav nav-bold nav-tabs" role="tablist">

										<!--begin::Item-->
										<li class="nav-item mr-2">
											<a href="<?php echo base_url("meeting/room_info"); ?>" class="nav-link btn btn-clean" >รายละเอียดห้อง</a>
										</li>
										<!--end::Item-->
										<!--begin::จองห้อง-->
										<?php
											 if(($this->session->userdata('auth')['role'] != "admin") && ($this->session->userdata('auth')['role'] != "delegate_admin")){
										?>
												<li class="nav-item mr-2">
													<a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_booking" role="tab">จองห้อง</a>
												</li>
										<?php
											 }
										?>
										<!--end::จองห้อง-->

										<!--begin::จองโดยเจ้าหน้าที่-->
										<?php
											 if( ($this->session->userdata('auth')['role'] == "admin") || ($this->session->userdata('auth')['role'] == "delegate_admin")){
												if (in_array("hybrid", $this->session->userdata('auth')['manage_app'])) {
										?>
													<li class="nav-item mr-2">
														<a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_bookingadmin" role="tab">จองโดยเจ้าหน้าที่</a>
													</li>
										<?php
												}
											}
										?>
										<!--end::จองโดยเจ้าหน้าที่-->
									</ul>
									<!--begin::Tab Navs-->

									<!--begin::Tab Content-->
									<div class="tab-content">

										<!--begin::Tab header_tab_home-->
										<div class="tab-pane py-5 p-lg-0 <?php if($this->session->userdata('menu')['active'] == '100'){ echo "show active";} ?>" id="kt_header_tab_home">
											<!--begin::Menu-->
											<div id="kt_header_menu_home" class="header-menu header-menu-mobile header-menu-layout-default">
											</div>
											<!--end::Menu-->
										</div>
										<!--end::Tab header_tab_home-->

										<!--begin::Tab header_tab_booking-->
											<div class="tab-pane py-5 p-lg-0 <?php if($this->session->userdata('menu')['active'] == '300'){ echo "show active";} ?>" id="kt_header_tab_booking">
												<!--begin::Menu-->
												<div id="kt_header_menu_booking" class="header-menu header-menu-mobile header-menu-layout-default">

													<!--begin::Nav-->
													<ul class="menu-nav">

														<li class="menu-item" aria-haspopup="true">
															<a href="<?php echo base_url('meeting/form') ?>" class="menu-link ">
																<span class="menu-text">จองห้อง</span>
																<span class="menu-desc"></span>
																<i class="menu-arrow"></i>
															</a>
														</li>
														<li class="menu-item" aria-haspopup="true">
															<a href="<?php echo base_url('meeting/list') ?>" class="menu-link ">
																<span class="menu-text">รายการจองห้อง</span>
																<span class="menu-desc"></span>
																<i class="menu-arrow"></i>
															</a>
														</li>
														<li class="menu-item" aria-haspopup="true">
															<a href="<?php echo base_url('meeting/view') ?>" class="menu-link ">
																<span class="menu-text">มุมมองปฏิทิน</span>
																<span class="menu-desc"></span>
																<i class="menu-arrow"></i>
															</a>
														</li>

													</ul>
													<!--end::Nav-->
												</div>
												<!--end::Menu-->
											</div>
										<!--end::Tab header_tab_booking-->

										<!--begin::Tab header_tab_bookingadmin-->
											<?php
												if( ($this->session->userdata('auth')['role'] == "admin") || ($this->session->userdata('auth')['role'] == "delegate_admin")){
													if (in_array("hybrid", $this->session->userdata('auth')['manage_app'])) {
											?>
												<div class="tab-pane py-5 p-lg-0 <?php if ($this->session->userdata('menu')['active'] == '500') { echo "show active";} ?>" id="kt_header_tab_bookingadmin">
													<!--begin::Menu-->
													<div id="kt_header_menu_bookingadmin" class="header-menu header-menu-mobile header-menu-layout-default">

														<!--begin::Nav-->
														<ul class="menu-nav">


															<li class="menu-item" aria-haspopup="true">
																<a href="<?php echo base_url('meetingbackoffice/booking_manage') ?>" class="menu-link ">
																	<span class="menu-text">รายการจองห้อง</span>
																	<span class="menu-desc"></span>
																	<i class="menu-arrow"></i>
																</a>
															</li>
															<li class="menu-item" aria-haspopup="true">
																<a href="<?php echo base_url('meetingbackoffice/booking_calendar') ?>" class="menu-link ">
																	<span class="menu-text">มุมมองปฏิทิน</span>
																	<span class="menu-desc"></span>
																	<i class="menu-arrow"></i>
																</a>
															</li>
															<li class="menu-item" aria-haspopup="true">
																<a href="<?php echo base_url('meetingbackoffice/form_admin') ?>" class="menu-link ">
																	<span class="menu-text">จองโดยเจ้าหน้าที่</span>
																	<span class="menu-desc"></span>
																	<i class="menu-arrow"></i>
																</a>
															</li>

														</ul>
														<!--end::Nav-->
													</div>
													<!--end::Menu-->
												</div>
											<?php
													}
												}
											?>
										<!--end::Tab header_tab_booking-->

										<!--begin::Tab Pane-->
										<div class="tab-pane py-5 p-lg-0" id="kt_header_tab_1">
											<!--begin::Menu-->
											<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">

											</div>
											<!--end::Menu-->
										</div>
										<!--begin::Tab Pane-->

										<!--begin::Tab Pane-->
									</div>
									<!--end::Tab Content-->
								</div>
								<!--end::Header Menu Wrapper-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Bottom-->
					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">

								<!--begin::Debug-->
								<?php
									if(ENVIRONMENT == "development"){
										include('_debug.php');
									}
								?>
								<!--end::Debug-->

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
						<?php include('_footer_copyright.php') ?>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
		<!-- begin::User Panel-->

			<?php echo $user_panel; ?>

		<!-- end::User Panel-->



		<?php echo $footer; ?>


	</body>
	<!--end::Body-->
</html>
