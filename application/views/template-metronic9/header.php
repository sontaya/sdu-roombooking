	<head>
		<base href="">
		<meta charset="utf-8" />
		<title><?= $title ?> | SDU Donate</title>
		<meta name="author" content="มหาวิทยาลัยสวนดุสิต">
		<meta name="keywords" content="มหาวิทยาลัยสวนดุสิต, สวนดุสิต, สมาคมศิษย์เก่าการเรือน-สวนดุสิต, คณะกรรมการส่งเสริมกิจการมหาวิทยาลัย, บริจาค, ทุนการศึกษา, ไวรัสโคโรน่า 2019, COVID-19, donate, SDU Donate">
		<meta name="robots" content="index, follow">
		<meta name="description" content="โครงการจัดหาทุนช่วยเหลือนักศึกษาที่ได้รับผลกระทบจากโควิด 19 มหาวิทยาลัยสวนดุสิต" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


		<meta property="og:site_name" content="SDU Donate" />
		<meta property="og:url" content="https://donate.dusit.ac.th/" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="โครงการจัดหาทุนช่วยเหลือนักศึกษาที่ได้รับผลกระทบจากโควิด 19 มหาวิทยาลัยสวนดุสิต" />
		<meta property="og:description" content="โครงการจัดหาทุนช่วยเหลือนักศึกษาที่ได้รับผลกระทบจากโควิด 19 ร่วมบริจาคสมทบทุน สนับสนุนทุนการศึกษาแก่นักศึกษาที่ขาดแคลนทุนทรัพย์และได้รับผลกระทบจากสถานการณ์"/>
		<meta property="og:image" content="<?= base_url('assets/images/sdu-logo-text-th.png'); ?>" />

		<!--begin::Fonts-->
		<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;500&display=swap" rel="stylesheet">
		<!--end::Fonts-->
		<!--begin::Page Vendors Styles(used by this page)-->

		<?php if(isset($cssSrc)){ ?>
            <?php foreach($cssSrc as $css): ?>
				<link href="<?= base_url(); ?><?= $css ?>" rel="stylesheet" type="text/css" />
            <?php endforeach; ?>
        <?php } ?>

		<!--end::Page Vendors Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="<?= base_url('assets/themes/metronic9/assets/plugins/global/plugins.bundle.css?v=7.0.3'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/themes/metronic9/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.3'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/css/custom-style.bundle.css?v=7.0.3'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/css/custom.css'); ?>" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="<?php echo base_url('assets/images/logo-sdu-text-th.png'); ?>" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-7497655-44"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-7497655-44');
		</script>


	</head>
