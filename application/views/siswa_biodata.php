<div class="row match-height">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><?php echo $namepage; ?></h4>
			</div>
			<div class="card-content">
				<div class="card-body">
					<form class="form" method="post" action="<?php echo base_url(); ?>siswa/biodatasave">
						<div class="form-body">
							<?php if ($this->session->flashdata('success')) : ?>
								<div class="alert alert-success" role="alert">
									<?php echo $this->session->flashdata('success'); ?>
								</div>
							<?php endif; ?>
							<?php if ($this->session->flashdata('error')) : ?>
								<div class="alert alert-warning" role="alert">
									<?php echo $this->session->flashdata('error'); ?>
								</div>
							<?php endif; ?>
							<?php if ($this->session->userdata('user_type') == 2) : ?>
								<div class="">
									<strong>Silahkan Lengkapi Biodata Dibawah Ini!</strong>
									<br>
									Isian Biodata menjadi tanggung jawab siswa masing masing.
								</div>
							<?php endif; ?>
							<h4 class="form-section"><i class="ft-user"></i> Data Pribadi</h4>
							<?php
							$cekdata = $siswa->num_rows();
							if ($cekdata == 1) {
								$datasiswa = $siswa->row();
							}
							?>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_nama">Nama Lengkap</label>
										<div class="col-md-9">
											<input type="text" id="siswa_nama" class="form-control" placeholder="Nama Lengkap" name="siswa_nama" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_nama; ?>" required>
											<p class="text-right">
												<small class="warning text-muted">Nama Lengkap Harus Sesuai Dengan Ijazah SMP/SD</small>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_jeniskelamin">Jenis Kelamin</label>
										<div class="col-md-9">
											<div class="input-group">
												<div class="d-inline-block custom-control custom-radio mr-1">
													<input type="radio" name="siswa_jeniskelamin" class="custom-control-input" value="Laki-Laki" id="Laki-Laki" <?php if ($cekdata == 1) if ($datasiswa->siswa_jeniskelamin == "L") echo "checked"; ?>>
													<label class="custom-control-label" for="Laki-Laki">Laki-Laki</label>
												</div>
												<div class="d-inline-block custom-control custom-radio">
													<input type="radio" name="siswa_jeniskelamin" class="custom-control-input" value="Perempuan" id="Perempuan" <?php if ($cekdata == 1) if ($datasiswa->siswa_jeniskelamin == "P") echo "checked"; ?>>
													<label class="custom-control-label" for="Perempuan">Perempuan</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_nisn">NISN</label>
										<div class="col-md-9">
											<input type="number" onKeyPress="if(this.value.length==10) return false;" id="siswa_nisn" class="form-control" placeholder="NISN" name="siswa_nisn" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_nisn; ?>" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_nik">NIK</label>
										<div class="col-md-9">
											<input type="number" onKeyPress="if(this.value.length==16) return false;" id="siswa_nik" class="form-control" placeholder="NIK" name="siswa_nik" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_nik; ?>" required>
											<p class="text-right">
												<small class="warning text-muted">NIK Harus Sesuai Dengan Kartu Keluarga</small>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kk">No Kartu Keluarga</label>
										<div class="col-md-9">
											<input type="number" onKeyPress="if(this.value.length==16) return false;" id="siswa_kk" class="form-control" placeholder="No KK" name="siswa_kk" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_kk; ?>">
											<p class="text-right">
												<small class="warning text-muted">No Kartu Keluarga Harus Sesuai Dengan Kartu Keluarga</small>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_tempatlahir">Tempat Lahir</label>
										<div class="col-md-9">
											<input type="text" id="siswa_tempatlahir" class="form-control" placeholder="Tempat Lahir" name="siswa_tempatlahir" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_tempatlahir; ?>" required>
											<p class="text-right">
												<small class="warning text-muted">Tempat Lahir Harus Sesuai Dengan Ijazah SMP/SD</small>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_tanggallahir">Tanggal Lahir</label>
										<div class="col-md-9">
											<input type="text" id="siswa_tanggallahir" class="form-control" placeholder="Tanggal Lahir" name="siswa_tanggallahir" value="<?php if ($cekdata == 1) echo date("d-m-Y", strtotime($datasiswa->siswa_tanggallahir)); ?>" required>
											<p class="text-right">
												<small class="warning text-muted">Tanggal Lahir Harus Sesuai Dengan Ijazah SMP/SD</small>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_aktalahir">No Registrasi Akta Lahir</label>
										<div class="col-md-9">
											<input type="text" id="siswa_aktalahir" class="form-control" placeholder="No Registrasi Akta Lahir" name="siswa_aktalahir" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_aktalahir; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_agama">Agama</label>
										<div class="col-md-9">
											<select class="form-control" id="siswa_agama" name="siswa_agama">
												<option>Pilih</option>
												<?php foreach ($agama->result() as $agama) : ?>
													<option value="<?php echo $agama->agama_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_agama == $agama->agama_id) echo "selected"; ?>><?php echo $agama->agama_keterangan ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_alamat">Alamat Jalan</label>
										<div class="col-md-9">
											<input type="text" id="siswa_alamat" class="form-control" placeholder="Alamat Jalan" name="siswa_alamat" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_alamat; ?>" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_rt">RT</label>
										<div class="col-md-9">
											<input type="text" id="siswa_rt" class="form-control" placeholder="RT" name="siswa_rt" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_rt; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_rw">RW</label>
										<div class="col-md-9">
											<input type="text" id="siswa_rw" class="form-control" placeholder="RW" name="siswa_rw" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_rw; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kelurahan">Desa/Kelurahan</label>
										<div class="col-md-9">
											<input type="text" id="siswa_kelurahan" class="form-control" placeholder="Desa/Kelurahan" name="siswa_kelurahan" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_kelurahan; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kecamatan">Kecamatan</label>
										<div class="col-md-9">
											<input type="text" id="siswa_kecamatan" class="form-control" placeholder="Kecamatan" name="siswa_kecamatan" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_kecamatan; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kabupaten">Kabupaten/Kota</label>
										<div class="col-md-9">
											<input type="text" id="siswa_kabupaten" class="form-control" placeholder="Kabupaten/Kota" name="siswa_kabupaten" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_kabupaten; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_provinsi">Provinsi</label>
										<div class="col-md-9">
											<input type="text" id="siswa_provinsi" class="form-control" placeholder="Provinsi" name="siswa_provinsi" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_provinsi; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kodepos">Kode POS</label>
										<div class="col-md-9">
											<input type="number" id="siswa_kodepos" class="form-control" placeholder="Kode POS" name="siswa_kodepos" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_kodepos; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_jenistinggal">Tempat Tinggal</label>
										<div class="col-md-9">
											<select class="form-control" id="siswa_jenistinggal" name="siswa_jenistinggal">
												<option>Pilih</option>
												<?php foreach ($tempattinggal->result() as $tempattinggal) : ?>
													<option value="<?php echo $tempattinggal->tempattinggal_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_jenistinggal == $tempattinggal->tempattinggal_id) echo "selected"; ?>><?php echo $tempattinggal->tempattinggal_keterangan ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_alattransport">Moda Transportasi</label>
										<div class="col-md-9">
											<select class="form-control" id="siswa_alattransport" name="siswa_alattransport">
												<?php foreach ($transportasi->result() as $transportasi) : ?>
													<option value="<?php echo $transportasi->transportasi_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_alattransport == $transportasi->transportasi_id) echo "selected"; ?>><?php echo $transportasi->transportasi_keterangan ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_anakke">Anak Ke-Berapa (Berdasarkan KK)</label>
										<div class="col-md-9">
											<input type="number" id="siswa_anakke" class="form-control" placeholder="Anak Ke-Berapa" name="siswa_anakke" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_anakke; ?>" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kps">Penerima KPS/PKH</label>
										<div class="col-md-9">
											<div class="input-group">
												<div class="d-inline-block custom-control custom-radio mr-1">
													<input type="radio" name="siswa_kps" class="custom-control-input" value="YA" id="kps_ya" <?php if ($cekdata == 1) if ($datasiswa->siswa_kps == "YA") echo "checked"; ?>>
													<label class="custom-control-label" for="kps_ya">YA</label>
												</div>
												<div class="d-inline-block custom-control custom-radio">
													<input type="radio" name="siswa_kps" class="custom-control-input" value="TIDAK" id="kps_tidak" <?php if ($cekdata == 1) if ($datasiswa->siswa_kps == "TIDAK") echo "checked"; ?>>
													<label class="custom-control-label" for="kps_tidak">TIDAK</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_nokps">NO KPS/PKH</label>
										<div class="col-md-9">
											<input type="text" id="siswa_nokps" class="form-control" placeholder="NO KPS/PKH" name="siswa_nokps" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_nokps; ?>" readonly>
											<p class="text-right">
												<small class="warning text-muted">Jika Ada PKH, Isi No Dengan Benar</small>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kip">Penerima KIP</label>
										<div class="col-md-9">
											<div class="input-group">
												<div class="d-inline-block custom-control custom-radio mr-1">
													<input type="radio" name="siswa_kip" class="custom-control-input" value="YA" id="kip_ya" <?php if ($cekdata == 1) if ($datasiswa->siswa_kip == "YA") echo "checked"; ?>>
													<label class="custom-control-label" for="kip_ya">YA</label>
												</div>
												<div class="d-inline-block custom-control custom-radio">
													<input type="radio" name="siswa_kip" class="custom-control-input" value="TIDAK" id="kip_tidak" <?php if ($cekdata == 1) if ($datasiswa->siswa_kip == "TIDAK") echo "checked"; ?>>
													<label class="custom-control-label" for="kip_tidak">TIDAK</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_nokip">NO KIP</label>
									<div class="col-md-9">
										<input type="text" id="siswa_nokip" class="form-control" placeholder="NO KIP" name="siswa_nokip" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_nokip; ?>" readonly>
										<p class="text-right">
											<small class="warning text-muted">Jika Ada KIP, Isi No Dengan Benar</small>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_asalsekolah">Asal Sekolah</label>
									<div class="col-md-9">
										<input type="text" id="siswa_asalsekolah" class="form-control" placeholder="Asal Sekolah" name="siswa_asalsekolah" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_asalsekolah; ?>" required>
									</div>
								</div>
							</div>
						</div>
						<h4 class="form-section"><i class="ft-phone"></i> Kontak</h4>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_notelp">NO HP</label>
									<div class="col-md-9">
										<input type="number" onKeyPress="if(this.value.length==12) return false;" id="siswa_notelp" class="form-control" placeholder="NO HP Siswa" name="siswa_notelp" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_notelp; ?>">
										<p class="text-right">
											<small class="warning text-muted">NO HP Aktif</small>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_email">Email Aktif</label>
									<div class="col-md-9">
										<input type="email" id="siswa_email" class="form-control" placeholder="Email Yang Aktif" name="siswa_email" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_email; ?>">
										<p class="text-right">
											<small class="warning text-muted">Email Harus Aktif</small>
										</p>
									</div>
								</div>
							</div>
						</div>
						<h4 class="form-section"><i class="ft-user"></i> Data Ayah</h4>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_nama_ayah">Nama</label>
									<div class="col-md-9">
										<input type="text" id="siswa_nama_ayah" class="form-control" placeholder="Nama Ayah" name="siswa_nama_ayah" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_nama_ayah; ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_nik_ayah">NIK Ayah</label>
									<div class="col-md-9">
										<input type="number" onKeyPress="if(this.value.length==16) return false;" id=" siswa_nik_ayah" class="form-control" placeholder="NIK Ayah" name="siswa_nik_ayah" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_nik_ayah; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_tahunlahir_ayah">Tahun Lahir</label>
									<div class="col-md-9">
										<input type="number" onKeyPress="if(this.value.length==4) return false;" id="siswa_tahunlahir_ayah" class="form-control" placeholder="Tahun Lahir" name="siswa_tahunlahir_ayah" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_tahunlahir_ayah; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_pendidikan_ayah">Pendidikan</label>
									<div class="col-md-9">
										<select class="form-control" id="siswa_pendidikan_ayah" name="siswa_pendidikan_ayah">
											<?php foreach ($pendidikan->result() as $pendidikan_ayah) : ?>
												<option value="<?php echo $pendidikan_ayah->pendidikan_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_pendidikan_ayah == $pendidikan_ayah->pendidikan_id) echo "selected"; ?>><?php echo $pendidikan_ayah->pendidikan_nama ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_pekerjaan_ayah">Pekerjaan</label>
									<div class="col-md-9">
										<select class="form-control" id="siswa_pekerjaan_ayah" name="siswa_pekerjaan_ayah">
											<?php foreach ($pekerjaan->result() as $pekerjaan_ayah) : ?>
												<option value="<?php echo $pekerjaan_ayah->pekerjaan_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_pekerjaan_ayah == $pekerjaan_ayah->pekerjaan_id)  echo "selected"; ?>><?php echo $pekerjaan_ayah->pekerjaan_keterangan ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_penghasilan_ayah">Penghasilan</label>
									<div class="col-md-9">
										<select class="form-control" id="siswa_penghasilan_ayah" name="siswa_penghasilan_ayah">
											<?php foreach ($penghasilan->result() as $penghasilan_ayah) : ?>
												<option value="<?php echo $penghasilan_ayah->penghasilan_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_penghasilan_ayah == $penghasilan_ayah->penghasilan_id)  echo "selected"; ?>><?php echo $penghasilan_ayah->penghasilan_keterangan ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<h4 class="form-section"><i class="ft-user"></i> Data Ibu Kandung</h4>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_nama_ibu">Nama</label>
									<div class="col-md-9">
										<input type="text" id="siswa_nama_ibu" class="form-control" placeholder="Nama Ibu" name="siswa_nama_ibu" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_nama_ibu; ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_nik_ibu">NIK Ibu</label>
									<div class="col-md-9">
										<input type="number" onKeyPress="if(this.value.length==16) return false;" id=" siswa_nik_ibu" class="form-control" placeholder="NIK Ibu" name="siswa_nik_ibu" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_nik_ibu; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_tahunlahir_ibu">Tahun Lahir</label>
									<div class="col-md-9">
										<input type="number" onKeyPress="if(this.value.length==4) return false;" id="siswa_tahunlahir_ibu" class="form-control" placeholder="Tahun Lahir" name="siswa_tahunlahir_ibu" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_tahunlahir_ibu; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_pendidikan_ibu">Pendidikan</label>
									<div class="col-md-9">
										<select class="form-control" id="siswa_pendidikan_ibu" name="siswa_pendidikan_ibu">
											<?php foreach ($pendidikan->result() as $pendidikan_ibu) : ?>
												<option value="<?php echo $pendidikan_ibu->pendidikan_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_pendidikan_ibu == $pendidikan_ibu->pendidikan_id)  echo "selected"; ?>><?php echo $pendidikan_ibu->pendidikan_nama ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_pekerjaan_ibu">Pekerjaan</label>
									<div class="col-md-9">
										<select class="form-control" id="siswa_pekerjaan_ibu" name="siswa_pekerjaan_ibu">
											<?php foreach ($pekerjaan->result() as $pekerjaan_ibu) : ?>
												<option value="<?php echo $pekerjaan_ibu->pekerjaan_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_pekerjaan_ibu == $pekerjaan_ibu->pekerjaan_id)  echo "selected"; ?>><?php echo $pekerjaan_ibu->pekerjaan_keterangan ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_penghasilan_ibu">Penghasilan</label>
									<div class="col-md-9">
										<select class="form-control" id="siswa_penghasilan_ibu" name="siswa_penghasilan_ibu">
											<?php foreach ($penghasilan->result() as $penghasilan_ibu) : ?>
												<option value="<?php echo $penghasilan_ibu->penghasilan_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_penghasilan_ibu == $penghasilan_ibu->penghasilan_id)  echo "selected"; ?>><?php echo $penghasilan_ibu->penghasilan_keterangan ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<h4 class="form-section"><i class="ft-user"></i> Data Wali</h4>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_nama_wali">Nama</label>
									<div class="col-md-9">
										<input type="text" id="siswa_nama_wali" class="form-control" placeholder="Nama Wali" name="siswa_nama_wali" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_nama_wali; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_nik_wali">NIK Wali</label>
									<div class="col-md-9">
										<input type="number" onKeyPress="if(this.value.length==16) return false;" id=" siswa_nik_wali" class="form-control" placeholder="NIK Wali" name="siswa_nik_wali" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_nik_wali; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_tahunlahir_wali">Tahun Lahir</label>
									<div class="col-md-9">
										<input type="number" onKeyPress="if(this.value.length==4) return false;" id="siswa_tahunlahir_wali" class="form-control" placeholder="Tahun Lahir" name="siswa_tahunlahir_wali" value="<?php if ($cekdata == 1) echo $datasiswa->siswa_tahunlahir_wali; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_pendidikan_wali">Pendidikan</label>
									<div class="col-md-9">
										<select class="form-control" id="siswa_pendidikan_wali" name="siswa_pendidikan_wali">
											<?php foreach ($pendidikan->result() as $pendidikan_wali) : ?>
												<option value="<?php echo $pendidikan_wali->pendidikan_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_pendidikan_wali == $pendidikan_wali->pendidikan_id)  echo "selected"; ?>><?php echo $pendidikan_wali->pendidikan_nama ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_pekerjaan_wali">Pekerjaan</label>
									<div class="col-md-9">
										<select class="form-control" id="siswa_pekerjaan_wali" name="siswa_pekerjaan_wali">
											<?php foreach ($pekerjaan->result() as $pekerjaan_wali) : ?>
												<option value="<?php echo $pekerjaan_wali->pekerjaan_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_pekerjaan_wali == $pekerjaan_wali->pekerjaan_id)  echo "selected"; ?>><?php echo $pekerjaan_wali->pekerjaan_keterangan ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_penghasilan_wali">Penghasilan</label>
									<div class="col-md-9">
										<select class="form-control" id="siswa_penghasilan_wali" name="siswa_penghasilan_wali">
											<?php foreach ($penghasilan->result() as $penghasilan_wali) : ?>
												<option value="<?php echo $penghasilan_wali->penghasilan_id ?>" <?php if ($cekdata == 1) if ($datasiswa->siswa_penghasilan_wali == $penghasilan_wali->penghasilan_id)  echo "selected"; ?>><?php echo $penghasilan_wali->penghasilan_keterangan ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-check-square-o"></i> Simpan
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
