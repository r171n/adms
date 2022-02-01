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
					<?php echo form_open_multipart('config/identitassave'); ?>
					<div class="form-body">
						<?php if ($this->session->flashdata('success')) : ?>
							<div class="alert alert-success" role="alert">
								<?php echo $this->session->flashdata('success'); ?>
							</div>
						<?php endif; ?>
						<h4 class="form-section"><i class="ft-credit-card"></i> Identitas</h4>
						<?php
						$cekdata = $data->num_rows();
						if ($cekdata == 1) {
							$dataconfig = $data->row();
						}
						?>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="cf_nama">Nama Sekolah</label>
									<div class="col-md-9">
										<input type="text" id="cf_nama" class="form-control" placeholder="Nama Lengkap" name="cf_nama" value="<?php if ($cekdata == 1) echo $dataconfig->cf_nama; ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="cf_alamat">Alamat Sekolah</label>
									<div class="col-md-9">
										<input type="text" id="cf_alamat" class="form-control" placeholder="Alamat Sekolah" name="cf_alamat" value="<?php if ($cekdata == 1) echo $dataconfig->cf_alamat; ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="cf_email">Email Sekolah</label>
									<div class="col-md-9">
										<input type="email" id="cf_email" class="form-control" placeholder="email Sekolah" name="cf_email" value="<?php if ($cekdata == 1) echo $dataconfig->cf_email; ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="cf_telephone">Telephone Sekolah</label>
									<div class="col-md-9">
										<input type="text" id="cf_telephone" class="form-control" placeholder="Telephone Sekolah" name="cf_telephone" value="<?php if ($cekdata == 1) echo $dataconfig->cf_telephone; ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="cf_nama_kepala_sekolah">Nama Kepala Sekolah</label>
									<div class="col-md-9">
										<input type="text" id="cf_nama_kepala_sekolah" class="form-control" placeholder="Nama Kepala Sekolah" name="cf_nama_kepala_sekolah" value="<?php if ($cekdata == 1) echo $dataconfig->cf_nama_kepala_sekolah; ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="cf_nip_kepala_sekolah">NIP Kepala Sekolah</label>
									<div class="col-md-9">
										<input type="text" id="cf_nip_kepala_sekolah" class="form-control" placeholder="NIP Kepala Sekolah" name="cf_nip_kepala_sekolah" value="<?php if ($cekdata == 1) echo $dataconfig->cf_nip_kepala_sekolah; ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="cf_logo">Logo Sekolah</label>
									<div class="col-md-5">
										<input type="file" name="cf_logo" class="form-control-file" id="cf_logo">
									</div>
									<div class="col-md-4">
										<?php if ($cekdata == 1) if ($dataconfig->cf_logo != "") echo "<img class='brand-logo' alt='stack admin logo' src='" . base_url() . "app-assets/images/logo/" . $dataconfig->cf_logo . "' height='100px'>"; ?>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="cf_kop_sekolah">Gambar Kop Sekolah</label>
									<div class="col-md-5">
										<input type="file" name="cf_kop_sekolah" class="form-control-file" id="cf_kop_sekolah">
									</div>
									<div class="col-md-4">
										<?php if ($cekdata == 1) if ($dataconfig->cf_kop_sekolah != "") echo "<img class='brand-logo' alt='stack admin logo' src='" . base_url() . "app-assets/images/kop/" . $dataconfig->cf_kop_sekolah . "' height='100px'>"; ?>
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
