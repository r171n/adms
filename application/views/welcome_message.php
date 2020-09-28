					<?php if ($this->session->userdata('user_type') == 2) : ?>
						<div class="alert bg-success alert-icon-left alert-dismissible mb-2" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<strong>Login Berhasil!</strong> Selamat Datang Di Website Sistem Informasi Sekolah.
						</div>
					<?php endif; ?>
					<div class="row match-height">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title"><?php echo $namepage; ?></h4>
								</div>
								<div class="card-content">
									<div class="card-body">
										<?php if ($this->session->userdata('user_type') == 2) : ?>
											<div class="alert alert-icon-right alert-warning alert-dismissible mb-2" role="alert">
												<strong>Pastikan Biodata Sudah Terupdate !</strong>
												<br>
												Biodata Akan Digunakan Untuk Raport dan Ijazah
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
