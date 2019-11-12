<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master';
?>

<?php
if ($this->uri->segment(3) == 'purchase' || $this->uri->segment(3) == 'purchase_return') {
    ?>
    <section class="content view-container">


        <div class="box-body">
            <div class="table-alert" style="display: none;"></div>
            <input type="hidden" name="url" value="<?php echo base_url($class_link); ?>">
            <input type="hidden" name="page_url" value="<?php echo $class_link . '/' . $page; ?>">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <div class="table-container"></div>
        </div><!-- /.box-body -->

    </section><!-- /.content -->
<?php
} elseif (($this->uri->segment(3) == 'mutasi')) {
    ?>
    <section class="content view-container">

        <!-- Default box -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo 'Tabel ' . $title; ?></h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Sembunyikan"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Tutup"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="table-loader" style="display: none;"></div>
                <input type="hidden" name="url" value="<?php echo base_url($class_link); ?>">
                <input type="hidden" name="page_url" value="<?php echo $class_link . '/' . $page; ?>">
                <input type="hidden" name="page" value="<?php echo $page; ?>">
                <div class="table-container"></div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section><!-- /.content -->
<?php
}
?>