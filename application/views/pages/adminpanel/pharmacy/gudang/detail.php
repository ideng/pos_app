<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master';
?>
<div class="box box-info box-form">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo 'Detail ' . $title; ?></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool btn-remove-form" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="form-alert" style="display: none;"></div>
        <div class="form-loader text-center">
            <i class="fa fa-spinner fa-2x fa-pulse text-primary"></i>
        </div>
        <div class="form-container" style="display: none;">
            <form method="POST" id="formSubmit">
                <input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_value; ?>">
                <input type="hidden" name="url" value="<?php echo base_url($class_link . '/submit_form'); ?>">
                <input type="hidden" name="page" value="<?php echo $page; ?>">
                <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                <div class="row">
                    <label for="drug_name" class="col-xs-2">Nama barang :</label>
                    <div class="col-xs-10"><?php echo $row->drug_name; ?></div>
                </div>
                <div class="row">
                    <label for="barcode" class="col-xs-2">Barcode :</label>
                    <div class="col-xs-10"><?php echo $row->barcode; ?></div>
                </div>
                <div class="row">
                    <label for="type_name" class="col-xs-2">Kategori Barang :</label>
                    <div class="col-xs-10"><?php echo $row->type_name; ?></div>
                </div>
                <div class="row">
                    <label for="sell_price" class="col-xs-2">Harga Jual : </label>
                    <div class="col-xs-10"><?php echo number_format($row->sell_price, '2', ',', '.'); ?></div>
                </div>
                <div class="row">
                    <label for="purchase_price" class="col-xs-2">Harga Beli : </label>
                    <div class="col-xs-10"><?php echo number_format($row->purchase_price, '2', ',', '.'); ?></div>
                </div>
                <div class="row">
                    <label for="description" class="col-xs-2">Deskripsi :</label>
                    <div class="col-xs-10"><?php echo $row->description; ?></div>
                </div>

                <hr>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    Detail Transaksi
                </button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Detail Transaksi <?php echo $row->drug_name; ?></h4>
                            </div>
                            <div class="modal-body">
                                <!-- Main content -->
                                <section class="content">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="box">
                                                <div style="text-align:center" class="box-header">
                                                    <h3 class="box-title">Mutasi Data Pembelian</h3>
                                                </div><!-- /.box-header -->
                                                <div class="box-body">
                                                    <table id="example2" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Tanggal Pembelian</th>
                                                                <th>Nama Barang</th>
                                                                <th>Barcode</th>
                                                                <th>Faktur Pembelian</th>
                                                                <th>Supplier Name</th>
                                                                <th>Harga Beli</th>
                                                                <th>Jml Beli</th>
                                                                <th>Jml Retur Beli</th>
                                                                <th>Jml Pembelian</th>
                                                                <th>Nominal Beli</th>
                                                                <th>Nominal Retur Beli</th>
                                                                <th>Nominal Pembelian</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $no = 0;
                                                            foreach ($mutasi_beli as $mutasi_belis) {
                                                                $no++; ?>
                                                                <tr>
                                                                    <td><?php echo $mutasi_belis->tanggal; ?></td>
                                                                    <td><?php echo $mutasi_belis->nama_obat; ?></td>
                                                                    <td><?php echo $mutasi_belis->barcode; ?></td>
                                                                    <td><?php echo $mutasi_belis->faktur_pembelian; ?></td>
                                                                    <td><?php echo $mutasi_belis->supplier_name; ?></td>
                                                                    <td><?php echo $mutasi_belis->harga_beli; ?></td>
                                                                    <td><?php echo $mutasi_belis->jml_beli; ?></td>
                                                                    <td><?php echo $mutasi_belis->jml_retur_beli; ?></td>
                                                                    <td><?php echo $mutasi_belis->jml_pembelian; ?></td>
                                                                    <td><?php echo $mutasi_belis->nominal_beli; ?></td>
                                                                    <td><?php echo $mutasi_belis->nominal_retur_beli; ?></td>
                                                                    <td><?php echo $mutasi_belis->nominal_pembelian; ?></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="box">
                                                <div style="text-align:center" class="box-header">
                                                    <h3 class="box-title">Mutasi Data Penjualan</h3>
                                                </div><!-- /.box-header -->
                                                <div class="box-body">
                                                    <table id="example2" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Tanggal Penjualan</th>
                                                                <th>Nama Barang</th>
                                                                <th>Barcode</th>
                                                                <th>Faktur Penjualan</th>
                                                                <th>Nama Pasien</th>
                                                                <th>Harga Jual</th>
                                                                <th>Jml Jual</th>
                                                                <th>Jml Retur Jual</th>
                                                                <th>Jml Penjualan</th>
                                                                <th>Nominal Jual</th>
                                                                <th>Nominal Retur Jual</th>
                                                                <th>Nominal Penjualan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $no = 0;
                                                            foreach ($mutasi_jual as $mutasi_juals) {
                                                                $no++;
                                                                if ($mutasi_juals->tanggal == null) { ?>
                                                                    <tr>
                                                                        <td colspan='11' align="center"><?php echo '-- Tidak Ada Data --'; ?></td>
                                                                    </tr>
                                                                <?php
                                                                    } else {
                                                                        ?>
                                                                    <tr>
                                                                        <td><?php echo $mutasi_juals->tanggal; ?></td>
                                                                        <td><?php echo $mutasi_juals->nama_obat; ?></td>
                                                                        <td><?php echo $mutasi_juals->barcode; ?></td>
                                                                        <td><?php echo $mutasi_juals->faktur_penjualan; ?></td>
                                                                        <td><?php echo $mutasi_juals->nama_pasien; ?></td>
                                                                        <td><?php echo $mutasi_juals->harga_jual; ?></td>
                                                                        <td><?php echo $mutasi_juals->jml_jual; ?></td>
                                                                        <td><?php echo $mutasi_juals->jml_retur_jual; ?></td>
                                                                        <td><?php echo $mutasi_juals->jml_penjualan; ?></td>
                                                                        <td><?php echo $mutasi_juals->nominal_jual; ?></td>
                                                                        <td><?php echo $mutasi_juals->numinal_retur; ?></td>
                                                                        <td><?php echo $mutasi_juals->nominal_penjualan; ?></td>
                                                                    </tr>

                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.box-body -->
    <div class="overlay form-overlay" style="display: none;">
        <i class="fa fa-spinner fa-2x fa-pulse" style="color: #337ab7;"></i>
    </div>
</div>