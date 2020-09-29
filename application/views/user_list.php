					<div class="row match-height">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title"><?php echo $namepage; ?></h4>
								</div>
								<div class="card-content">
									<div class="card-body">
										<button class="btn btn-success" onclick="add_akun()">Tambah Akun</button>
										<br>
										<br>
										<table class="table table-striped table-bordered zero-configuration dataTable" id="table_user" role="grid" aria-describedby="table_user">
											<thead>
												<tr>
													<th>No</th>
													<th>User</th>
													<th>Nama</th>
													<th>Type Akun</th>
													<th>Opsi</th>

												</tr>
											</thead>
											<tbody>
											</tbody>

											<tfoot>
												<tr>
													<th>No</th>
													<th>User</th>
													<th>Nama</th>
													<th>Type Akun</th>
													<th>Opsi</th>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade text-left" data-backdrop="false" id="modal_akun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel1">Basic Modal</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form class="form" action="#" id="form_akun">
											<div class="form-body">
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_email">Nama Lengkap</label>
														<div class="col-md-9">
															<input type="hidden" name="user_id" />
															<input type="text" id="user_email" class="form-control" placeholder="Nama Lengkap" name="user_email" value="" required>
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_nama">User</label>
														<div class="col-md-9">
															<input type="text" id="user_nama" class="form-control" placeholder="User" name="user_nama" value="" required>
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_password">Password</label>
														<div class="col-md-9">
															<input type="text" id="user_password" class="form-control" placeholder="Password" name="user_password" value="" required>
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_type">Type User</label>
														<div class="col-md-9">
															<select class="form-control" id="user_type" name="user_type">
																<option value="1">Guru</option>
																<option value="2">Siswa</option>
															</select>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" onclick="saveakun()">Simpan</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
									</div>
								</div>
							</div>
						</div>
