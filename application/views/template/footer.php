
		<script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="<?= base_url('assets/themes/metronic7/assets/plugins/global/plugins.bundle.js?v=7.0.3'); ?>"></script>
		<script src="<?= base_url('assets/themes/metronic7/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.3'); ?>"></script>
		<script src="<?= base_url('assets/themes/metronic7/assets/js/scripts.bundle.js?v=7.0.3'); ?>"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="<?= base_url('assets/themes/metronic7/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.3'); ?>"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?= base_url('assets/js/booking-init-widget.js?version=1.2'); ?>"></script>
		<script src="<?= base_url('assets/js/my-global.js?version=1.2'); ?>"></script>
		<!--end::Page Scripts-->

		<script>
			var BASE_URL = "<?php echo base_url(); ?>";
		</script>

		<script>
			const env = '<?php echo ENVIRONMENT; ?>';
			if(env === 'production'){
				console.log = function() {};
			}
		</script>

		<?php if(isset($jsSrc)){ ?>
            <?php foreach($jsSrc as $js): ?>
                <script src="<?= base_url(); ?><?= $js ?>?version=1.3"></script>
            <?php endforeach; ?>
        <?php } ?>
