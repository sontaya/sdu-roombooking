
	<head><base href="">
		<meta charset="utf-8" />
		<title><?= $title ?> | ระบบจองห้องมหาวิทยาลัยสวนดุสิต</title>
		<meta name="author" content="มหาวิทยาลัยสวนดุสิต">
		<meta name="keywords" content="มหาวิทยาลัยสวนดุสิต, สวนดุสิต">
		<meta name="robots" content="index, follow">
		<meta name="description" content="ระบบจองห้องมหาวิทยาลัยสวนดุสิต" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<!--begin::Fonts-->
		<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;500&display=swap" rel="stylesheet">
		<!--end::Fonts-->

		<?php if(isset($cssSrc)){ ?>
            <?php foreach($cssSrc as $css): ?>
				<link href="<?= base_url(); ?><?= $css ?>" rel="stylesheet" type="text/css" />
            <?php endforeach; ?>
        <?php } ?>

		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="<?= base_url('assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3'); ?>" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->

		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="<?= base_url('assets/themes/metronic7/assets/plugins/global/plugins.bundle.css?v=7.0.3'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/themes/metronic7/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.3'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/css/booking-custom-style.bundle.css?v=7.0.3'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/css/custom-style.css'); ?>" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->

		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="<?php echo base_url('assets/images/logo-sdu-text-th.png'); ?>" />

		<!-- Google tag (gtag.js) -->
		<!--
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-BBC0LY6JZJ"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-BBC0LY6JZJ');
		</script>
		-->
	</head>
