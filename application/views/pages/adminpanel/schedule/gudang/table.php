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
</style>
<div class="table-responsive">
	<div class="row">
		<div class="input-name">
			<!--<div class="col-md-2">
				<label for="">&nbsp</label><br />
				<label for="">Pilih Nama :</label>
			</div>
			<div class="col-md-3">
				<label for="">Nama Barang</label>
				<input type="text" name='name_view' id='name_view' class="form-control" value="" required>
			</div>
			<div class="col-md-3">
				<label for="">&nbsp</label>
				<input type="hidden" name='id_name' id='id_name' class="form-control date-picker" value="" required>
			</div>
			<div class="col-md-4">
				<label for="">&nbsp</label>
				<label for="">&nbsp</label>
			</div>
			<button type="button" id="btnDetailTransaksiName" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
				Detail
			</button>-->
			<?php
			$this->load->view('pages/' . $class_link . '/components/drug_typeahead');
			?>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Detail Transaksi</h4>
					</div>
					<div id="printThis2" class="modal-name"></div>
				</div>
			</div>
		</div>
	</div>
	<table class="table table-bordered table-striped table-hover" style="width: 100%;">
		<thead>
			<tr>
			<tr>
				<th colspan='3'></th>
				<th style='text-align:center' colspan='2'>Data Barang</th>
				<th style='text-align:center' colspan='3'>Stock Pembelian</th>
				<th style='text-align:center' colspan='3'>Nominal Pembelian</th>
				<th style='text-align:center' colspan='3'>Stock Penjualan</th>
				<th style='text-align:center' colspan='3'>Nominal Penjualan</th>
				<th style='text-align:center' colspan='2'>Stock Akhir</th>
			</tr>
			<th>No</th>
			<th style='text-align:center'>Opsi</th>
			<th>ID</th>
			<th>Nama</th>
			<th>Barcode</th>

			<th>Beli</th>
			<th>Retur</th>
			<th>Total</th>

			<th>Beli</th>
			<th>Retur</th>
			<th>Total</th>

			<th>Jual</th>
			<th>Retur</th>
			<th>Total</th>

			<th>Jual</th>
			<th>Retur</th>
			<th>Total</th>

			<th style='text-align:center'>Jumlah</th>

			<th style='text-align:center'>Status</th>
			</tr>
		</thead>
	</table>
</div>
<!--
<div class="box-body">
	<table class="table table-bordered">
		<tr>
			<th style="width: 10px">#</th>
			<th>Task</th>
			<th>Progress</th>
			<th style="width: 40px">Label</th>
		</tr>
		<tr>
			<td>1.</td>
			<td>Update software</td>
			<td>
				<div class="progress progress-xs">
					<div class="progress-bar progress-bar-danger" style="width: 10%"></div>
				</div>
			</td>
			<td><span class="badge bg-red">55%</span></td>
		</tr>
		<tr>
			<td>2.</td>
			<td>Clean database</td>
			<td>
				<div class="progress progress-xs">
					<div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
				</div>
			</td>
			<td><span class="badge bg-yellow">70%</span></td>
		</tr>
		<tr>
			<td>3.</td>
			<td>Cron job running</td>
			<td>
				<div class="progress progress-xs progress-striped active">
					<div class="progress-bar progress-bar-primary" style="width: 30%"></div>
				</div>
			</td>
			<td><span class="badge bg-light-blue">30%</span></td>
		</tr>
		<tr>
			<td>4.</td>
			<td>Fix and squish bugs</td>
			<td>
				<div class="progress progress-xs progress-striped active">
					<div class="progress-bar progress-bar-success" style="width: 90%"></div>
				</div>
			</td>
			<td><span class="badge bg-green">90%</span></td>
		</tr>
	</table>
</div><!-- /.box-body -->

<script type="text/javascript">
	$('#start_date').datetimepicker({
		'format': 'DD-MM-YYYY'
	});
	$('#end_date').datetimepicker({
		'format': 'DD-MM-YYYY'
	});
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
	var table = $('.table').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": true,
		"ajax": {
			"url": "<?php echo base_url($class_link . '/table_data'); ?>",
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