					<div class="row match-height">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title"><?php echo $namepage; ?></h4>
								</div>
								<div class="card-content">
									<div class="card-body">
										<form class="form" method="POST" action="<?php echo base_url('auth/update'); ?>" id="form_akun" novalidate>
											<div class="form-body">
												<?php if ($this->session->flashdata('success')) : ?>
													<div class="alert alert-success" role="alert">
														<?php echo $this->session->flashdata('success'); ?>
													</div>
												<?php endif; ?>
												<?php if ($this->session->flashdata('msg_error')) : ?>
													<div class="alert alert-icon-right alert-warning alert-dismissible mb-2" role="alert">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
														<strong>Update Gagal! </strong><?php echo $this->session->flashdata('msg_error'); ?>
													</div>
												<?php endif; ?>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_email">Nama Lengkap</label>
														<div class="col-md-9 controls">
															<input type="hidden" name="user_id" />
															<input type="text" id="user_email" class="form-control" placeholder="Nama Lengkap" name="user_email" value="<?php echo $this->session->userdata('user_email'); ?>" required data-validation-required-message="Nama Lengkap Wajib Diisi" readonly>
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_nama">User</label>
														<div class="col-md-9 controls">
															<input type="text" id="user_nama" class="form-control" placeholder="User" name="user_nama" value="<?php echo $this->session->userdata('user_nama'); ?>" required data-validation-required-message="User Wajib Diisi" readonly>
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_password">Password Lama</label>
														<div class="col-md-9 controls">
															<input type="text" id="user_password" class="form-control" placeholder="Password Lama" name="user_password" value="" required data-validation-required-message="Password Wajib Diisi">
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="password_baru">Password Baru</label>
														<div class="col-md-9 controls">
															<input type="text" id="password_baru" class="form-control" placeholder="Password Baru" name="password_baru" value="" required data-validation-required-message="Password Wajib Diisi">
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="password_konfirmasi">Konfirmasi Password Baru </label>
														<div class="col-md-9 controls">
															<input type="text" id="password_konfirmasi" class="form-control" placeholder="Konfirmasi Password Baru" name="password_konfirmasi" value="" required data-validation-matches-match="password_baru" data-validation-matches-message="Password Harus Sama Dengan Password Baru" data-validation-required-message="Password Wajib Diisi">
														</div>
													</div>
												</div>
											</div>
											<button type="submit" class="btn bg-blue bg-accent-3 white">Simpan</button>
										</form>
									</div>
								</div>
							</div>
						</div>
