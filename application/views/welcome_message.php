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
						<div class="col-xl-4 col-lg-4 col-12">
							<div class="card">
								<div class="card-content">
									<div class="media align-items-stretch">
										<div class="p-2 text-center bg-success bg-darken-2">
											<i class="ft-user font-large-2 white"></i>
										</div>
										<div class="p-2 bg-gradient-x-success white media-body">
											<h5>Peserta Didik</h5>
											<h5 class="text-bold-400 mb-0"><?php echo $pesertadidik ?></h5>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-12">
							<div class="card">
								<div class="card-content">
									<div class="media align-items-stretch">
										<div class="p-2 text-center bg-danger bg-darken-2">
											<i class="ft-package font-large-2 white"></i>
										</div>
										<div class="p-2 bg-gradient-x-danger white media-body">
											<h5>Rombel</h5>
											<h5 class="text-bold-400 mb-0"><?php echo $kelas ?></h5>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-12">
							<div class="card">
								<div class="card-content">
									<div class="media align-items-stretch">
										<div class="p-2 text-center bg-warning bg-darken-2">
											<i class="ft-inbox font-large-2 white"></i>
										</div>
										<div class="p-2 bg-gradient-x-warning white media-body">
											<h5>Kompetensi Keahlian</h5>
											<h5 class="text-bold-400 mb-0"> <?php echo $kompetensikeahlian ?></h5>
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
