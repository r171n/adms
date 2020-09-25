<div class="row match-height">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><?php echo $namepage; ?></h4>
				<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
						<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-content">
				<div class="card-body">
					<?php if ($this->session->userdata('user_type') == 2) : ?>
						<div class="alert alert-icon-right alert-warning alert-dismissible mb-2" role="alert">
							<strong>Pastikan Biodata Sudah Terupdate !</strong>
							<br>
							Biodata Akan Digunakan Untuk Raport dan Ijazah
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
