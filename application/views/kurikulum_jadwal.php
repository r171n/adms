					<div class="row match-height">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">
										<?php echo $namepage; ?>
									</h4>
								</div>
								<div class="card-content">
									<div class="card-body">
										<button onclick="add()" class=" btn btn-md bg-blue bg-darken-4 white"><i class="ft ft-plus"></i> Tambah</button>
											<br>
											<br>
											<table class="table table-striped table-bordered zero-configuration dataTable" id="table" role="grid" aria-describedby="table" style="width:100%">
												<thead>
													<tr>
														<th>No</th>
														<th data-priority="1">Kelas</th>
														<th data-priority="2">Pelajaran</th>
														<th>Hari</th>
														<th>Mulai Jam Ke</th>
														<th>Jumlah Jam</th>
														<th>Pengajar</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												</tbody>

												<tfoot>
													<tr>
														<th>No</th>
														<th data-priority="1">Kelas</th>
														<th data-priority="2">Pelajaran</th>
														<th>Hari</th>
														<th>Mulai Jam Ke</th>
														<th>Jumlah Jam</th>
														<th>Pengajar</th>
														<th>Aksi</th>
													</tr>
												</tfoot>
											</table>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade text-left" data-backdrop="false" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel1">Basic Modal</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form class="form" action="#" id="form" novalidate>
											<div class="form-body">
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="jadwal_hari_id">Hari</label>
															<div class="col-md-9">
																<select class="form-control" id="jadwal_hari_id" name="jadwal_hari_id">
																	<?php foreach ($hari->result() as $hari) : ?>
																		<option value="<?php echo $hari->hari_id ?>"><?php echo $hari->hari_nama ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="jadwal_jam_pelajaran_id">Mulai Jam Ke- </label>
															<div class="col-md-9">
																<select class="form-control" id="jadwal_jam_pelajaran_id" name="jadwal_jam_pelajaran_id">
																	<option value="0">Pilih</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="jadwal_jumlah_jam">Jumlah Jam </label>
															<div class="col-md-9">
															<input type="number" step="1" class="form-control" id="jadwal_jumlah_jam" name="jadwal_jumlah_jam" required>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="jadwal_kelas_id">Kelas</label>
															<div class="col-md-9">
																<select class="select2 form-control select2-hidden-accessible" id="jadwal_kelas_id" name="jadwal_kelas_id" style="width: 100%">
																	<option value="0">Pilih Kelas</option>
																	<?php foreach ($kelas->result() as $kelas) : ?>
																		<option value="<?php echo $kelas->kelas_id ?>"><?php echo $kelas->kelas_nama ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="jadwal_mata_pelajaran_id">Mata Pelajaran</label>
															<div class="col-md-9">
																<select class="select2 form-control select2-hidden-accessible" id="jadwal_mata_pelajaran_id" name="jadwal_mata_pelajaran_id" style="width: 100%">
																	<option value="0">Pilih</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="form-group row">
															<label class="col-md-3 label-control" for="jadwal_guru_id">Pengajar</label>
															<div class="col-md-9">
																<select class="select2 form-control select2-hidden-accessible" name="jadwal_guru_id" id="jadwal_guru_id" style="width: 100%">
																	<option value="0">Pilih Pengajar</option>
																	<?php foreach ($user->result() as $user) : ?>
																		<option value="<?php echo $user->user_id ?>"><?php echo $user->user_email ?></option>
																	<?php endforeach; ?>
																</select>
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
