<?php
defined('BASEPATH') or exit('No direct script access allowed!');
?>

<style type="text/css">
	td.dt-center {
		text-align: center;
	}

	td.dt-right {
		text-align: right;
	}

	td.dt-left {
		text-align: left;
	}

	@media screen {
		#printSection {
			display: none;
		}
	}

	@media print {
		body * {
			visibility: hidden;
		}

		#printSection,
		#printSection * {
			visibility: visible;
		}

		#printSection {
			position: absolute;
			left: 0;
			top: 0;
		}
	}
</style>

<div class="input-daterange">
	<div class="col-md-2">
		<label for="">&nbsp</label><br />
		<label for="">Pilih Tanggal :</label>
	</div>
	<div class="col-md-3">
		<label for="">Tanggal Awal</label>
		<input type="text" name='start_date' id='start_date' class="form-control date-picker" value="<?php echo date('d-m-Y') ?>" required>
	</div>
	<div class="col-md-3">
		<label for="">Tanggal Akhir</label>
		<input type="text" name='end_date' id='end_date' class="form-control date-picker" value="<?php echo date('d-m-Y') ?>" required>
	</div>
	<div class="col-md-4">
		<label for="">&nbsp</label>
	</div>
	<button type="button" id="btnDetailTransaksi" class="btn btn-primary" data-toggle="modal" data-target="#myModals">
		Detail Transaksi
	</button>
</div>

<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Detail Transaksi</h4>
			</div>
			<div id="printThis" class="modal-body"></div>
			<button type="button" id="Print" class="btn btn-primary">Print</button>
		</div>
	</div>
</div>
<hr>
<div>
	<H3 style="text-align:center">Mutasi Data Penjualan Hari ini</H3>
</div>
<table class="table table-bordered table-striped table-hover table3" style="width: 100%;">
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal Penjualan</th>
			<th>ID</th>
			<th>No Faktur</th>
			<th>Nama Customer</th>
			<th>Nama Barang</th>
			<th>Harga Jual</th>
			<th>Jml Jual</th>
			<th>Retur Jual</th>
			<th>Jml Penjualan</th>
			<th>nominal jual</th>
			<th>nominal Retur</th>
			<th>Total Penjualan</th>
		</tr>
	</thead>
</table>
<table class="table table-bordered table-striped table-hover" style="width: 100%;">
	<thead>
		<tr>
			<th colspan="9"></th>
			<th>Nominal Jual</th>
			<th>Nominal Retur Jual</th>
			<th>Total Penjualan</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="9"><span style="font-weight:bold">Total Penjualan Hari ini</span></td>
			<td><?php echo number_format(empty_string($mutasi_penjualan_now->nominal_jual, '0'), 2, ',', '.'); ?></td>
			<td><?php echo number_format(empty_string($mutasi_penjualan_now->numinal_retur, '0'), 2, ',', '.'); ?></td>
			<td><?php echo number_format(empty_string($mutasi_penjualan_now->nominal_penjualan, '0'), 2, ',', '.'); ?></td>
		</tr>
	</tbody>
</table>

<script>
	$('.date-picker').datetimepicker({
		'format': 'DD-MM-YYYY'
	});
	document.getElementById("Print").onclick = function() {
		printElement(document.getElementById("printThis"));
	};

	function printElement(elem) {
		var domClone = elem.cloneNode(true);

		var $printSection = document.getElementById("printSection");

		if (!$printSection) {
			var $printSection = document.createElement("div");
			$printSection.id = "printSection";
			document.body.appendChild($printSection);
		}

		$printSection.innerHTML = "";
		$printSection.appendChild(domClone);
		window.print();
	}
</script>

<script type="text/javascript">
	$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
		return {
			"iStart": oSettings._iDisplayStart,
			"iEnd": oSettings.fnDisplayEnd(),
			"iLength": oSettings._iDisplayLength,
			"iTotal": oSettings.fnRecordsTotal(),
			"iFilteredTotal": oSettings.fnRecordsDisplay(),
			"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
			"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
		};
	};
	var table = $('.table3').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": true,
		"ajax": {
			"url": "<?php echo base_url($class_link . '/table_datas'); ?>",
			"type": "GET",
			"data": {
				"page": "<?php echo $page; ?>"
			}
		},
		"language": {
			"lengthMenu": "Tampilkan _MENU_ data",
			"zeroRecords": "Maaf tidak ada data yang ditampilkan",
			"info": "Menampilkan data _START_ sampai _END_ dari _TOTAL_ data",
			"infoFiltered": "",
			"infoEmpty": "Tidak ada data yang ditampilkan",
			"search": "Cari :",
			"loadingRecords": "Memuat Data...",
			"processing": "Sedang Memproses...",
			"paginate": {
				"first": '<span class="glyphicon glyphicon-fast-backward"></span>',
				"last": '<span class="glyphicon glyphicon-fast-forward"></span>',
				"next": '<span class="glyphicon glyphicon-forward"></span>',
				"previous": '<span class="glyphicon glyphicon-backward"></span>'
			}
		},
		"columnDefs": [{
				"data": null,
				"searchable": false,
				"orderable": false,
				"className": "dt-center",
				"targets": 0
			},
			{
				"searchable": false,
				"orderable": false,
				"targets": 1
			},
			{
				"className": "dt-center",
				"targets": 2,
				"visible": false,
				"searchable": false
			},
		],
		"order": [2, 'asc'],
		"rowCallback": function(row, data, iDisplayIndex) {
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			var index = page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
		}
	});
</script>