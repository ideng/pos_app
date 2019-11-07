<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Privilege' ;
?>

<section class="content view-container">

    <!-- Default box -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo 'Tabel ' . $title; ?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Sembunyikan"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool btn-add-data" data-toggle="tooltip" title="Tambah Data"><i class="fa fa-plus-square"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Tutup"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="table-alert" style="display: none;"></div>
            <div class="table-loader text-center">
                <i class="fa fa-spinner fa-2x fa-pulse text-primary"></i>
            </div>
            <input type="hidden" name="url" value="<?php echo base_url($class_link); ?>">
            <div class="table-container"></div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->
