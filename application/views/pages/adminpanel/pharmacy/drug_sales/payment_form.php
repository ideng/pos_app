<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master';
$data = ['id' => $diagnose->id, 'drug_view' => 'payment_form'];
?>

<div class="box box-info box-form">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo 'Form Pembayaran Resep'; ?></h3>
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
            <form method="POST" id="formPayment">
                <input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_value; ?>">
                <input type="hidden" name="url" value="<?php echo base_url($class_link . '/submit_payment'); ?>">
                <input type="hidden" name="page" value="<?php echo $page; ?>">
                <input type="hidden" name="id" value="<?php echo $diagnose->id; ?>">
                <div class="row">
                    <label for="no_faktur_checkup" class="col-xs-2">No Faktur :</label>
                    <div class="col-xs-10"><?php echo $diagnose->no_faktur_checkup; ?></div>
                </div>
                <div class="row">
                    <label for="medical_record_id" class="col-xs-2">No. Rekam Medis :</label>
                    <div class="col-xs-10"><?php echo $diagnose->medical_record_id; ?></div>
                </div>
                <div class="row">
                    <label for="patient_civilian_id" class="col-xs-2">NIK :</label>
                    <div class="col-xs-10"><?php echo $diagnose->patient_civilian_id; ?></div>
                </div>
                <div class="row">
                    <label for="patient_name" class="col-xs-2">Nama Pasien : </label>
                    <div class="col-xs-10"><?php echo $diagnose->patient_name; ?></div>
                </div>
                <div class="row">
                    <label for="date_in" class="col-xs-2">Tgl Checkup :</label>
                    <div class="col-xs-10"><?php echo format_date($diagnose->date_in, 'd-m-Y'); ?></div>
                </div>
                <div class="row">
                    <label for="poly_name" class="col-xs-2">Nama Poli :</label>
                    <div class="col-xs-10"><?php echo $diagnose->poly_name; ?></div>
                </div>
                <div class="row">
                    <label for="doctor_name" class="col-xs-2">Nama Dokter :</label>
                    <div class="col-xs-10"><?php echo $diagnose->doctor_name; ?></div>
                </div>
                <div class="row">
                    <label for="description" class="col-xs-2">Deskripsi :</label>
                    <div class="col-xs-10"><?php echo $diagnose->description; ?></div>
                </div>
                <div class="row">
                    <label for="created_at" class="col-xs-2">Dibuat Pada :</label>
                    <div class="col-xs-10"><?php echo $diagnose->created_at; ?></div>
                </div>
                <div class="row">
                    <label for="updated_at" class="col-xs-2">Diubah Pada :</label>
                    <div class="col-xs-10"><?php echo $diagnose->updated_at; ?></div>
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
                        <div class="col-xs-2">
                            <label for="drug_quantity">Jumlah</label>
                        </div>
                        <div class="col-xs-3">
                            <label for="drug_subtotal">Subtotal</label>
                        </div>
                    </div>
                </div>
                <div class="drug-form"></div>
                <hr>
                <div class="row">
                    <label for="total_price" class="col-xs-2">Total Pembayaran :</label>
                    <div class="col-xs-10">
                        <input type="hidden" name="total_price" value="<?php echo $diagnose->total_price; ?>">
                        <div id="total-payment" class="total-payment"><?php echo $diagnose->total_price; ?></div>
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
    $this->load->view('pages/' . $class_link . '/' . $page . '/page_js', $data);
    ?>
</div>