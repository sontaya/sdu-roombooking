
		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
			<div class="container">
				<div class="card card-custom">
					<div class="card-body p-0">

							<div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
								<div class="col-xl-12 col-xxl-7">
									<!--begin: Wizard Form-->
									<form class="form" id="FormDonation"  action="<?php echo base_url('main/donate_store'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
										<!--begin: Wizard Step 1-->
										<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
											<h4 class="mb-10 font-weight-bold text-dark">กรอกรายละเอียดการบริจาค</h4>
											<div class="row">
												<div class="col-xl-6">
													<!--begin::Input-->
													<div class="form-group">
														<label>ชื่อ</label>
														<input type="text" class="form-control" id="firstname" name="firstname" placeholder="" value="" data-error="#firstname_error" />
														<div class="invalid-feedback" id="firstname_error" style="color:red;"></div>
													</div>
													<!--end::Input-->
												</div>
												<div class="col-xl-6">
													<!--begin::Input-->
													<div class="form-group">
														<label>นามสกุล</label>
														<input type="text" class="form-control" id="lastname" name="lastname" placeholder="" value="" />
													</div>
													<!--end::Input-->
												</div>
											</div>

											<!--begin::Input-->
											<div class="form-group">
												<label>อีเมล์</label>
												<input type="text" class="form-control" id="email" name="email" placeholder="" value="" />
											</div>
											<!--end::Input-->

											<div class="row">
												<div class="col-xl-6">
													<!--begin::Input-->
													<div class="form-group">
														<label>ระบุจำนวนเงินที่บริจาค</label>
														<input type="text" class="form-control" id="donate_amount" name="donate_amount" placeholder="" value="" />
													</div>
													<!--end::Input-->
												</div>
												<div class="col-xl-6">
													<!--begin::Input-->
													<div class="form-group">
														<label>ธนาคาร</label>
														<select id="donate_bank" name="donate_bank" class="form-control">
															<option value="BBL">ธนาคารกรุงเทพ</option>
															<option value="KBANK">ธนาคารกสิกรไทย</option>
															<option value="KTB">ธนาคารกรุงไทย</option>
															<option value="TMB">ธนาคารทหารไทย</option>
															<option value="SCB">ธนาคารไทยพาณิชย์</option>
															<option value="BAY">ธนาคารกรุงศรีอยุธยา</option>
															<option value="KKP">ธนาคารเกียรตินาคิน</option>
															<option value="CIMBT">ธนาคารซีไอเอ็มบีไทย</option>
															<option value="TISCO">ธนาคารทิสโก้</option>
															<option value="TBANK">ธนาคารธนชาต</option>
															<option value="UOBT">ธนาคารยูโอบี</option>
															<option value="TCD">ธนาคารไทยเครดิตเพื่อรายย่อย
															<option value="LHFG">ธนาคารแลนด์ แอนด์ เฮาส์</option>
															<option value="ICBCT">ธนาคารไอซีบีซี(ไทย)</option>
															<option value="SME">ธนาคารพัฒนาวิสาหกิจขนาดกลางและขนาดย่อมแห่งประเทศไทย</option>
															<option value="BAAC">ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร</option>
															<option value="EXIM">ธนาคารเพื่อการส่งออกและนำเข้าแห่งประเทศไทย</option>
															<option value="GSB">ธนาคารออมสิน</option>
															<option value="GHB">ธนาคารอาคารสงเคราะห์</option>
															<option value="ISBT">ธนาคารอิสลามแห่งประเทศไทย</option>
														</select>
													</div>
													<!--end::Input-->
												</div>
											</div>

											<div class="row">
												<div class="col-xl-6">
													<!--begin::Input-->
													<div class="form-group">
														<label>วันที่โอน</label>
														<div class="input-group date">
															<input type="text" class="form-control" readonly="readonly" value="" id="donate_date" name="donate_date" />
															<div class="input-group-append">
																<span class="input-group-text">
																	<i class="la la-calendar"></i>
																</span>
															</div>
														</div>
													</div>
													<!--end::Input-->
												</div>
												<div class="col-xl-6">
													<!--begin::Input-->
													<div class="form-group">
														<label>เวลา</label>
														<input type="text" class="form-control" name="donate_time" placeholder="" value="" />
													</div>
													<!--end::Input-->
												</div>
											</div>

											<div class="row">
												<div class="col-xl-6">
													<label>อัพโหลดไฟล์หลักฐานการโอนเงิน</label>
													<input id="donate_evidence" name="donate_evidence" type="file" class="form-control file-loading" multiple=false data-show-upload="false"  data-overwrite-initial="false">
												</div>
											</div>

											<!--begin::Separator-->
											<div class="separator separator-dashed my-7"></div>
											<!--end::Separator-->

											<div class="row">
												<div class="col-xl-6">
													<div class="form-group">

														<div class="checkbox-single">
															<label class="checkbox">
																<input type="checkbox" name="have_receipt" id="have_receipt" value="Y" /> ต้องการใบเสร็จรับเงิน
																<span></span>
															</label>
														</div>
													</div>
												</div>
											</div>

											<div id="receipt-box" style="display:none;">
												<div class="row">
													<div class="col-xl-6">
														<!--begin::Input-->
														<div class="form-group">
															<label>ชื่อ</label>
															<input type="text" class="form-control receipt-control" id="receipt_firstname" name="receipt_firstname" placeholder="" value="" />
														</div>
														<!--end::Input-->
													</div>
													<div class="col-xl-6">
														<!--begin::Input-->
														<div class="form-group">
															<label>นามสกุล</label>
															<input type="text" class="form-control receipt-control" id="receipt_lastname" name="receipt_lastname" placeholder="" value="" />
														</div>
														<!--end::Input-->
													</div>
												</div>

												<div class="row">
													<div class="col-xl-6">
														<!--begin::Input-->
														<div class="form-group">
															<label>เลขประจำตัวประชาชน</label>
															<input type="text" class="form-control receipt-control" id="receipt_idcardno" name="receipt_idcardno" placeholder="" value="" />
														</div>
														<!--end::Input-->
													</div>
													<div class="col-xl-6">
														<!--begin::Input-->
														<div class="form-group">
															<label>เบอร์โทรศัพท์มือถือ</label>
															<input type="text" class="form-control receipt-control" id="receipt_mobile" name="receipt_mobile" placeholder="" value="" />
														</div>
														<!--end::Input-->
													</div>
												</div>

												<!--begin::Input-->
												<div class="form-group">
													<label>รายนามผู้บริจาคร่วม</label>
													<textarea name="doner_list" id="doner_list" cols="30" rows="5" class="form-control receipt-control"></textarea>
												</div>
												<!--end::Input-->

												<!--begin::Input-->
												<div class="form-group">
													<label>ที่อยู่สำหรับระบุบนใบเสร็จ</label>
													<textarea name="receipt_address" id="receipt_address" cols="30" rows="3" class="form-control receipt-control"></textarea>
												</div>
												<!--end::Input-->

												<!--begin::Input-->
												<div class="form-group">
													<label>ที่อยู่สำหรับจัดส่งใบเสร็จ</label>
													<span class="checkbox-single ml-3">
														<label class="checkbox">
															<input type="checkbox" name="same_address" id="same_address" /> ใช้ที่อยู่เดียวกับที่ระบุในใบเสร็จ
															<span></span>
														</label>
													</span>
													<textarea name="delivery_address" id="delivery_address" cols="30" rows="3" class="form-control receipt-control"></textarea>
												</div>
												<!--end::Input-->
											</div>

										</div>
										<!--end: Wizard Step 1-->


										<!--begin: Wizard Actions-->
										<div class="d-flex justify-content-end border-top mt-5 pt-10">
												<!-- <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> -->

												<button type="submit" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" >บันทึก</button>
										</div>
										<!--end: Wizard Actions-->
									</form>
									<!--end: Wizard Form-->
								</div>
							</div>

					</div>
				</div>
			</div>
			<!--end::Container-->
		</div>
		<!--end::Entry-->
