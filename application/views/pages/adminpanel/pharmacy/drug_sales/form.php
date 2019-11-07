<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master';
$data = ['id' => $row->id];
?>

<div class="box box-primary box-form">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)); ?> Form</h3>
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
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="patient_civilian_id">NIK</label>
                                <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $row->patient_id; ?>">
                                <input type="text" name="patient_civilian_id" id="patient_civilian_id" class="form-control" placeholder="NIK" value="<?php echo $row->patient_civilian_id; ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="patient_name">Nama Pasien</label>
                                <div id="scrollable-dropdown-menu">
                                    <input type="text" name="patient_name" id="patient_name" class="form-control" placeholder="Nama Pasien" value="<?php echo $row->patient_name; ?>" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top: 15px;">
                            <div class="form-group">
                                <label for="date_in">Tanggal Masuk</label>
                                <input type="text" name="date_in" id="date_in" class="form-control" placeholder="Tanggal Masuk" value="<?php echo format_date($row->date_in, 'd-m-Y'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top: 15px;">
                            <div class="form-group">
                                <label for="checkup_id">Data Checkup</label>
                                <input type="hidden" name="chk_checkup_id" value="<?php echo $row->checkup_id; ?>">
                                <select name="checkup_id" id="checkup_id" class="form-control" style="font-family: FontAwesome; font-style: normal;" required>
                                    <option value="" data-doctor-id="" data-doctor-name="" data-poly-id="" data-poly-name="">-- Pilih Checkup --</option>
                                    <?php
                                    if (!empty($row->patient_id) && !empty($row->date_in)) {
                                        foreach ($checkups as $checkup) {
                                            if ($checkup->flag == 'inline' || $checkup->id == $row->checkup_id) {
                                                $selected = $checkup->id == $row->checkup_id ? 'selected' : '';
                                                $icon = $checkup->id == $row->checkup_id ? ' &#xf00c;' : '';
                                                echo '<option value=\'' . $checkup->id . '\' data-doctor-id=\'' . $checkup->doctor_id . '\' data-doctor-name=\'' . $checkup->doctor_name . '\' data-poly-id=\'' . $checkup->poly_id . '\' data-poly-name=\'' . $checkup->poly_name . '\' ' . $selected . '>' . $checkup->poly_name . ' - ' . $checkup->doctor_name . $icon . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="poly_name">Nama Poli</label>
                                <input type="hidden" name="poly_id" value="<?php echo $row->poly_id; ?>">
                                <input type="text" name="poly_name" id="poly_name" class="form-control" placeholder="Nama Poli" value="<?php echo $row->poly_name; ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="doctor_name">Nama Dokter</label>
                                <input type="hidden" name="doctor_id" value="<?php echo $row->doctor_id; ?>">
                                <input type="text" name="doctor_name" id="doctor_name" class="form-control" placeholder="Nama Dokter" value="<?php echo $row->doctor_name; ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Deskripsi"><?php echo $row->description; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="drugs">Data Obat</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-xs-12">
                        <div class="col-xs-4">
                            <label for="drug_id">Nama</label>
                        </div>
                        <div class="col-xs-4">
                            <label for="drug_price">Harga</label>
                        </div>
                        <div class="col-xs-4">
                            <label for="drug_quantity">Jumlah</label>
                        </div>
                    </div>
                </div>
                <div class="drug-form"></div>
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
    $this->load->view('pages/administrator/admission/components/patient_typeahead');
    $this->load->view('pages/administrator/admission/diagnoses/page_js', $data);
    ?>
</div>