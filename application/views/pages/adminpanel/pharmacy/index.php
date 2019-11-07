<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Admission';
?>

<section class="content view-container">

    <!-- Default box -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo 'Tabel ' . ucwords(str_replace('_', ' ', $title)); ?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Sembunyikan"><i class="fa fa-minus"></i></button>
                <?php
                if ($this->uri->segment(3) == 'gudang' || $this->uri->segment(3) == 'supplier' || $this->uri->segment(3) == 'purchase' || $this->uri->segment(3) == 'purchase_return' || $this->uri->segment(3) == 'sales_return' || $this->uri->segment(3) == 'sales' || $this->uri->segment(3) == 'type_drugs' || $this->uri->segment(3) == 'adjustment') {
                    ?>
                    <button class="btn btn-box-tool btn-add-data" data-toggle="tooltip" title="Tambah Data"><i class="fa fa-plus-square"></i></button>
                <?php
                }
                ?>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Tutup"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="table-alert" style="display: none;"></div>
            <div class="table-loader text-center">
                <i class="fa fa-spinner fa-2x fa-pulse text-primary"></i>
            </div>
            <input type="hidden" name="url" value="<?php echo base_url($class_link); ?>">
            <input type="hidden" name="base_url" value="<?php echo base_url(); ?>">
            <input type="hidden" name="page_url" value="<?php echo $class_link . '/' . $page; ?>">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <div class="table-container"></div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <!-- <?php
            if ($this->uri->segment(3) == 'mutasi') {
                ?>
        <div class="input-daterange">
            <div class="col-md-4">
                <input type="text" name="start_date" id="start_date" class="form-control" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="end_date" id="end_date" class="form-control" required>
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModals">
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
                    <div class="modal-body">
                        <?php //print_r($mutasi_beli);
                            ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?> -->
</section><!-- /.content -->