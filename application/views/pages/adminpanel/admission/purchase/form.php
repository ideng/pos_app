<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master';
$data = ['id' => $row->id, 'drug_view' => 'form', 'detail'];
?>

<div class="box box-primary box-form">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo 'Form ' . ucwords(str_replace('_', ' ', $title)); ?></h3>
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
                    <div class="col-md-8 col-xs-12">
                        <div class="col-md-7" style="margin-top: 15px;">
                            <div class="form-group">
                                <label for="code_supplier_id">ID Supplier</label>
                                <input type="hidden" name="supplier_id" id="supplier_id" value="<?php echo $row->supplier_id; ?>">
                                <input type="hidden" name="no_faktur" id="no_faktur" value="<?php echo $row->no_faktur; ?>">
                                <input type="text" name="code_supplier_id" id="code_supplier_id" class="form-control" placeholder="ID Supplier" value="<?php echo $row->supplier_code; ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-md-7" style="margin-top: 15px;">
                            <div class="form-group">
                                <label for="supplier_name">Nama Supplier</label>
                                <div id="scrollable-dropdown-menu">
                                    <input type="text" name="supplier_name" id="supplier_name" class="form-control" placeholder="Nama Supplier" value="<?php echo $row->supplier_name; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="drugs">Data Barang</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-xs-12">
                        <div class="col-xs-2">
                            <label for="drug_id">Barcode</label>
                        </div>
                        <div class="col-xs-2">
                            <label for="drug_id">Select</label>
                        </div>
                        <div class="col-xs-2">
                            <label for="drug_subtotal">Nama Barang</label>
                        </div>
                        <div class="col-xs-2">
                            <label for="drug_subtotal">Harga</label>
                        </div>
                        <div class="col-xs-2">
                            <label for="drug_subtotal">Jumlah</label>
                        </div>
                        <div class="col-xs-2">
                            <label for="drug_subtotal">Subtotal</label>
                        </div>
                    </div>
                </div>
                <div class="drug-form"></div>
                <hr>
                <div class="row">
                    <label for="drug_bayar" class="col-xs-2">Total Pembayaran :</label>
                    <div class="col-xs-10">
                        <input type="hidden" name="drug_bayar" id="drug_bayar" class="form-control" value="<?php echo $row->total_bayar; ?>">
                        <div id="drug-payment" class="drug-payment"><?php echo $row->total_bayar; ?></div>
                    </div>
                </div>
                <hr>
                <div class="col-xs-2 col-xs-offset-10">
                    <div class="form-group">
                        <button type="reset" class="btn btn-warning btn-flat">Reset</button>
                        <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.box-body -->
    <div class="overlay form-overlay" style="display: none;">
        <i class="fa fa-spinner fa-2x fa-pulse" style="color: #337ab7;"></i>
    </div>

    <?php
    $this->load->view('pages/' . $class_link . '/components/supplier_typeahead');

    $this->load->view('pages/' . $class_link . '/' . $page . '/page_js', $data);
    ?>
</div>