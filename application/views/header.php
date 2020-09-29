<?php
$this->db->select('*');
$this->db->from('config');
$this->db->where('config.cf_id', 1);
$config = $this->db->get()->row();
?>
<!-- - var navbarShadow = true-->
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="WEBSIS adalah adalah Sistem Informasi Sekolah dengan e-Learning berbasis web online terintegrasi menjadi solusi Manajemen Administrasi Terpadu di Sekolah, mencakup modul Kepegawaian, Kesiswaan, Kurikulum, Keuangan, Perpustakaan, Alumni, Humas, Kepala Sekolah, Inventaris yang Multiuser sehingga WEBSIS dapat diakses oleh siswa, guru, karyawan, kepala sekolah hingga satpam dan petugas perpustakaan">
	<meta name="classification" content="software aplikasi manajemen sekolah dan dunia pendidikan">
	<meta name="keywords" content="Softawe Sekolah, Sistem Informasi Sekolah, SIAKAD, EMIS">
	<meta name="author" content="CUMACODER.COM">
	<title>WEBSIS - <?php echo $config->cf_nama; ?></title>
	<link rel="apple-touch-icon" href="<?php echo base_url(); ?>app-assets/images/ico/apple-icon-120.png">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>app-assets/images/ico/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
	<!-- BEGIN VENDOR CSS-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/vendors.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/vendors/css/extensions/unslider.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/vendors/css/weather-icons/climacons.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/fonts/meteocons/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/vendors/css/charts/morris.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/vendors/css/tables/datatable/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/vendors/css/extensions/toastr.css">
	<!-- END VENDOR CSS-->
	<!-- BEGIN STACK CSS-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/app.css">
	<!-- END STACK CSS-->
	<!-- BEGIN Page Level CSS-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/core/menu/menu-types/vertical-menu.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/core/colors/palette-gradient.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/fonts/simple-line-icons/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/core/colors/palette-gradient.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/pages/timeline.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/plugins/forms/checkboxes-radios.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>app-assets/css/plugins/extensions/toastr.css">
	<!-- END Page Level CSS-->
	<!-- BEGIN Custom CSS-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">
