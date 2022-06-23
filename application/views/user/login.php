
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>เข้าสู่ระบบ | Room Booking</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Fonts-->
		<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;500&display=swap" rel="stylesheet">
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="<?= base_url('assets/css/booking-login.css'); ?>" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="<?= base_url('assets/themes/metronic7/assets/plugins/global/plugins.bundle.css?v=7.0.3'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/themes/metronic7/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.3'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/css/booking-custom-style.bundle.css?v=7.0.3'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/css/custom-style.css'); ?>" rel="stylesheet" type="text/css" />		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="<?php echo base_url('assets/images/logo-sdu-text-th.png'); ?>" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
					<!--begin: Aside Container-->
					<div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
						<!--begin::Logo-->
						<a href="<?php echo base_url(); ?>" class="text-center pt-2">
							<img src="<?= base_url('assets/images/sdu-logo-h120.png'); ?>" class="max-h-120px" alt="" />
						</a>
						<!--end::Logo-->
						<!--begin::Aside body-->
						<div class="d-flex flex-column-fluid flex-column flex-center">
							<!--begin::Signin-->
							<div class="login-form login-signin py-11">
								<!--begin::Form-->
								<form class="form" novalidate="novalidate" id="kt_login_signin_form">
									<!--begin::Title-->
									<div class="text-center pb-8">
										<h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sign In</h2>
									</div>
									<!--end::Title-->
									<!--begin::Form group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">Username</label>
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" id="input_username" name="input_username" autocomplete="off" value="sontaya_yam" />
									</div>
									<!--end::Form group-->
									<!--begin::Form group-->
									<div class="form-group">
										<div class="d-flex justify-content-between mt-n5">
											<label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
										</div>
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" id="input_password" name="input_password" autocomplete="off" value="admin@sdu" />
									</div>
									<!--end::Form group-->
									<!--begin::Action-->
									<div class="text-center ">
										<button id="kt_login_signin_submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Sign In</button>
									</div>
									<!--end::Action-->

									<div class="alert alert-light text-center pt-1" role="alert">
										!! เข้าใช้งานระบบโดย !!<br>ใช้ชื่อผู้ใช้งานเดียวกันกับระบบอินเทอร์เน็ตมหาวิทยาลัย
									</div>
								</form>
								<!--end::Form-->
							</div>
							<!--end::Signin-->


						</div>
						<!--end::Aside body-->

					</div>
					<!--end: Aside Container-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #B1DCED;">
					<!--begin::Title-->
					<div class="d-flex flex-column justify-content-center text-center pt-lg-40 pt-md-5 pt-sm-5 px-lg-0 pt-5 px-7">
						<h3 class="display3 font-weight-bolder my-7 text-dark" style="color: #986923;">ระบบ Room Booking</h3>
						<h3 class="display5 font-weight-bolder my-7 text-dark" style="color: #986923;">สำหรับจองห้อง SDU Online Learning เพื่อใช้ในการสอนออนไลน์และการประชุมออนไลน์</h3>

					</div>
					<!--end::Title-->
					<!--begin::Image-->
					<div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url(<?= base_url('assets/themes/metronic7/assets/media/svg/illustrations/login-visual-2.svg'); ?>);"></div>
					<!--end::Image-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->

		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="<?= base_url('assets/themes/metronic7/assets/plugins/global/plugins.bundle.js?v=7.0.3'); ?>"></script>
		<script src="<?= base_url('assets/themes/metronic7/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.3'); ?>"></script>
		<script src="<?= base_url('assets/themes/metronic7/assets/js/scripts.bundle.js?v=7.0.3'); ?>"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script>var BASE_URL = "<?php echo base_url(); ?>";</script>
		<script src="<?= base_url('assets/js/booking-login.js'); ?>"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>
