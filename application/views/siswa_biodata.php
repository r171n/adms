<div class="row match-height">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><?php echo $namepage; ?></h4>
				<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-content">
				<div class="card-body">
					<form class="form">
						<div class="form-body">
							<h4 class="form-section"><i class="ft-user"></i> Data Pribadi</h4>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_nama">Nama Lengkap</label>
										<div class="col-md-9">
											<input type="text" id="siswa_nama" class="form-control" placeholder="Nama Lengkap" name="siswa_nama" required>
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
													<input type="radio" name="siswa_jeniskelamin" class="custom-control-input" id="Laki-Laki">
													<label class="custom-control-label" for="Laki-Laki">Laki-Laki</label>
												</div>
												<div class="d-inline-block custom-control custom-radio">
													<input type="radio" name="siswa_jeniskelamin" class="custom-control-input" id="Perempuan">
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
											<input type="number" onKeyPress="if(this.value.length==10) return false;" id="siswa_nisn" class="form-control" placeholder="NISN" name="siswa_nisn" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_nik">NIK</label>
										<div class="col-md-9">
											<input type="number" onKeyPress="if(this.value.length==16) return false;" id="siswa_nik" class="form-control" placeholder="NIK" name="siswa_nik" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kk">No Kartu Keluarga</label>
										<div class="col-md-9">
											<input type="number" onKeyPress="if(this.value.length==16) return false;" id="siswa_kk" class="form-control" placeholder="No KK" name="siswa_kk">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_tempatlahir">Tempat Lahir</label>
										<div class="col-md-9">
											<input type="text" id="siswa_tempatlahir" class="form-control" placeholder="Tempat Lahir" name="siswa_tempatlahir" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_tanggallahir">Tanggal Lahir</label>
										<div class="col-md-9">
											<input type="text" id="siswa_tanggallahir" class="form-control" placeholder="Tanggal Lahir" name="siswa_tanggallahir" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_aktalahir">No Registrasi Akta Lahir</label>
										<div class="col-md-9">
											<input type="text" id="siswa_aktalahir" class="form-control" placeholder="No Registrasi Akta Lahir" name="siswa_aktalahir">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_agama">Agama</label>
										<div class="col-md-9">
											<fieldset class="form-group">
												<select class="form-control" id="siswa_agama">
													<option>Pilih</option>
													<?php foreach ($agama->result() as $agama) : ?>
														<option value="<?php echo $agama->agama_id ?>"><?php echo $agama->agama_keterangan ?></option>
													<?php endforeach; ?>
												</select>
											</fieldset>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_alamat">Alamat Jalan</label>
										<div class="col-md-9">
											<input type="text" id="siswa_alamat" class="form-control" placeholder="Alamat Jalan" name="siswa_alamat" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_rt">RT</label>
										<div class="col-md-9">
											<input type="text" id="siswa_rt" class="form-control" placeholder="RT" name="siswa_rt">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_rw">RW</label>
										<div class="col-md-9">
											<input type="text" id="siswa_rw" class="form-control" placeholder="RW" name="siswa_rw">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kelurahan">Desa/Kelurahan</label>
										<div class="col-md-9">
											<input type="text" id="siswa_kelurahan" class="form-control" placeholder="Desa/Kelurahan" name="siswa_kelurahan">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kelurahan">Kecamatan</label>
										<div class="col-md-9">
											<input type="text" id="siswa_kelurahan" class="form-control" placeholder="Kecamatan" name="siswa_kelurahan">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kabupaten">Kabupaten/Kota</label>
										<div class="col-md-9">
											<input type="text" id="siswa_kabupaten" class="form-control" placeholder="Kabupaten/Kota" name="siswa_kabupaten">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_provinsi">Provinsi</label>
										<div class="col-md-9">
											<input type="text" id="siswa_provinsi" class="form-control" placeholder="Provinsi" name="siswa_provinsi">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_kodepos">Kode POS</label>
										<div class="col-md-9">
											<input type="number" id="siswa_kodepos" class="form-control" placeholder="Kode POS" name="siswa_kodepos">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_jenistinggal">Tempat Tinggal</label>
										<div class="col-md-9">
											<fieldset class="form-group">
												<select class="form-control" id="siswa_jenistinggal">
													<option>Pilih</option>
													<?php foreach ($tempattinggal->result() as $tempattinggal) : ?>
														<option value="<?php echo $tempattinggal->tempattinggal_id ?>"><?php echo $tempattinggal->tempattinggal_keterangan ?></option>
													<?php endforeach; ?>
												</select>
											</fieldset>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_jenistinggal">Moda Transportasi</label>
										<div class="col-md-9">
											<fieldset class="form-group">
												<select class="form-control" id="siswa_jenistinggal">
													<option>Pilih</option>
													<?php foreach ($transportasi->result() as $transportasi) : ?>
														<option value="<?php echo $transportasi->transportasi_id ?>"><?php echo $transportasi->transportasi_keterangan ?></option>
													<?php endforeach; ?>
												</select>
											</fieldset>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group row">
										<label class="col-md-3 label-control" for="siswa_anakke">Anak Ke-Berapa (Berdasarkan KK)</label>
										<div class="col-md-9">
											<input type="number" id="siswa_anakke" class="form-control" placeholder="Anak Ke-Berapa" name="siswa_anakke" required>
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
													<input type="radio" name="siswa_kps" class="custom-control-input" value="YA" id="kps_ya">
													<label class="custom-control-label" for="kps_ya">YA</label>
												</div>
												<div class="d-inline-block custom-control custom-radio">
													<input type="radio" name="siswa_kps" class="custom-control-input" value="TIDAK" id="kps_tidak" checked>
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
											<input type="text" id="siswa_nokps" class="form-control" placeholder="NO KPS/PKH" name="siswa_nokps" readonly>
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
													<input type="radio" name="siswa_kip" class="custom-control-input" value="YA" id="kip_ya">
													<label class="custom-control-label" for="kip_ya">YA</label>
												</div>
												<div class="d-inline-block custom-control custom-radio">
													<input type="radio" name="siswa_kip" class="custom-control-input" value="TIDAK" id="kip_tidak" checked>
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
										<input type="text" id="siswa_nokip" class="form-control" placeholder="NO KIP" name="siswa_nokip" readonly>
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
										<input type="number" onKeyPress="if(this.value.length==12) return false;" id="siswa_notelp" class="form-control" placeholder="NO HP Siswa" name="siswa_notelp">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="siswa_email">Email Aktif</label>
									<div class="col-md-9">
										<input type="email" id="siswa_email" class="form-control" placeholder="Email Yang Aktif" name="siswa_email">
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<button type="button" class="btn btn-warning mr-1">
								<i class="ft-x"></i> Cancel
							</button>
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-check-square-o"></i> Save
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
