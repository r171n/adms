					<div class="row match-height">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">
										<?php echo $namepage; ?>
										<?php
										$walikelas = $this->db->get_where('ms_kelas', ["wali_user_id" => $this->session->userdata('user_id')]); //cek wali kelas
										if ($walikelas->num_rows() != 0) {
											echo "Kelas " . $walikelas->row()->kelas_nama;
										}
										?>
									</h4>
								</div>
								<div class="card-content">
									<div class="card-body">
										<?php 			$walikelas = $this->db->get_where('ms_kelas', ["wali_user_id" => $this->session->userdata('user_id')]); //cek wali kelas?>
										<?php if ($walikelas->num_rows() == 0) {?>
										<a class="btn btn-md bg-success bg-darken-4 white" href="javascript:void()" title="Biodata" onclick="tambah_siswa()"><i class="ft ft-plus"></i> Tamah Siswa</a>
										<?php }?>
										<a href="<?php echo base_url(); ?>kesiswaan/downloadbiodata" class=" btn btn-md bg-blue bg-darken-4 white"><i class="ft ft-download"></i> Download Data</a>
										<br>
										<br>
										<table class="table table-striped table-bordered zero-configuration dataTable" id="table" role="grid" aria-describedby="table" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th data-priority="1">Nama</th>
													<th data-priority="2">NIS</th>
													<th>NISN</th>
													<th>L/P</th>
													<th>Kelas</th>
													<th>Last Update</th>
													<th>Opsi</th>

												</tr>
											</thead>
											<tbody>
											</tbody>

											<tfoot>
												<tr>
													<th>No</th>
													<th data-priority="1">Nama</th>
													<th data-priority="2">NIS</th>
													<th>NISN</th>
													<th>L/P</th>
													<th>Kelas</th>
													<th>Last Update</th>
													<th>Opsi</th>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade text-left" data-backdrop="false" id="modal_siswa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel1">Basic Modal</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form class="form" action="#" id="form_siswa" novalidate>
											<div class="form-body">
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_nama">Nama Lengkap</label>
															<div class="col-md-9">
																<input type="hidden" id="siswa_id" class="form-control" placeholder="Nama Lengkap" name="siswa_id" value="">
																<input type="text" id="siswa_nama" class="form-control" placeholder="Nama Lengkap" name="siswa_nama" value="" required>
																<p class="text-right">
																	<small class="warning text-muted">Nama Lengkap Harus Sesuai Dengan Ijazah SMP/SD</small>
																</p>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_jeniskelamin">Jenis Kelamin</label>
															<div class="col-md-9">
																<div class="input-group">
																	<div class="d-inline-block custom-control custom-radio mr-1">
																		<input type="radio" name="siswa_jeniskelamin" class="custom-control-input" value="Laki-Laki" id="Laki-Laki">
																		<label class="custom-control-label" for="Laki-Laki">Laki-Laki</label>
																	</div>
																	<div class="d-inline-block custom-control custom-radio">
																		<input type="radio" name="siswa_jeniskelamin" class="custom-control-input" value="Perempuan" id="Perempuan">
																		<label class="custom-control-label" for="Perempuan">Perempuan</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_nisn">NISN</label>
															<div class="col-md-9">
																<input type="number" onKeyPress="if(this.value.length==10) return false;" id="siswa_nisn" class="form-control" placeholder="NISN" name="siswa_nisn" value="" required>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_nik">NIK</label>
															<div class="col-md-9">
																<input type="number" onKeyPress="if(this.value.length==16) return false;" id="siswa_nik" class="form-control" placeholder="NIK" name="siswa_nik" value="" required>
																<p class="text-right">
																	<small class="warning text-muted">NIK Harus Sesuai Dengan Kartu Keluarga</small>
																</p>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_kk">No Kartu Keluarga</label>
															<div class="col-md-9">
																<input type="number" onKeyPress="if(this.value.length==16) return false;" id="siswa_kk" class="form-control" placeholder="No KK" name="siswa_kk" value="">
																<p class="text-right">
																	<small class="warning text-muted">No Kartu Keluarga Harus Sesuai Dengan Kartu Keluarga</small>
																</p>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_tempatlahir">Tempat Lahir</label>
															<div class="col-md-9">
																<input type="text" id="siswa_tempatlahir" class="form-control" placeholder="Tempat Lahir" name="siswa_tempatlahir" value="" required>
																<p class="text-right">
																	<small class="warning text-muted">Tempat Lahir Harus Sesuai Dengan Ijazah SMP/SD</small>
																</p>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_tanggallahir">Tanggal Lahir</label>
															<div class="col-md-9">
																<input type="text" id="siswa_tanggallahir" class="form-control" placeholder="Tanggal Lahir" name="siswa_tanggallahir" value="" required>
																<p class="text-right">
																	<small class="warning text-muted">Tanggal Lahir Harus Sesuai Dengan Ijazah SMP/SD</small>
																</p>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_aktalahir">No Registrasi Akta Lahir</label>
															<div class="col-md-9">
																<input type="text" id="siswa_aktalahir" class="form-control" placeholder="No Registrasi Akta Lahir" name="siswa_aktalahir" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_agama">Agama</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_agama" name="siswa_agama">
																	<option value="0">Pilih</option>
																	<?php foreach ($agama->result() as $agama) : ?>
																		<option value="<?php echo $agama->agama_id ?>"><?php echo $agama->agama_keterangan ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_alamat">Alamat Jalan</label>
															<div class="col-md-9">
																<input type="text" id="siswa_alamat" class="form-control" placeholder="Alamat Jalan" name="siswa_alamat" value="" required>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_rt">RT</label>
															<div class="col-md-9">
																<input type="text" id="siswa_rt" class="form-control" placeholder="RT" name="siswa_rt" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_rw">RW</label>
															<div class="col-md-9">
																<input type="text" id="siswa_rw" class="form-control" placeholder="RW" name="siswa_rw" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_kelurahan">Desa/Kelurahan</label>
															<div class="col-md-9">
																<input type="text" id="siswa_kelurahan" class="form-control" placeholder="Desa/Kelurahan" name="siswa_kelurahan" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_kecamatan">Kecamatan</label>
															<div class="col-md-9">
																<input type="text" id="siswa_kecamatan" class="form-control" placeholder="Kecamatan" name="siswa_kecamatan" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_kabupaten">Kabupaten/Kota</label>
															<div class="col-md-9">
																<input type="text" id="siswa_kabupaten" class="form-control" placeholder="Kabupaten/Kota" name="siswa_kabupaten" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_provinsi">Provinsi</label>
															<div class="col-md-9">
																<input type="text" id="siswa_provinsi" class="form-control" placeholder="Provinsi" name="siswa_provinsi" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_kodepos">Kode POS</label>
															<div class="col-md-9">
																<input type="number" id="siswa_kodepos" class="form-control" placeholder="Kode POS" name="siswa_kodepos" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_jenistinggal">Tempat Tinggal</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_jenistinggal" name="siswa_jenistinggal">
																	<option value="0">Pilih</option>
																	<?php foreach ($tempattinggal->result() as $tempattinggal) : ?>
																		<option value="<?php echo $tempattinggal->tempattinggal_id ?>"><?php echo $tempattinggal->tempattinggal_keterangan ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_alattransport">Moda Transportasi</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_alattransport" name="siswa_alattransport">
																	<?php foreach ($transportasi->result() as $transportasi) : ?>
																		<option value="<?php echo $transportasi->transportasi_id ?>"><?php echo $transportasi->transportasi_keterangan ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_anakke">Anak Ke-Berapa (Berdasarkan KK)</label>
															<div class="col-md-9">
																<input type="number" id="siswa_anakke" class="form-control" placeholder="Anak Ke-Berapa" name="siswa_anakke" value="" required>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_kps">Penerima KPS/PKH</label>
															<div class="col-md-9">
																<div class="input-group">
																	<div class="d-inline-block custom-control custom-radio mr-1">
																		<input type="radio" name="siswa_kps" class="custom-control-input" value="YA" id="kps_ya">
																		<label class="custom-control-label" for="kps_ya">YA</label>
																	</div>
																	<div class="d-inline-block custom-control custom-radio">
																		<input type="radio" name="siswa_kps" class="custom-control-input" value="TIDAK" id="kps_tidak">
																		<label class="custom-control-label" for="kps_tidak">TIDAK</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_nokps">NO KPS/PKH</label>
															<div class="col-md-9">
																<input type="text" id="siswa_nokps" class="form-control" placeholder="NO KPS/PKH" name="siswa_nokps" value="" readonly>
																<p class="text-right">
																	<small class="warning text-muted">Jika Ada PKH, Isi No Dengan Benar</small>
																</p>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_kip">Penerima KIP</label>
															<div class="col-md-9">
																<div class="input-group">
																	<div class="d-inline-block custom-control custom-radio mr-1">
																		<input type="radio" name="siswa_kip" class="custom-control-input" value="YA" id="kip_ya">
																		<label class="custom-control-label" for="kip_ya">YA</label>
																	</div>
																	<div class="d-inline-block custom-control custom-radio">
																		<input type="radio" name="siswa_kip" class="custom-control-input" value="TIDAK" id="kip_tidak">
																		<label class="custom-control-label" for="kip_tidak">TIDAK</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_nokip">NO KIP</label>
															<div class="col-md-9">
																<input type="text" id="siswa_nokip" class="form-control" placeholder="NO KIP" name="siswa_nokip" value="" readonly>
																<p class="text-right">
																	<small class="warning text-muted">Jika Ada KIP, Isi No Dengan Benar</small>
																</p>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_asalsekolah">Asal Sekolah</label>
															<div class="col-md-9">
																<input type="text" id="siswa_asalsekolah" class="form-control" placeholder="Asal Sekolah" name="siswa_asalsekolah" value="" required>
															</div>
														</div>
													</div>
												</div>												
												<h4 class="form-section"><i class="ft-phone"></i> Kontak</h4>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_notelp">NO HP</label>
															<div class="col-md-9">
																<input type="number" onKeyPress="if(this.value.length==12) return false;" id="siswa_notelp" class="form-control" placeholder="NO HP Siswa" name="siswa_notelp" value="">
																<p class="text-right">
																	<small class="warning text-muted">NO HP Aktif</small>
																</p>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_email">Email Aktif</label>
															<div class="col-md-9">
																<input type="email" id="siswa_email" class="form-control" placeholder="Email Yang Aktif" name="siswa_email" value="">
																<p class="text-right">
																	<small class="warning text-muted">Email Harus Aktif</small>
																</p>
															</div>
														</div>
													</div>
												</div>
												<h4 class="form-section"><i class="ft-user"></i> Data Ayah</h4>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_nama_ayah">Nama</label>
															<div class="col-md-9">
																<input type="text" id="siswa_nama_ayah" class="form-control" placeholder="Nama Ayah" name="siswa_nama_ayah" value="" required>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_nik_ayah">NIK Ayah</label>
															<div class="col-md-9">
																<input type="number" onKeyPress="if(this.value.length==16) return false;" id=" siswa_nik_ayah" class="form-control" placeholder="NIK Ayah" name="siswa_nik_ayah" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_tahunlahir_ayah">Tahun Lahir</label>
															<div class="col-md-9">
																<input type="number" onKeyPress="if(this.value.length==4) return false;" id="siswa_tahunlahir_ayah" class="form-control" placeholder="Tahun Lahir" name="siswa_tahunlahir_ayah" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_pendidikan_ayah">Pendidikan</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_pendidikan_ayah" name="siswa_pendidikan_ayah">
																	<?php foreach ($pendidikan->result() as $pendidikan_ayah) : ?>
																		<option value="<?php echo $pendidikan_ayah->pendidikan_id ?>"><?php echo $pendidikan_ayah->pendidikan_nama ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_pekerjaan_ayah">Pekerjaan</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_pekerjaan_ayah" name="siswa_pekerjaan_ayah">
																	<?php foreach ($pekerjaan->result() as $pekerjaan_ayah) : ?>
																		<option value="<?php echo $pekerjaan_ayah->pekerjaan_id ?>"><?php echo $pekerjaan_ayah->pekerjaan_keterangan ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_penghasilan_ayah">Penghasilan</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_penghasilan_ayah" name="siswa_penghasilan_ayah">
																	<?php foreach ($penghasilan->result() as $penghasilan_ayah) : ?>
																		<option value="<?php echo $penghasilan_ayah->penghasilan_id ?>"><?php echo $penghasilan_ayah->penghasilan_keterangan ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<h4 class="form-section"><i class="ft-user"></i> Data Ibu Kandung</h4>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_nama_ibu">Nama</label>
															<div class="col-md-9">
																<input type="text" id="siswa_nama_ibu" class="form-control" placeholder="Nama Ibu" name="siswa_nama_ibu" value="" required>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_nik_ibu">NIK Ibu</label>
															<div class="col-md-9">
																<input type="number" onKeyPress="if(this.value.length==16) return false;" id=" siswa_nik_ibu" class="form-control" placeholder="NIK Ibu" name="siswa_nik_ibu" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_tahunlahir_ibu">Tahun Lahir</label>
															<div class="col-md-9">
																<input type="number" onKeyPress="if(this.value.length==4) return false;" id="siswa_tahunlahir_ibu" class="form-control" placeholder="Tahun Lahir" name="siswa_tahunlahir_ibu" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_pendidikan_ibu">Pendidikan</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_pendidikan_ibu" name="siswa_pendidikan_ibu">
																	<?php foreach ($pendidikan->result() as $pendidikan_ibu) : ?>
																		<option value="<?php echo $pendidikan_ibu->pendidikan_id ?>"><?php echo $pendidikan_ibu->pendidikan_nama ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_pekerjaan_ibu">Pekerjaan</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_pekerjaan_ibu" name="siswa_pekerjaan_ibu">
																	<?php foreach ($pekerjaan->result() as $pekerjaan_ibu) : ?>
																		<option value="<?php echo $pekerjaan_ibu->pekerjaan_id ?>"><?php echo $pekerjaan_ibu->pekerjaan_keterangan ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_penghasilan_ibu">Penghasilan</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_penghasilan_ibu" name="siswa_penghasilan_ibu">
																	<?php foreach ($penghasilan->result() as $penghasilan_ibu) : ?>
																		<option value="<?php echo $penghasilan_ibu->penghasilan_id ?>"><?php echo $penghasilan_ibu->penghasilan_keterangan ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<h4 class="form-section"><i class="ft-user"></i> Data Wali</h4>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_nama_wali">Nama</label>
															<div class="col-md-9">
																<input type="text" id="siswa_nama_wali" class="form-control" placeholder="Nama Wali" name="siswa_nama_wali" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_nik_wali">NIK Wali</label>
															<div class="col-md-9">
																<input type="number" onKeyPress="if(this.value.length==16) return false;" id=" siswa_nik_wali" class="form-control" placeholder="NIK Wali" name="siswa_nik_wali" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_tahunlahir_wali">Tahun Lahir</label>
															<div class="col-md-9">
																<input type="number" onKeyPress="if(this.value.length==4) return false;" id="siswa_tahunlahir_wali" class="form-control" placeholder="Tahun Lahir" name="siswa_tahunlahir_wali" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_pendidikan_wali">Pendidikan</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_pendidikan_wali" name="siswa_pendidikan_wali">
																	<?php foreach ($pendidikan->result() as $pendidikan_wali) : ?>
																		<option value="<?php echo $pendidikan_wali->pendidikan_id ?>"><?php echo $pendidikan_wali->pendidikan_nama ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_pekerjaan_wali">Pekerjaan</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_pekerjaan_wali" name="siswa_pekerjaan_wali">
																	<?php foreach ($pekerjaan->result() as $pekerjaan_wali) : ?>
																		<option value="<?php echo $pekerjaan_wali->pekerjaan_id ?>"><?php echo $pekerjaan_wali->pekerjaan_keterangan ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_penghasilan_wali">Penghasilan</label>
															<div class="col-md-9">
																<select class="form-control" id="siswa_penghasilan_wali" name="siswa_penghasilan_wali">
																	<?php foreach ($penghasilan->result() as $penghasilan_wali) : ?>
																		<option value="<?php echo $penghasilan_wali->penghasilan_id ?>"><?php echo $penghasilan_wali->penghasilan_keterangan ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn bg-blue bg-accent-3 white">Simpan</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade text-left" data-backdrop="false" id="modal_registrasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header bg-warning">
										<h4 class="modal-title" id="myModalLabel1">Registrasi Siswa</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form class="form" action="#" id="form_registrasi" novalidate>
											<div class="form-body">
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="user_group_nama">Nama Lengkap</label>
															<div class="col-md-9 controls">
																<input type="hidden" id="siswa_id" name="siswa_id">
																<input type="text" id="siswa_nama" class="form-control" placeholder="Nama Lengkap" name="siswa_nama" value="" readonly>
															</div>
														</div>
													</div>
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_status">Status</label>
															<div class="col-md-9">

																<select class="form-control" id="siswa_status" name="siswa_status">
																	<option value="2">Mutasi</option>
																	<option value="3">Dikeluarkan</option>
																	<option value="4">Mengundurkan Diri</option>
																	<option value="5">Putus Sekolah</option>
																	<option value="6">Wafat</option>
																	<option value="7">Hilang</option>
																	<option value="8">Lulus</option>
																	<option value="1">Aktif</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="siswa_tgl_nonaktif">Tanggal Non Aktif</label>
															<div class="col-md-9">
																<input type="text" id="siswa_tgl_nonaktif" class="form-control" placeholder="Tanggal Non Aktif" name="siswa_tgl_nonaktif" value="" required>
															</div>
														</div>
													</div>
												</div>
											</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn bg-blue bg-accent-3 white">Simpan</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade text-left" data-backdrop="false" id="modal_rombel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header bg-warning">
										<h4 class="modal-title" id="myModalLabel1">Registrasi Siswa Ke Rombel</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form class="form" action="#" id="form_registrasi_rombel" novalidate>
											<div class="form-body">
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="user_group_nama">Nama Lengkap</label>
															<div class="col-md-9 controls">
																<input type="hidden" id="siswa_id" name="siswa_id">
																<input type="text" id="siswa_nama" class="form-control" placeholder="Nama Lengkap" name="siswa_nama" value="" readonly>
															</div>
														</div>
													</div>
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="user_group_nis">NIS</label>
															<div class="col-md-9 controls">
																<input type="text" id="siswa_nis" class="form-control" placeholder="NIS" name="siswa_nis" value="" readonly>
															</div>
														</div>
													</div>
													<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="rombel">Rombel</label>
														<div class="col-md-9">
															<select class="select2 form-control select2-hidden-accessible" name="kelas_id" id="kelas_id" style="width: 100%">
																<option value="0">Pilih Rombel</option>
																<?php foreach ($rombel->result() as $rombel) : ?>
																	<option value="<?php echo $rombel->kelas_id ?>"><?php echo $rombel->kelas_nama ?></option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>
												</div>
												</div>
											</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn bg-blue bg-accent-3 white">Simpan</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade text-left" data-backdrop="false" id="modal_cetak_surat_keluar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header bg-warning">
										<h4 class="modal-title" id="myModalLabel1">Registrasi Siswa</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form class="form" action="#" id="form_surat_keterangan_pindah" novalidate>
											<div class="form-body">
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="user_group_nama">Nama Lengkap</label>
															<div class="col-md-9 controls">
																<input type="hidden" id="siswa_id" name="siswa_id">
																<input type="text" id="siswa_nama" class="form-control" placeholder="Nama Lengkap" name="siswa_nama" value="" readonly>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="user_group_nama">Pindah Ke</label>
															<div class="col-md-9 controls">
																<input type="text" id="pindah_ke" class="form-control" placeholder="Nama Sekolah Tujuan" name="pindah_ke" value="">
															</div>
														</div>
													</div>
												</div>
											</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn bg-blue bg-accent-3 white">Cetak</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade text-left" data-backdrop="false" id="modal_tambah_siswa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel1">Basic Modal</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form class="form" action="#" id="form_tambah_siswa" novalidate>
											<div class="form-body">
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_email">Nama Lengkap</label>
														<div class="col-md-9 controls">
															<input type="hidden" name="user_id" />
															<input type="text" id="user_email" class="form-control" placeholder="Nama Lengkap" name="user_email" value="" required data-validation-required-message="Nama Lengkap Wajib Diisi">
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_nama">NIS</label>
														<div class="col-md-9 controls">
															<input type="text" id="user_nama" class="form-control" placeholder="User" name="user_nama" value="" required data-validation-required-message="User Wajib Diisi">
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_password">Password</label>
														<div class="col-md-9 controls">
															<input type="text" id="user_password" class="form-control" placeholder="Password" name="user_password" value="" required data-validation-required-message="Password Wajib Diisi">
														</div>
													</div>
												</div>
											</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn bg-blue bg-accent-3 white">Simpan</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										</form>
									</div>
								</div>
							</div>
						</div>
