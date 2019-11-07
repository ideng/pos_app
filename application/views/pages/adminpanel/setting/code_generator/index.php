<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master' ;
?>

<section class="content view-container">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo 'Kode Generator ' . $title; ?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Sembunyikan"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="box-alert" style="display: none;"></div>
            <div class="box-loader text-center" style="display: none;">
                <i class="fa fa-spinner fa-2x fa-pulse text-primary"></i>
            </div>
            <input type="hidden" name="url" value="<?php echo base_url($class_link); ?>">
            <input type="hidden" name="page_url" value="<?php echo $class_link . '/' . $page; ?>">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <div class="row form-code-generator"></div>
        </div>
        <div class="overlay box-overlay" style="display: none;">
            <i class="fa fa-spinner fa-2x fa-pulse" style="color: #337ab7;"></i>
        </div>
    </div>
</section>
