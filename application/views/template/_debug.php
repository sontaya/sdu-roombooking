
<div class="alert alert-warning alert-outline-warning mb-5 p-5" role="alert">
	<h4 class="alert-heading">Env: <?= ENVIRONMENT ?></h4>
	<div class="row">
		<div class="col-md">
			<pre>
				<?php
					print_r($this->session->userdata('auth'));
				?>
			</pre>
		</div>
		<div class="col-md">
			<pre>
				<?php
					print_r($this->session->userdata('export_target'));
				?>
			</pre>
		</div>
	</div>

	<div class="border-bottom border-white opacity-20 mb-5"></div>
	<p>

	</p>
</div>
