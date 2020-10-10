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
													<th data-priority="1">Nama</th>
													<th data-priority="2">Tingkat</th>
													<th>Jurusan</th>
													<th>Wali Kelas</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
											</tbody>

											<tfoot>
												<tr>
													<th>No</th>
													<th data-priority="1">Nama</th>
													<th data-priority="2">Tingkat</th>
													<th>Jurusan</th>
													<th>Wali Kelas</th>
													<th>Opsi</th>
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
															<label class="col-md-3 label-control" for="nama">Nama Lengkap</label>
															<div class="col-md-9">
																<input type="hidden" id="kelas_id" class="form-control" placeholder="Nama Lengkap" name="kelas_id" value="">
																<input type="text" id="kelas_nama" class="form-control" placeholder="Nama Lengkap" name="kelas_nama" value="" required data-validation-required-message="Nama Wajib Diisi">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="tingkat_id">Tingkat</label>
														<div class="col-md-9">
															<select class="form-control" id="tingkat_id" name="tingkat_id">
																<?php foreach ($tingkat->result() as $tingkat) : ?>
																	<option value="<?php echo $tingkat->tingkat_id ?>"><?php echo $tingkat->tingkat_nama ?></option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="jurusan_id">Jurusan</label>
														<div class="col-md-9">
															<select class="form-control" id="jurusan_id" name="jurusan_id">
																<?php foreach ($jurusan->result() as $jurusan) : ?>
																	<option value="<?php echo $jurusan->jurusan_id ?>"><?php echo $jurusan->jurusan_nama ?></option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="wali_user_id">Wali Kelas</label>
														<div class="col-md-9">
															<select class="select2 form-control select2-hidden-accessible" name="wali_user_id" id="wali_user_id" style="width: 100%">
																<option value="0">Pilih Wali Kelas</option>
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
