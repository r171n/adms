<?php
$this->db->select('*');
$this->db->from('ms_menu');
$this->db->join('ms_group_akses', 'ms_menu.mn_id = ms_group_akses.mn_id');
$this->db->join('ms_group', 'ms_group_akses.group_id = ms_group.group_id');
$this->db->join('ms_user_group', 'ms_group.group_id = ms_user_group.group_id');
$this->db->where('ms_user_group.user_id', $this->session->userdata('user_id'));
$this->db->group_by('ms_menu.mn_parent_id');
$this->db->order_by('ms_menu.mn_kode');
$parentid = $this->db->get();

$this->db->select('*');
$this->db->from('config');
$this->db->where('config.cf_id', 1);
$config = $this->db->get()->row();
?>
<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-light bg-gradient-x-blue white">
	<div class="navbar-wrapper">
		<div class="navbar-header">
			<ul class="nav navbar-nav flex-row">
				<li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
				<li class="nav-item">
					<a class="navbar-brand" href="<?php echo base_url(); ?>">
						<img class="brand-logo" alt="stack admin logo" src="<?php echo base_url(); ?>app-assets/images/logo/<?php echo $config->cf_logo; ?>" height="32px">
						<h2 class="brand-text">WEBSIS</h2>
					</a>
				</li>
				<li class="nav-item d-md-none">
					<a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a>
				</li>
			</ul>
		</div>
		<div class="navbar-container content">
			<div class="collapse navbar-collapse" id="navbar-mobile">
				<ul class="nav navbar-nav mr-auto float-left">
					<li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
				</ul>
				<ul class="nav navbar-nav float-right">
					<li class="dropdown dropdown-user nav-item">
						<a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
							<span class="avatar avatar-online">
								<img src="<?php echo base_url(); ?>app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span>
							<span class="user-name"><?php echo $this->session->userdata('user_nama'); ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href=""><i class="ft-user"></i> Pengaturan Akun</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>"><i class="ft-power"></i> Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
	<div class="main-menu-content">
		<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
			<li class="nav-item">
				<a href="<?php echo base_url('dashboard'); ?>"><i class="ft-home"></i>
					<span class="menu-title" data-i18n="">Dashboard</span>
				</a>
			</li>
			<?php foreach ($parentid->result() as $parent_id) : ?>
				<?php
				$this->db->select('*');
				$this->db->from('ms_menu');
				$this->db->where('ms_menu.mn_id', $parent_id->mn_parent_id);
				$mn = $this->db->get()->row();
				?>
				<li class=" nav-item">
					<a href="">
						<i class="<?php echo $mn->mn_icon ?>"></i>
						<span class="menu-title" data-i18n=""><?php echo $mn->mn_nama ?></span>
					</a>
					<?php
					$this->db->select('*');
					$this->db->from('ms_menu');
					$this->db->join('ms_group_akses', 'ms_menu.mn_id = ms_group_akses.mn_id');
					$this->db->join('ms_group', 'ms_group_akses.group_id = ms_group.group_id');
					$this->db->join('ms_user_group', 'ms_group.group_id = ms_user_group.group_id');
					$this->db->where('ms_user_group.user_id', $this->session->userdata('user_id'));
					$this->db->where('ms_menu.mn_parent_id', $mn->mn_id);
					$this->db->order_by('ms_menu.mn_kode');
					$submn = $this->db->get();
					?>
					<ul class="menu-content">
						<?php foreach ($submn->result() as $submenu) : ?>
							<li>
								<a class="menu-item" href="<?php echo base_url() . $submenu->mn_url ?>">
									<?php echo $submenu->mn_nama ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
