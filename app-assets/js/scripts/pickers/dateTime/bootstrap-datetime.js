/*=========================================================================================
    File Name: bootstrap-datetime.js
    Description: Bootstrap DateTime Picker JS
    ----------------------------------------------------------------------------------------
    Item Name: Stack - Responsive Admin Theme
    Version: 3.0
    Author: Pixinvent
    Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function (window, document, $) {
	"use strict";

	/*******	Bootstrap DateTime Picker	*****/

	// Simple Date time picker
	$("#siswa_tanggallahir").datetimepicker({
		locale: "id",
		format: "DD-MM-YYYY",
	});
	$("#siswa_tgl_nonaktif").datetimepicker({
		locale: "id",
		format: "DD-MM-YYYY",
	});
})(window, document, jQuery);
