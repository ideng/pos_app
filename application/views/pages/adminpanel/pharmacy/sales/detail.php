<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master';
$data = ['id' => $row->id, 'drug_view' => 'detail'];
?>

<div class="box box-info box-form">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?> Detail</h3>
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
                    <label for="civilian_id_patient" class="col-xs-2">NIK : </label>
                    <div class="col-xs-10"><?php echo $row->civilian_id_patient; ?></div>
                </div>
                <div class="row">
                    <label for="no_faktur" class="col-xs-2">No Faktur : </label>
                    <div class="col-xs-10"><?php echo $row->no_faktur; ?></div>
                </div>
                <div class="row">
                    <label for="patient_name" class="col-xs-2">Nama Pasien : </label>
                    <div class="col-xs-10"><?php echo $row->patient_name; ?></div>
                </div>
                <div class="row">
                    <label for="total_price" class="col-xs-2">Total Harga : </label>
                    <div class="col-xs-10"><?php echo $row->total_price; ?></div>
                </div>
                <div class="row">
                    <label for="created_at" class="col-xs-2">Dibuat Pada :</label>
                    <div class="col-xs-10"><?php echo $row->created_at; ?></div>
                </div>
                <div class="row">
                    <label for="updated_at" class="col-xs-2">Diubah Pada :</label>
                    <div class="col-xs-10"><?php echo $row->updated_at; ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="drugs">Data Obat</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-xs-12">
                        <div class="col-xs-3">
                            <label for="drug_id">Nama</label>
                        </div>
                        <div class="col-xs-3">
                            <label for="drug_price">Harga</label>
                        </div>
                        <div class="col-xs-3">
                            <label for="drug_quantity">Jumlah</label>
                        </div>
                        <div class="col-xs-3">
                            <label for="drug_subtotal">Subtotal</label>
                        </div>
                    </div>
                </div>
                <div class="drug-form"></div>
                <hr>
            </form>
        </div>
    </div><!-- /.box-body -->
    <div class="overlay form-overlay" style="display: none;">
        <i class="fa fa-spinner fa-2x fa-pulse" style="color: #337ab7;"></i>
    </div>

    <?php
    $this->load->view('pages/' . $class_link . '/' . $page . '/page_js', $data);
    ?>
</div>