					<div class="row match-height">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title"><?php echo $namepage; ?></h4>
								</div>
								<div class="card-content">
									<div class="card-body">
										<button class="btn btn-success btn-secondary" onclick="add_akun()"><i class="ft-plus"></i>Tambah Akun</button>
										<br>
										<br>
										<table class="table table-striped table-bordered zero-configuration dataTable" id="table_user" role="grid" aria-describedby="table_user" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th data-priority="1">User</th>
													<th data-priority="2">Nama</th>
													<th>Type Akun</th>
													<th>Login Terakhir</th>
													<th>Opsi</th>

												</tr>
											</thead>
											<tbody>
											</tbody>

											<tfoot>
												<tr>
													<th>No</th>
													<th data-priority="1">User</th>
													<th data-priority="2">Nama</th>
													<th>Type Akun</th>
													<th>Login Terakhir</th>
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
										<form class="form" action="#" id="form_akun" novalidate>
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
														<label class="col-md-3 label-control" for="user_nama">User</label>
														<div class="col-md-9 controls">
															<input type="text" id="user_nama" class="form-control" placeholder="User" name="user_nama" value="" required data-validation-required-message="User Wajib Diisi">
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12" id="div_ganti_pw">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="ganti_password">Ganti Password</label>
														<div class="col-md-9 controls">
															<div class="d-inline-block custom-control custom-checkbox mr-1">
																<input type="checkbox" name="ganti_password" class="custom-control-input" id="ganti_password">
																<label class="custom-control-label" for="ganti_password">YA</label>
															</div>
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
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success">Simpan</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade text-left" data-backdrop="false" id="modal_akun_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel1">Basic Modal</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form class="form" action="#" id="form_akun_group" novalidate>
											<div class="form-body">
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_group_nama">Nama Lengkap</label>
														<div class="col-md-9 controls">
															<input type="hidden" name="user_id" />
															<input type="text" id="user_group_nama" class="form-control" placeholder="Nama Lengkap" name="user_group_nama" value="" readonly>
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_group_user">User</label>
														<div class="col-md-9 controls">
															<input type="text" id="user_group_user" class="form-control" placeholder="User" name="user_group_user" value="" readonly>
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="user_group_user">Group</label>
														<div class="col-md-6 controls">
															<select class="form-control" name="group_id" id="group_id">
																<option value="0">Pilih Group</option>
																<?php foreach ($group->result() as $group) : ?>
																	<option value="<?php echo $group->group_id ?>"><?php echo $group->group_nama ?></option>
																<?php endforeach; ?>
															</select>
														</div>
														<div class="col-md-3 controls">
															<button class="btn btn-primary" onclick="add_group()"> Tambah Group </button>
														</div>
													</div>
												</div>
												<hr>
												<div class="form-body">
													<table class="table table-striped table-bordered zero-configuration dataTable" role="grid" aria-describedby="table_user" style="width:100%">
														<thead>
															<tr>
																<th>No</th>
																<th data-priority="1">Nama Group</th>
																<th>Opsi</th>

															</tr>
														</thead>
														<tbody id="user_group_list">
														</tbody>
													</table>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
