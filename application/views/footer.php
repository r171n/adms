<?php
$this->db->select('*');
$this->db->from('config');
$this->db->where('config.cf_id', 1);
$config = $this->db->get()->row();
?>
</div>
</div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<footer class="footer footer-static bg-gradient-x-blue white navbar-border">
	<p class="clearfix white lighten-2 text-sm-center mb-0 px-2">
		<span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2020 <a class="text-bold-800 black darken-2" href=""><?php echo $config->cf_nama; ?> </a>, All rights reserved. </span>
		<span class="float-md-right d-block d-md-inline-block d-none d-lg-block"><a class="text-bold-800 black darken-2" href="http://www.cumacoder.com">www.cumacoder.com </a></span>
	</p>
</footer>
<!-- BEGIN VENDOR JS-->
<script src="<?php echo base_url(); ?>app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="<?php echo base_url(); ?>app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>app-assets/vendors/js/extensions/unslider-min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>app-assets/vendors/js/timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>app-assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN STACK JS-->
<script src="<?php echo base_url(); ?>app-assets/js/core/app-menu.js" type="text/javascript"></script>
<?php if ($js != "") { ?>
	<script src="<?php echo base_url(); ?>app-assets/js/core/<?php echo $js; ?>" type="text/javascript"></script>
<?php } else {; ?>
	<script src="<?php echo base_url(); ?>app-assets/js/core/app.js" type="text/javascript"></script>
<?php }; ?>
<script src="<?php echo base_url(); ?>app-assets/js/scripts/customizer.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>app-assets/js/scripts/forms/checkbox-radio.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>app-assets/js/scripts/pickers/dateTime/bootstrap-datetime.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>app-assets/js/scripts/extensions/toastr.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
<!-- <script src="<?php echo base_url(); ?>app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script> -->
<script src="<?php echo base_url(); ?>app-assets/js/scripts/forms/validation/form-validation.js"></script>


<!-- END STACK JS-->
</body>

</html>
