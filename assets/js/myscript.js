$(document).ready(function () {
	//tabel angkatan
	$("#tabelAngkatan").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "Angkatan/get_data_angkatan",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 2, 3],
				orderable: false,
			},
		],
	});

	//tabel spp
	$("#tabelSpp").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "Spp/get_data_spp",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 2, 3, 4, 5],
				orderable: false,
			},
		],
	});

	//tabel buku
	$("#tabelBuku").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "Buku/get_data_buku",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 2, 3],
				orderable: false,
			},
		],
	});

	//tabel jurusan
	$("#tabelJurusan").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "Jurusan/get_data_jurusan",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 2],
				orderable: false,
			},
		],
	});

	//tabel kelas
	$("#tabelKelas").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "Kelas/get_data_kelas",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 2, 3],
				orderable: false,
			},
		],
	});

	//tabel petugas
	$("#tabelPetugas").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "Petugas/get_data_petugas",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 2, 3, 4, 5],
				orderable: false,
			},
		],
	});

	//tabel siswa
	$("#tabelSiswa").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "Siswa/get_data_siswa",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 1, 2, 4, 5, 6, 7, 8, 9, 10, 11],
				orderable: false,
			},
		],
	});

	//tabel tagihan buku
	$("#tabelTagihanBuku").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "TagihanBuku/get_data_tagihan_buku",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 1, 3, 4, 5, 6],
				orderable: false,
			},
		],
	});

	//tabel tagihan spp
	$("#tabelTagihanSpp").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "TagihanSpp/get_data_tagihan_spp",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 1, 4, 5, 6, 7, 8, 9],
				orderable: false,
			},
		],
	});

	//tabel transaksi gedung
	$("#tabelTaransaksiGedung").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "TransaksiGedung/get_data_transaksi_gedung",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 1, 2, 4, 5, 6, 7, 8],
				orderable: false,
			},
		],
	});

	//tabel transaksi gedung
	$("#tabelTaransaksiBuku").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "TransaksiBuku/get_data_transaksi_buku",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 1, 2, 4, 5, 6, 7, 8, 9],
				orderable: false,
			},
		],
	});

	//tabel transaksi pendaftaran
	$("#tabelTaransaksiPendaftaran").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "TransaksiPendaftaran/get_data_transaksi_pendaftaran",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 1, 2, 4, 5, 6, 7, 8],
				orderable: false,
			},
		],
	});

	//tabel transaksi spp
	$("#tabelTaransaksiSpp").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "TransaksiSpp/get_data_transaksi_spp",
			type: "POST",
		},

		columnDefs: [
			{
				targets: [0, 1, 2, 4, 5, 6, 7, 8, 9],
				orderable: false,
			},
		],
	});

	//tabel jurnal
	var tablejurnal = $("#tabelJurnal").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "Jurnal/get_data_jurnal",
			type: "POST",
			data: function (data) {
				data.bulan = $(".bulan").val();
				data.tahun = $(".tahun").val();
			},
		},

		columnDefs: [
			{
				targets: [0, 2, 3, 4, 5, 6],
				orderable: false,
			},
		],
	});

	//tabel jurnalpemasukan
	var tablepemasukan = $("#tabelJurnalPemasukan").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "Pemasukan/get_data_pemasukan",
			type: "POST",
			data: function (data) {
				data.bulan = $(".bulan").val();
				data.tahun = $(".tahun").val();
			},
		},

		columnDefs: [
			{
				targets: [0, 2, 3, 4],
				orderable: false,
			},
		],
	});

	//tabel jurnalpengeluaran
	var tablepengeluaran = $("#tabelJurnalPengeluaran").DataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "Pengeluaran/get_data_pengeluaran",
			type: "POST",
			data: function (data) {
				data.bulan = $(".bulan").val();
				data.tahun = $(".tahun").val();
			},
		},

		columnDefs: [
			{
				targets: [0, 2, 3, 4],
				orderable: false,
			},
		],
	});

	$(".bulan").change(function () {
		tablejurnal.ajax.reload();
		tablepemasukan.ajax.reload();
		tablepengeluaran.ajax.reload();
	});
	$(".tahun").change(function () {
		tablejurnal.ajax.reload();
		tablepemasukan.ajax.reload();
		tablepengeluaran.ajax.reload();
	});

	//btn cari
	$(".cari").on("click", function () {
		let kelas = $('[name="kelas"]').val();
		let jurusan = $('[name="jurusan"]').val();
		let angkatan = $('[name="angkatan"]').val();
		// console.log(kelas);
		$.ajax({
			url: base_url + "TagihanSpp/get_data_siswa",
			type: "post",
			dataType: "json",
			data: { kelas: kelas, jurusan: jurusan, angkatan: angkatan },
			success: function (data) {
				let cekbox = "";
				let notif = "";
				if (data !== null) {
					data.forEach(function (data) {
						cekbox +=
							"<div class='custom-control custom-checkbox'><input type='checkbox'class='form-check-input form-check-success' checked name='siswa[][nisn]' value='" +
							data.nisn_siswa +
							"'><label class='form-check-label'>" +
							data.nama_siswa +
							"</label></div>";
					});
				} else {
					notif +=
						"<button type='button'class='btn btn-block btn-danger me-1 mb-1'>Data tidak ditemukan</button>";
				}
				$('[name="angkatan"]').val(angkatan);
				$('[name="kelas"]').val(kelas);
				$(".tambah").removeClass("d-none");
				$(".form-check").html(cekbox);
				$(".notif").html(notif);
				$(".list-buku").removeClass("d-none");
			},
		});
	});

	//bnt tagihan-buku
	$(".tagihan-buku").on("click", function () {
		let kelas = $('[name="kelas"]').val();
		let jurusan = $('[name="jurusan"]').val();
		let angkatan = $('[name="angkatan"]').val();
		// console.log(kelas);
		$.ajax({
			url: base_url + "TagihanBuku/get_data_siswa",
			type: "post",
			dataType: "json",
			data: { kelas: kelas, jurusan: jurusan, angkatan: angkatan },
			success: function (data) {
				let cekbox = "";
				let notif = "";
				let labelSiswa = "<p>Data siswa</p>";
				if (data !== null) {
					data.forEach(function (data) {
						cekbox +=
							"<div class='custom-control custom-checkbox'><input type='checkbox'class='form-check-input form-check-success' checked name='siswa[][nisn]' value='" +
							data.nisn_siswa +
							"'><label class='form-check-label'>" +
							data.nama_siswa +
							"</label></div>";
					});
				} else {
					notif +=
						"<button type='button'class='btn btn-block btn-danger me-1 mb-1'>Data tidak ditemukan</button>";
				}
				$('[name="kelas"]').val(kelas);
				$(".tambah").removeClass("d-none");
				$(".form-check").html(cekbox);
				$(".notif").html(notif);
				$(".label-siswa").html(labelSiswa);
			},
		});
		$.ajax({
			url: base_url + "TagihanBuku/get_data_buku",
			type: "post",
			dataType: "json",
			success: function (data) {
				let buku = "";
				let notif = "";
				let labelBuku = " <p>Daftar list buku</p>";
				if (data !== null) {
					data.forEach(function (data) {
						buku +=
							"<li class='d-inline-block me-2 mb-1'><div class='form-check'><div class='custom-control custom-checkbox'><input type='checkbox'class='form-check-input form-check-success' checked name='buku[][nama]' value='" +
							data.id_buku +
							"/" +
							data.harga_buku +
							"'><label class='form-check-label'>" +
							data.nama_buku +
							"</label></div></div></li>";
					});
				} else {
					notif +=
						"<button type='button'class='btn btn-block btn-danger me-1 mb-1'>Data tidak ditemukan</button>";
				}
				$(".notif-buku").html(notif);
				$(".list-buku").html(buku);
				$(".label-buku").html(labelBuku);
			},
		});
	});

	//btn transaksi-gedung
	$(".transaksi-gedung").on("click", function () {
		let id = $('[name="nisn"]').val();
		$.ajax({
			url: base_url + "TransaksiGedung/get_data_siswa",
			type: "post",
			dataType: "json",
			data: { id: id },
			success: function (data) {
				if (data !== null) {
					$('[name="nisn"]').val("");
					$(".biodata").removeClass("d-none");
					$(".bayar").removeClass("d-none");
					$(".history").removeClass("d-none");
					$('[name="nama"]').val(data.nama_siswa);
					$('[name="no_tlp"]').val(data.no_telp);
					$('[name="alamat"]').text(data.alamat);
					$('[name="id"]').val(data.id_tagihan_gedung);
					$('[name="nisn"]').val(data.nisn_siswa);
					let total = data.nominal_gedung - data.jumlah_bayar;
					if (data.jenis_kelamin == "laki-laki") {
						$(".laki-laki").attr("checked", "checked");
					} else {
						$(".perempuan").attr("checked", "checked");
					}
					if (data.profile !== null) {
						$(".foto").attr("src", base_url + "assets/images/" + data.profile);
					}
					if (data.jumlah_bayar !== null) {
						$('[name="sisa_bayar"]').val(
							data.nominal_gedung - data.jumlah_bayar
						);
					} else if (data.jumlah_bayar == null) {
						$('[name="sisa_bayar"]').val(data.nominal_gedung);
					}
					if (total == 0) {
						$(".bayar-gedung").attr("disabled", "disabled");
					}
				}
			},
		});
		$.ajax({
			url: base_url + "TransaksiGedung/get_data_histori",
			type: "post",
			dataType: "json",
			data: { id: id },
			success: function (data) {
				let tabel = "";
				let no = 1;
				data.forEach(function (data) {
					tabel +=
						"<tr><td>" +
						no++ +
						"</td><td>" +
						data.keterangan +
						"</td><td>" +
						data.tanggal_bayar +
						"</td><td>" +
						data.jumlah_bayar +
						"</td><td>" +
						data.nama_petugas +
						"</td></tr>";
				});
				$("#tabelHistoriTransaksiGedung").html(tabel);
			},
		});
	});

	//btn bayar-gedung
	$(".bayar-gedung").on("click", function () {
		let keterangan = $('[name="keterangan"]').val();
		let jumlah = $('[name="jumlah_bayar"]').val();
		let id = $('[name="id"]').val();
		let nisn = $('[name="nisn"]').val();
		$.ajax({
			url: base_url + "TransaksiGedung/proses_tambah",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				keterangan: keterangan,
				jumlah_bayar: jumlah,
				nisn: nisn,
			},
			success: function (data) {
				if (data) {
					window.location = base_url + "transaksigedung/tambah?nisn=" + nisn;
				}
			},
		});
	});

	//btn transaksi-buku
	$(".transaksi-buku").on("click", function () {
		let id = $('[name="nisn"]').val();
		let kelas = $('[name="kelas"]').val();
		$.ajax({
			url: base_url + "TransaksiBuku/get_data_siswa",
			type: "post",
			dataType: "json",
			data: { id: id, kelas: kelas },
			success: function (data) {
				if (data !== null) {
					$('[name="nisn"]').val("");
					$(".biodata").removeClass("d-none");
					$(".bayar").removeClass("d-none");
					$(".history").removeClass("d-none");
					$('[name="nama"]').val(data.nama_siswa);
					$('[name="no_tlp"]').val(data.no_telp);
					$('[name="alamat"]').text(data.alamat);
					$('[name="id"]').val(data.id_tagihan_buku);
					$('[name="kelas"]').val("Kelas " + data.nama_kelas);
					$('[name="nisn"]').val(data.nisn_siswa);
					$(".kelas").val(kelas);
					let total = data.total_nominal_buku - data.jumlah_bayar;
					if (data.jenis_kelamin == "laki-laki") {
						$(".laki-laki").attr("checked", "checked");
					} else {
						$(".perempuan").attr("checked", "checked");
					}
					if (data.profile !== null) {
						$(".foto").attr("src", base_url + "assets/images/" + data.profile);
					}
					if (data.jumlah_bayar !== null) {
						$('[name="sisa_bayar"]').val(
							data.total_nominal_buku - data.jumlah_bayar
						);
					} else if (data.jumlah_bayar == null) {
						$('[name="sisa_bayar"]').val(data.total_nominal_buku);
					}
					if (total == 0) {
						$(".bayar-buku").attr("disabled", "disabled");
						$(".bayar-buku").text("LUNAS");
					}
				} else {
					$(".alert-tagihan-buku").removeClass("d-none");
					$('[name="nisn"]').val("");
					$('[name="kelas"]').val("");
				}
			},
		});
		$.ajax({
			url: base_url + "TransaksiBuku/get_data_histori",
			type: "post",
			dataType: "json",
			data: { id: id, kelas: kelas },
			success: function (data) {
				let tabel = "";
				let no = 1;
				data.forEach(function (data) {
					tabel +=
						"<tr><td>" +
						no++ +
						"</td><td>" +
						data.keterangan +
						"</td><td>" +
						data.tanggal_bayar +
						"</td><td>" +
						data.jumlah_bayar +
						"</td><td>" +
						data.nama_petugas +
						"</td></tr>";
				});
				$("#tabelHistoriTransaksiBuku").html(tabel);
			},
		});
	});

	//btn bayar-buku
	$(".bayar-buku").on("click", function () {
		let keterangan = $('[name="keterangan"]').val();
		let jumlah = $('[name="jumlah_bayar"]').val();
		let id = $('[name="id"]').val();
		let nisn = $('[name="nisn"]').val();
		$.ajax({
			url: base_url + "TransaksiBuku/proses_tambah",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				keterangan: keterangan,
				jumlah_bayar: jumlah,
				nisn: nisn,
			},
			success: function (data) {
				if (data) {
					window.location = base_url + "transaksibuku/tambah";
				}
			},
		});
	});

	//btn transaksi-pendaftaran
	$(".transaksi-pendaftaran").on("click", function () {
		let id = $('[name="nisn"]').val();
		$.ajax({
			url: base_url + "TransaksiPendaftaran/get_data_siswa",
			type: "post",
			dataType: "json",
			data: { id: id },
			success: function (data) {
				if (data !== null) {
					$('[name="nisn"]').val("");
					$(".biodata").removeClass("d-none");
					$(".bayar").removeClass("d-none");
					$(".history").removeClass("d-none");
					$('[name="nama"]').val(data.nama_siswa);
					$('[name="no_tlp"]').val(data.no_telp);
					$('[name="alamat"]').text(data.alamat);
					$('[name="id"]').val(data.id_transaksi_pendaftaran);
					$('[name="nisn"]').val(data.nisn_siswa);
					// let total = data.nominal_gedung - data.jumlah_bayar;
					if (data.jenis_kelamin == "laki-laki") {
						$(".laki-laki").attr("checked", "checked");
					} else {
						$(".perempuan").attr("checked", "checked");
					}
					if (data.profile !== null) {
						$(".foto").attr("src", base_url + "assets/images/" + data.profile);
					}
					if (data.jumlah_bayar !== null) {
						$(".bayar-pendaftaran").attr("disabled", "disabled");
						$(".bayar-pendaftaran").text("Lunas");
					} else if (data.jumlah_bayar == null) {
						$('[name="jumlah_bayar"]').val(data.nominal_pendaftaran);
						$('[name="keterangan"]').val("LUNAS");
					}
				}
			},
		});
		$.ajax({
			url: base_url + "TransaksiPendaftaran/get_data_histori",
			type: "post",
			dataType: "json",
			data: { id: id },
			success: function (data) {
				let tabel = "";
				let no = 1;
				data.forEach(function (data) {
					tabel +=
						"<tr><td>" +
						no++ +
						"</td><td>" +
						data.keterangan +
						"</td><td>" +
						data.tanggal_bayar +
						"</td><td>" +
						data.jumlah_bayar +
						"</td><td>" +
						data.nama_petugas +
						"</td></tr>";
				});
				$("#tabelHistoriTransaksiGedung").html(tabel);
			},
		});
	});

	//btn bayar-pendaftaran
	$(".bayar-pendaftaran").on("click", function () {
		let keterangan = $('[name="keterangan"]').val();
		let jumlah = $('[name="jumlah_bayar"]').val();
		let id = $('[name="id"]').val();
		let nisn = $('[name="nisn"]').val();
		$.ajax({
			url: base_url + "TransaksiPendaftaran/proses_tambah",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				keterangan: keterangan,
				jumlah_bayar: jumlah,
				nisn: nisn,
			},
			success: function (data) {
				if (data) {
					window.location = base_url + "transaksipendaftaran/tambah";
				}
			},
		});
	});

	//btn transaksi-spp
	$(".transaksi-spp").on("click", function () {
		let id = $('[name="nisn"]').val();
		let kelas = $('[name="kelas"]').val();
		$.ajax({
			url: base_url + "TransaksiSpp/get_data_siswa",
			type: "post",
			dataType: "json",
			data: { id: id, kelas: kelas },
			success: function (data) {
				console.log(data);
				if (data !== null) {
					$('[name="nisn"]').val("");
					$(".biodata").removeClass("d-none");
					$(".bayar").removeClass("d-none");
					$(".history").removeClass("d-none");
					$('[name="nama"]').val(data.nama_siswa);
					$('[name="no_tlp"]').val(data.no_telp);
					$('[name="alamat"]').text(data.alamat);
					$('[name="nisn"]').val(data.nisn_siswa);
					$('[name="kelas"]').val(kelas);
					if (data.jenis_kelamin == "laki-laki") {
						$(".laki-laki").attr("checked", "checked");
					} else {
						$(".perempuan").attr("checked", "checked");
					}
					if (data.profile !== null) {
						$(".foto").attr("src", base_url + "assets/images/" + data.profile);
					}
				} else {
					$(".alert-tagihan-spp").removeClass("d-none");
					$('[name="nisn"]').val("");
					$('[name="kelas"]').val("");
				}
			},
		});
		$.ajax({
			url: base_url + "TransaksiSpp/get_data_histori",
			type: "post",
			dataType: "json",
			data: { id: id, kelas: kelas },
			success: function (data) {
				let tabel = "";
				let no = 1;
				data.forEach(function (data) {
					tabel +=
						"<tr><td>" +
						no++ +
						"</td><td>" +
						data.bulan_spp +
						" / " +
						data.tahun_spp +
						"</td><td>" +
						data.keterangan +
						"</td><td>" +
						data.tanggal_bayar +
						"</td><td>" +
						data.jumlah_bayar +
						"</td><td>" +
						data.nama_petugas +
						"</td></tr>";
				});
				$("#tabelHistoriTransaksiSpp").html(tabel);
			},
		});
		$.ajax({
			url: base_url + "TransaksiSpp/get_data_transaksi",
			type: "post",
			dataType: "json",
			data: { id: id, kelas: kelas },
			success: function (data) {
				let a = "";
				let total = 0;
				data.forEach(function (data) {
					total += Number(data.nominal_spp);
					a +=
						"<option value='" +
						data.id_transaksi_spp +
						"'  data-nominal=" +
						data.nominal_spp +
						">" +
						data.bulan_spp +
						" / " +
						data.tahun_spp +
						"</option>";
				});
				$("[name='tagihan-spp']").html(a);
				$("[name='sisa_bayar']").val(total);
			},
		});
	});

	//btn tagihan-spp
	$(".bulan").change(function () {
		let id = $(this).val();
		let nominal = $(".bulan option:selected").data("nominal");
		$('[name="id"]').val(id);
		$('[name="jumlah_bayar"]').val(nominal);
		$('[name="keterangan"]').val("LUNAS");
	});

	//btn bayar-spp
	$(".bayar-spp").on("click", function () {
		let keterangan = $('[name="keterangan"]').val();
		let jumlah = $('[name="jumlah_bayar"]').val();
		let id = $('[name="id"]').val();
		let nisn = $('[name="nisn"]').val();
		$.ajax({
			url: base_url + "TransaksiSpp/proses_tambah",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				keterangan: keterangan,
				jumlah_bayar: jumlah,
				nisn: nisn,
			},
			success: function (data) {
				if (data) {
					window.location = base_url + "transaksispp/tambah";
				}
			},
		});
	});
});
