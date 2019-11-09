<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Masters';
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
            <form method="POST" id="formDetail">
                <input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_value; ?>">
                <input type="hidden" name="url" value="<?php echo base_url($class_link . '/submit_form'); ?>">
                <input type="hidden" name="page" value="<?php echo $page; ?>">
                <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="row">
                            <label for="patient_code" class="col-xs-4">Kode Customer :</label>
                            <div class="col-xs-8"><?php echo $row->patient_code; ?></div>
                        </div>
                        <div class="row">
                            <label for="civilian_id" class="col-xs-4">NIK :</label>
                            <div class="col-xs-8"><?php echo $row->civilian_id; ?></div>
                        </div>
                        <div class="row">
                            <label for="name" class="col-xs-4">Nama :</label>
                            <div class="col-xs-8"><?php echo $row->name; ?></div>
                        </div>
                        <div class="row">
                            <label for="religion" class="col-xs-4">Agama :</label>
                            <div class="col-xs-8"><?php echo $row->religion; ?></div>
                        </div>
                        <div class="row">
                            <label for="gender" class="col-xs-4">Jenis Kelamin : </label>
                            <div class="col-xs-8"><?php echo indo_gender($row->gender); ?></div>
                        </div>
                        <div class="row">
                            <label for="address" class="col-xs-4">Alamat :</label>
                            <div class="col-xs-8"><?php echo $row->address; ?></div>
                        </div>
                        <div class="row">
                            <label for="blood_type" class="col-xs-4">Golongan Darah :</label>
                            <div class="col-xs-8"><?php echo empty_string(strtoupper($row->blood_type), '-'); ?></div>
                        </div>
                        <div class="row">
                            <label for="place_of_birth" class="col-xs-4">Tempat, Tanggal Lahir :</label>
                            <div class="col-xs-8"><?php echo $row->place_of_birth . ', ' . format_date($row->date_of_birth, 'd-m-Y'); ?></div>
                        </div>
                        <div class="row">
                            <label for="telephone" class="col-xs-4">No. Telepon :</label>
                            <div class="col-xs-8"><?php echo $row->telephone; ?></div>
                        </div>
                        <div class="row">
                            <label for="email" class="col-xs-4">Email :</label>
                            <div class="col-xs-8"><?php echo empty_string($row->email, '-'); ?></div>
                        </div>
                        <div class="row">
                            <label for="created_at" class="col-xs-4">Dibuat Pada :</label>
                            <div class="col-xs-8"><?php echo $row->created_at; ?></div>
                        </div>
                        <div class="row">
                            <label for="updated_at" class="col-xs-4">Diubah Pada :</label>
                            <div class="col-xs-8"><?php echo $row->updated_at; ?></div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group text-center">
                                    <?php
                                    $img_dir = 'assets/uploads/img/' . $page . '/' . $row->image;
                                    $img = empty($row->image) || !file_exists($img_dir) ? 'assets/admin_lte/dist/img/avatar.png' : $img_dir;
                                    ?>
                                    <img src="<?php echo base_url($img); ?>" alt="" srcset="" class="img-thumbnail">
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