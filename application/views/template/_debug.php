
<div class="alert alert-warning alert-outline-warning mb-5 p-5" role="alert">
	<h4 class="alert-heading">Env: <?= ENVIRONMENT ?></h4>
	<p>
			<pre>
				<?php
					print_r($this->session->userdata('auth'));
				?>
			</pre>

	</p>
	<div class="border-bottom border-white opacity-20 mb-5"></div>
	<p>

				<?php
					// echo "Online > ". in_array("online",$this->session->userdata('auth')['manage_app'])."<br>";
					// echo "hybrid > ". in_array("hybrid",$this->session->userdata('auth')['manage_app']);


					// if(in_array("hybrid", $this->session->userdata('manage_app'))){
					// 	echo "Hybrid grant";
					// }




					// print_r($this->session->userdata('auth')['manage_app']);
				?>


	</p>
</div>
