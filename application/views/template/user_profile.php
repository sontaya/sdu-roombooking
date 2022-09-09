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

