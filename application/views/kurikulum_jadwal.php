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
										<div class="row">
											<div class="col-md-12 col-sm-12">
												<div class="form-group row">
													<label class="col-md-3 label-control" for="jadwal_guru_id">Nama Guru</label>
													<div class="col-md-9">
														<select class="select2 form-control select2-hidden-accessible" name="jadwal_guru_id" id="jadwal_guru_id" style="width: 100%">
															<option value="0">Pilih Guru</option>
															<?php foreach ($user->result() as $user) : ?>
																<option value="<?php echo $user->user_id ?>"><?php echo $user->user_email ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<button onclick="add()" class=" btn btn-md bg-blue bg-darken-4 white"><i class="ft ft-plus"></i> Tambah</button>
											<br>
											<br>
											<table class="table table-striped table-bordered zero-configuration dataTable" id="table" role="grid" aria-describedby="table" style="width:100%">
												<thead>
													<tr>
														<th>No</th>
														<th data-priority="1">Hari</th>
														<th data-priority="2">Kelas</th>
														<th>Jam Ke</th>
														<th>Pelajaran</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												</tbody>

												<tfoot>
													<tr>
														<th>No</th>
														<th data-priority="1">Hari</th>
														<th data-priority="2">Kelas</th>
														<th>Jam Ke</th>
														<th>Pelajaran</th>
														<th>Aksi</th>
													</tr>
												</tfoot>
											</table>
									</div>
								</div>
							</div>
						</div>
