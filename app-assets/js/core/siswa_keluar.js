(function (window, document, $) {
	"use strict";
	var $html = $("html");
	var $body = $("body");

	$(window).on("load", function () {
		var rtl;
		var compactMenu = false; // Set it to true, if you want default menu to be compact

		if ($("html").data("textdirection") == "rtl") {
			rtl = true;
		}

		setTimeout(function () {
			$html.removeClass("loading").addClass("loaded");
		}, 1200);

		$.app.menu.init(compactMenu);

		// Navigation configurations
		var config = {
			speed: 300, // set speed to expand / collpase menu
		};
		if ($.app.nav.initialized === false) {
			$.app.nav.init(config);
		}

		Unison.on("change", function (bp) {
			$.app.menu.change();
		});

		// Tooltip Initialization
		$('[data-toggle="tooltip"]').tooltip({
			container: "body",
		});

		// Top Navbars - Hide on Scroll
		if ($(".navbar-hide-on-scroll").length > 0) {
			$(".navbar-hide-on-scroll.fixed-top").headroom({
				offset: 205,
				tolerance: 5,
				classes: {
					// when element is initialised
					initial: "headroom",
					// when scrolling up
					pinned: "headroom--pinned-top",
					// when scrolling down
					unpinned: "headroom--unpinned-top",
				},
			});
			// Bottom Navbars - Hide on Scroll
			$(".navbar-hide-on-scroll.fixed-bottom").headroom({
				offset: 205,
				tolerance: 5,
				classes: {
					// when element is initialised
					initial: "headroom",
					// when scrolling up
					pinned: "headroom--pinned-bottom",
					// when scrolling down
					unpinned: "headroom--unpinned-bottom",
				},
			});
		}

		// Collapsible Card
		$('a[data-action="collapse"]').on("click", function (e) {
			e.preventDefault();
			$(this).closest(".card").children(".card-content").collapse("toggle");
			$(this)
				.closest(".card")
				.find('[data-action="collapse"] i')
				.toggleClass("ft-minus ft-plus");
		});

		// Toggle fullscreen
		$('a[data-action="expand"]').on("click", function (e) {
			e.preventDefault();
			$(this)
				.closest(".card")
				.find('[data-action="expand"] i')
				.toggleClass("ft-maximize ft-minimize");
			$(this).closest(".card").toggleClass("card-fullscreen");
		});

		//  Notifications & messages scrollable
		if ($(".scrollable-container").length > 0) {
			$(".scrollable-container").perfectScrollbar({
				theme: "dark",
			});
		}

		// Reload Card
		$('a[data-action="reload"]').on("click", function () {
			var block_ele = $(this).closest(".card");

			// Block Element
			block_ele.block({
				message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
				timeout: 2000, //unblock after 2 seconds
				overlayCSS: {
					backgroundColor: "#FFF",
					cursor: "wait",
				},
				css: {
					border: 0,
					padding: 0,
					backgroundColor: "none",
				},
			});
		});

		// Close Card
		$('a[data-action="close"]').on("click", function () {
			$(this).closest(".card").removeClass().slideUp("fast");
		});

		// Match the height of each card in a row
		setTimeout(function () {
			$(".row.match-height").each(function () {
				$(this).find(".card").not(".card .card").matchHeight(); // Not .card .card prevents collapsible cards from taking height
			});
		}, 500);

		$('.card .heading-elements a[data-action="collapse"]').on(
			"click",
			function () {
				var $this = $(this),
					card = $this.closest(".card");
				var cardHeight;

				if (parseInt(card[0].style.height, 10) > 0) {
					cardHeight = card.css("height");
					card.css("height", "").attr("data-height", cardHeight);
				} else {
					if (card.data("height")) {
						cardHeight = card.data("height");
						card.css("height", cardHeight).attr("data-height", "");
					}
				}
			}
		);

		// Add open class to parent list item if subitem is active except compact menu
		var menuType = $body.data("menu");
		if (menuType != "horizontal-menu" && compactMenu === false) {
			if ($body.data("menu") == "vertical-menu-modern") {
				if (localStorage.getItem("menuLocked") === "true") {
					$(".main-menu-content")
						.find("li.active")
						.parents("li")
						.addClass("open");
				}
			} else {
				$(".main-menu-content")
					.find("li.active")
					.parents("li")
					.addClass("open");
			}
		}
		if (menuType == "horizontal-menu") {
			$(".main-menu-content")
				.find("li.active")
				.parents("li:not(.nav-item)")
				.addClass("open");
			$(".main-menu-content")
				.find("li.active")
				.parents("li")
				.addClass("active");
		}

		//card heading actions buttons small screen support
		$(".heading-elements-toggle").on("click", function () {
			$(this).parent().children(".heading-elements").toggleClass("visible");
		});

		//  Dynamic height for the chartjs div for the chart animations to work
		var chartjsDiv = $(".chartjs"),
			canvasHeight = chartjsDiv.children("canvas").attr("height");
		chartjsDiv.css("height", canvasHeight);

		if ($body.hasClass("boxed-layout")) {
			if ($body.hasClass("vertical-overlay-menu")) {
				var menuWidth = $(".main-menu").width();
				var contentPosition = $(".app-content").position().left;
				var menuPositionAdjust = contentPosition - menuWidth;
				if ($body.hasClass("menu-flipped")) {
					$(".main-menu").css("right", menuPositionAdjust + "px");
				} else {
					$(".main-menu").css("left", menuPositionAdjust + "px");
				}
			}
		}

		$(".nav-link-search").on("click", function () {
			var $this = $(this),
				searchInput = $(this).siblings(".search-input");

			if (searchInput.hasClass("open")) {
				searchInput.removeClass("open");
			} else {
				searchInput.addClass("open");
			}
		});
	});

	$(document).on("click", ".menu-toggle, .modern-nav-toggle", function (e) {
		e.preventDefault();

		// Toggle menu
		$.app.menu.toggle();

		setTimeout(function () {
			$(window).trigger("resize");
		}, 200);

		if ($("#collapsed-sidebar").length > 0) {
			setTimeout(function () {
				if ($body.hasClass("menu-expanded") || $body.hasClass("menu-open")) {
					$("#collapsed-sidebar").prop("checked", false);
				} else {
					$("#collapsed-sidebar").prop("checked", true);
				}
			}, 1000);
		}

		return false;
	});

	/*$('.modern-nav-toggle').on('click',function(){
		var $this = $(this),
		icon = $this.find('.toggle-icon').attr('data-ticon');

		if(icon == 'ft-toggle-right'){
			$this.find('.toggle-icon').attr('data-ticon','ft-toggle-left')
			.removeClass('ft-toggle-right').addClass('ft-toggle-left');
		}
		else{
			$this.find('.toggle-icon').attr('data-ticon','ft-toggle-right')
			.removeClass('ft-toggle-left').addClass('ft-toggle-right');
		}

		$.app.menu.toggle();
	});*/

	$(document).on("click", ".open-navbar-container", function (e) {
		var currentBreakpoint = Unison.fetch.now();

		// Init drilldown on small screen
		$.app.menu.drillDownMenu(currentBreakpoint.name);

		// return false;
	});

	$(document).on("click", ".main-menu-footer .footer-toggle", function (e) {
		e.preventDefault();
		$(this).find("i").toggleClass("pe-is-i-angle-down pe-is-i-angle-up");
		$(".main-menu-footer").toggleClass("footer-close footer-open");
		return false;
	});

	// Add Children Class
	$(".navigation").find("li").has("ul").addClass("has-sub");

	$(".carousel").carousel({
		interval: 2000,
	});

	// Page full screen
	$(".nav-link-expand").on("click", function (e) {
		if (typeof screenfull != "undefined") {
			if (screenfull.enabled) {
				screenfull.toggle();
			}
		}
	});
	if (typeof screenfull != "undefined") {
		if (screenfull.enabled) {
			$(document).on(screenfull.raw.fullscreenchange, function () {
				if (screenfull.isFullscreen) {
					$(".nav-link-expand")
						.find("i")
						.toggleClass("ft-minimize ft-maximize");
				} else {
					$(".nav-link-expand")
						.find("i")
						.toggleClass("ft-maximize ft-minimize");
				}
			});
		}
	}

	$(document).on("click", ".mega-dropdown-menu", function (e) {
		e.stopPropagation();
	});

	$(document).ready(function () {
		/**********************************
		 *   Form Wizard Step Icon
		 **********************************/
		$(".step-icon").each(function () {
			var $this = $(this);
			if ($this.siblings("span.step").length > 0) {
				$this.siblings("span.step").empty();
				$(this).appendTo($(this).siblings("span.step"));
			}
		});

		if ($("#kps_ya").is(":checked")) {
			$("#siswa_nokps").prop("readonly", false);
		} else {
			$("#siswa_nokps").prop("readonly", true);
		}
		if ($("#kip_ya").is(":checked")) {
			$("#siswa_nokip").prop("readonly", false);
		} else {
			$("#siswa_nokip").prop("readonly", true);
		}
	});

	// Update manual scroller when window is resized
	$(window).resize(function () {
		$.app.menu.manualScroller.updateHeight();
	});

	// TODO : Tabs dropdown fix, remove this code once fixed in bootstrap 4.
	$(".nav.nav-tabs a.dropdown-item").on("click", function () {
		var $this = $(this),
			href = $this.attr("href");
		var tabs = $this.closest(".nav");
		tabs.find(".nav-link").removeClass("active");
		$this.closest(".nav-item").find(".nav-link").addClass("active");
		$this
			.closest(".dropdown-menu")
			.find(".dropdown-item")
			.removeClass("active");
		$this.addClass("active");
		tabs
			.next()
			.find(href)
			.siblings(".tab-pane")
			.removeClass("active in")
			.attr("aria-expanded", false);
		$(href).addClass("active in").attr("aria-expanded", "true");
	});

	$("#sidebar-page-navigation").on("click", "a.nav-link", function (e) {
		e.preventDefault();
		e.stopPropagation();
		var $this = $(this),
			href = $this.attr("href");
		var offset = $(href).offset();
		var scrollto = offset.top - 80; // minus fixed header height
		$("html, body").animate({ scrollTop: scrollto }, 0);
		setTimeout(function () {
			$this
				.parent(".nav-item")
				.siblings(".nav-item")
				.children(".nav-link")
				.removeClass("active");
			$this.addClass("active");
		}, 100);
	});

	$('input:radio[name="siswa_kps"]').change(function () {
		if ($(this).val() == "YA") {
			$("#siswa_nokps").prop("readonly", false);
		} else {
			$("#siswa_nokps").prop("readonly", true);
		}
	});

	$('input:radio[name="siswa_kip"]').change(function () {
		if ($(this).val() == "YA") {
			$("#siswa_nokip").prop("readonly", false);
		} else {
			$("#siswa_nokip").prop("readonly", true);
		}
	});
	$('[name="ganti_password"]').change(function () {
		if ($(this).is(":checked")) {
			$("#user_password").prop("readonly", false);
		} else {
			$("#user_password").prop("readonly", true);
		}
	});
})(window, document, jQuery);

var table;
$(document).ready(function () {
	//datatables
	table = $("#table").DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		order: [],
		lengthMenu: [
			[50, 100, 250, 500, -1],
			[50, 100, 250, 500, "All"],
		],
		ajax: {
			url: "get_data_keluar",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0],
				orderable: false,
			},
			{ responsivePriority: 1, targets: 0 },
			{ responsivePriority: 10001, targets: 4 },
			{ responsivePriority: 2, targets: -2 },
		],
	});
});

function add_akun() {
	save_method = "add";
	$("#form_akun")[0].reset(); // reset form on modals
	$("div").removeClass("error");
	$(".help-block").hide();
	$("#div_ganti_pw").hide();
	$("#user_nama").prop("readonly", false);
	$("#user_password").prop("readonly", false);
	$("#modal_akun").modal("show"); // show bootstrap modal
	$(".modal-title").text("Tambah Akun"); // Set Title to Bootstrap modal title
}

$("#form_siswa").submit(function (event) {
	$(".help-block").show();
	event.preventDefault();
	var url;

	if ($("#form_siswa").jqBootstrapValidation()) {
		// ajax adding data to database
		$.ajax({
			url: "biodatasave",
			type: "POST",
			data: $("#form_siswa").serialize(),
			dataType: "JSON",
			success: function (data) {
				//if success close modal and reload ajax table
				if (data.status == true) {
					toastr.success("Data Berhasil Disimpan", "BERHASIL ", {
						positionClass: "toast-bottom-full-width",
						containerId: "toast-bottom-full-width",
						closeButton: true,
					});
					$("#modal_siswa").modal("hide");
					reload_table();
				} else {
					toastr.warning("Semua Form Wajib Diisi!", "Gagal Menyimpan ", {
						positionClass: "toast-bottom-full-width",
						containerId: "toast-bottom-full-width",
						closeButton: true,
					});
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert("Error adding / update data");
			},
		});
	} else {
		toastr.warning("Silahkan Isi Semua Form", "Gagal Menyimpan ", {
			positionClass: "toast-bottom-full-width",
			containerId: "toast-bottom-full-width",
			closeButton: true,
		});
	}
});

function reload_table() {
	table.ajax.reload(null, false); //reload datatable ajax
}

function biodata(id) {
	$("#form_siswa")[0].reset(); // reset form on modals
	$("div").removeClass("error");
	$(".help-block").hide();
	//Ajax Load data from ajax
	$.ajax({
		url: "get_data_edit/" + id,
		type: "GET",
		dataType: "JSON",
		success: function (data) {
			$('[name="siswa_id"]').val(data.siswa_id);
			$('[name="siswa_nama"]').val(data.siswa_nama);
			$('[name="siswa_nisn"]').val(data.siswa_nisn);
			$('[name="siswa_nik"]').val(data.siswa_nik);
			$('[name="siswa_kk"]').val(data.siswa_kk);
			$('[name="siswa_tempatlahir"]').val(data.siswa_tempatlahir);
			$('[name="siswa_tanggallahir"]').val(formatDate(data.siswa_tanggallahir));
			$('[name="siswa_aktalahir"]').val(data.siswa_aktalahir);
			$('[name="siswa_agama"]').val(data.siswa_agama);
			$('[name="siswa_alamat"]').val(data.siswa_alamat);
			$('[name="siswa_rt"]').val(data.siswa_rt);
			$('[name="siswa_rw"]').val(data.siswa_rw);
			$('[name="siswa_kelurahan"]').val(data.siswa_kelurahan);
			$('[name="siswa_kecamatan"]').val(data.siswa_kecamatan);
			$('[name="siswa_kabupaten"]').val(data.siswa_kabupaten);
			$('[name="siswa_provinsi"]').val(data.siswa_provinsi);
			$('[name="siswa_kodepos"]').val(data.siswa_kodepos);
			$('[name="siswa_alattransport"]').val(data.siswa_alattransport);
			$('[name="siswa_jenistinggal"]').val(data.siswa_jenistinggal);
			$('[name="siswa_anakke"]').val(data.siswa_anakke);
			$('[name="siswa_nokps"]').val(data.siswa_nokps);
			$('[name="siswa_nokip"]').val(data.siswa_nokip);
			$('[name="siswa_notelp"]').val(data.siswa_notelp);
			$('[name="siswa_email"]').val(data.siswa_email);
			$('[name="siswa_nama_ayah"]').val(data.siswa_nama_ayah);
			$('[name="siswa_nik_ayah"]').val(data.siswa_nik_ayah);
			$('[name="siswa_tahunlahir_ayah"]').val(data.siswa_tahunlahir_ayah);
			$('[name="siswa_pekerjaan_ayah"]').val(data.siswa_pekerjaan_ayah);
			$('[name="siswa_pendidikan_ayah"]').val(data.siswa_pendidikan_ayah);
			$('[name="siswa_penghasilan_ayah"]').val(data.siswa_penghasilan_ayah);
			$('[name="siswa_nama_ibu"]').val(data.siswa_nama_ibu);
			$('[name="siswa_nik_ibu"]').val(data.siswa_nik_ibu);
			$('[name="siswa_tahunlahir_ibu"]').val(data.siswa_tahunlahir_ibu);
			$('[name="siswa_pekerjaan_ibu"]').val(data.siswa_pekerjaan_ibu);
			$('[name="siswa_pendidikan_ibu"]').val(data.siswa_pendidikan_ibu);
			$('[name="siswa_penghasilan_ibu"]').val(data.siswa_penghasilan_ibu);
			$('[name="siswa_nama_wali"]').val(data.siswa_nama_wali);
			$('[name="siswa_nik_wali"]').val(data.siswa_nik_wali);
			$('[name="siswa_tahunlahir_wali"]').val(data.siswa_tahunlahir_wali);
			$('[name="siswa_pekerjaan_wali"]').val(data.siswa_pekerjaan_wali);
			$('[name="siswa_pendidikan_wali"]').val(data.siswa_pendidikan_wali);
			$('[name="siswa_penghasilan_wali"]').val(data.siswa_penghasilan_wali);
			if (data.siswa_jeniskelamin == "P") {
				$('input:radio[name="siswa_jeniskelamin"]')
					.filter('[value="Perempuan"]')
					.attr("checked", true);
			} else if (data.siswa_jeniskelamin == "L") {
				$('input:radio[name="siswa_jeniskelamin"]')
					.filter('[value="Laki-Laki"]')
					.attr("checked", true);
			}
			if (data.siswa_kps == "YA") {
				$('input:radio[name="siswa_kps"]')
					.filter('[value="YA"]')
					.attr("checked", true);
				$("#siswa_nokps").prop("readonly", false);
			} else if (data.siswa_kps == "TIDAK") {
				$('input:radio[name="siswa_kps"]')
					.filter('[value="TIDAK"]')
					.attr("checked", true);
				$("#siswa_nokps").prop("readonly", true);
			}
			if (data.siswa_kip == "YA") {
				$('input:radio[name="siswa_kip"]')
					.filter('[value="YA"]')
					.attr("checked", true);
				$("#siswa_nokip").prop("readonly", false);
			} else if (data.siswa_kip == "TIDAK") {
				$('input:radio[name="siswa_kip"]')
					.filter('[value="TIDAK"]')
					.attr("checked", true);
				$("#siswa_nokip").prop("readonly", true);
			}
			save_method = "update";
			$("#modal_siswa").modal("show"); // show bootstrap modal when complete loaded
			$(".modal-title").text("Biodata " + data.siswa_nama); // Set title to Bootstrap modal title
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error get data from ajax");
		},
	});
}

function registrasi(id, siswa_nama) {
	$("#form_registrasi")[0].reset(); // reset form on modals
	$("div").removeClass("error");
	$(".help-block").hide();
	$('[name="siswa_id"]').val(id);
	$('[name="siswa_nama"]').val(siswa_nama);
	$("#modal_registrasi").modal("show"); // show bootstrap modal when complete loaded
	$(".modal-title").text("Registrasi Siswa " + siswa_nama); // Set title to Bootstrap modal title
}

function cetaksuratketeranganpindah(id, siswa_nama) {
	$("#form_surat_keterangan_pindah")[0].reset(); // reset form on modals
	$("div").removeClass("error");
	$(".help-block").hide();
	$('[name="siswa_id"]').val(id);
	$('[name="siswa_nama"]').val(siswa_nama);
	$("#modal_cetak_surat_keluar").modal("show"); // show bootstrap modal when complete loaded
	$(".modal-title").text("Cetak Surat Keterangan Pindah " + siswa_nama); // Set title to Bootstrap modal title
}

$("#form_registrasi").submit(function (event) {
	$(".help-block").show();
	event.preventDefault();
	var url;

	if ($("#form_registrasi").jqBootstrapValidation()) {
		// ajax adding data to database
		$.ajax({
			url: "regsiswa",
			type: "POST",
			data: $("#form_registrasi").serialize(),
			dataType: "JSON",
			success: function (data) {
				//if success close modal and reload ajax table
				if (data.status == true) {
					toastr.success("Data Berhasil Disimpan", "BERHASIL ", {
						positionClass: "toast-bottom-full-width",
						containerId: "toast-bottom-full-width",
						closeButton: true,
					});
					$("#modal_registrasi").modal("hide");
					reload_table();
				} else {
					toastr.warning("Semua Form Wajib Diisi!", "Gagal Menyimpan ", {
						positionClass: "toast-bottom-full-width",
						containerId: "toast-bottom-full-width",
						closeButton: true,
					});
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert("Error adding / update data");
			},
		});
	} else {
		toastr.warning("Silahkan Isi Semua Form", "Gagal Menyimpan ", {
			positionClass: "toast-bottom-full-width",
			containerId: "toast-bottom-full-width",
			closeButton: true,
		});
	}
});

$("#form_surat_keterangan_pindah").submit(function (event) {
	// var idsiswa = $("#siswa_id").val();
	// var pindah_ke = $("#pindah_ke").val();
	// var win = window.open('./cetaksuratketeranganpindah/' + idsiswa +'/'+pindah_ke, '_blank');
	if ($("#form_surat_keterangan_pindah").jqBootstrapValidation()) {
		// ajax adding data to database
		$.ajax({
			url: "cetaksuratketeranganpindah",
			type: "POST",
			data: $("#form_surat_keterangan_pindah").serialize(),
			dataType: "JSON",
			success: function (data) {
			},
		});
	} else {
		toastr.warning("Silahkan Isi Semua Form", "Gagal Menyimpan ", {
			positionClass: "toast-bottom-full-width",
			containerId: "toast-bottom-full-width",
			closeButton: true,
		});
	}
});

function formatDate(input) {
	var datePart = input.match(/\d+/g),
		year = datePart[0], // get only two digits
		month = datePart[1],
		day = datePart[2];

	return day + "-" + month + "-" + year;
}
