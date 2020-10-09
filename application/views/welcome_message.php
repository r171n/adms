					<?php
					$pesertadidik = $this->db->get_where('siswa', ["siswa_status" => 1])->num_rows();
					$kelas = $this->db->get('ms_kelas')->num_rows();
					$kompetensikeahlian = $this->db->get('ms_jurusan')->num_rows();
					?>
					<div class="alert bg-success alert-icon-left alert-dismissible mb-2" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Login Berhasil!</strong> Selamat Datang Di Website Sistem Informasi Sekolah.
					</div>
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="card">
								<div class="card-content">
									<div class="card-body bg-gradient-x-blue">
										<div class="media">
											<div class="media-body text-left w-100">
												<h3 class="white"><?php echo $pesertadidik ?></h3>
												<span class="white">Siswa</span>
											</div>
											<div class="media-right media-middle">
												<i class="ft-user white font-large-2 float-right"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="card">
								<div class="card-content">
									<div class="card-body bg-gradient-x-primary">
										<div class="media">
											<div class="media-body text-left w-100">
												<h3 class="white"><?php echo $kelas ?></h3>
												<span class="white">Rombel</span>
											</div>
											<div class="media-right media-middle">
												<i class="ft-package white font-large-2 float-right"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="card">
								<div class="card-content">
									<div class="card-body bg-gradient-x-warning">
										<div class="media">
											<div class="media-body text-left w-100">
												<h3 class="white"><?php echo $kompetensikeahlian ?></h3>
												<span class="white">Jurusan</span>
											</div>
											<div class="media-right media-middle">
												<i class="ft-inbox white font-large-2 float-right"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
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
