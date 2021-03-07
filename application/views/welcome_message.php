					<?php
					$pesertadidik = $this->db->get_where('siswa', ["siswa_status" => 1])->num_rows();
					$kelas = $this->db->get('ms_kelas')->num_rows();
					$kompetensikeahlian = $this->db->get('ms_jurusan')->num_rows();

					$this->db->select('
										A.kelas_nama, 
										COUNT(siswa_nama) as total_siswa,
										COUNT(case when c.siswa_jeniskelamin="L" then 1 end) as jumlah_laki_laki,
										COUNT(case when c.siswa_jeniskelamin="P" then 1 end) as jumlah_perempuan
									');
					$this->db->join('kelas_siswa AS B', 'A.kelas_id = B.kelas_id');
					$this->db->join('siswa AS C', 'B.siswa_id = C.siswa_id');
					$this->db->where('C.siswa_status', 1);
					$this->db->group_by("A.kelas_nama");
					$rekapsiswa = $this->db->get('ms_kelas AS A');
					?>
					<div class="alert bg-success alert-icon-left alert-dismissible mb-2" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Login Berhasil!</strong> Selamat Datang Di Website Sistem Informasi Sekolah.
					</div>
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
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
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
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
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
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
						<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Total Siswa Aktif</h4>
								</div>
								<div class="card-content">
										<?php if ($this->session->userdata('user_type') == 2) : ?>
											<div class="card-body">
												<div class="alert alert-icon-right alert-warning alert-dismissible mb-2" role="alert">
													<strong>Pastikan Biodata Sudah Terupdate !</strong>
													<br>
													Biodata Akan Digunakan Untuk Raport dan Ijazah
												</div>
											</div>
										<?php else : ?>
											<div id="goal-list-scroll" class="table-responsive height-350 position-relative ps-container ps-theme-default ps-active-y" data-ps-id="830695da-1ee6-fecd-7a49-c4f2fbcc3561">
												<table class="table table-hover mb-0">
													<thead>
													<tr>
														<th>Rombel</th>
														<th>L</th>
														<th>P</th>
														<th>Total</th>
													</tr>
													</thead>
													<tbody>
													<?php
															foreach ($rekapsiswa->result() as $row)
															{
																	echo "<tr>";
																	echo "<td>".$row->kelas_nama."</td>";
																	echo "<td>".$row->jumlah_laki_laki."</td>";
																	echo "<td>".$row->jumlah_perempuan."</td>";
																	echo "<td>".$row->total_siswa."</td>";
																	echo "</tr>";
															}
														?>
													</tbody>
												</table>
											</div>
										<?php endif; ?>
									
								</div>
							</div>
						</div>
					</div>
