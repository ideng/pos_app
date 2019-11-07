<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master' ;
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
                    <label for="username" class="col-xs-2">Username : </label>
                    <div class="col-xs-10"><?php echo $row->username; ?></div>
                </div>
                <div class="row">
                    <label for="name" class="col-xs-2">Nama :</label>
                    <div class="col-xs-10"><?php echo $row->name; ?></div>
                </div>
                <div class="row">
                    <label for="privilege_name" class="col-xs-2">Hak Akses :</label>
                    <div class="col-xs-10"><?php echo $row->privilege_name; ?></div>
                </div>
                <div class="row">
                    <label for="created_at" class="col-xs-2">Dibuat Pada :</label>
                    <div class="col-xs-10"><?php echo $row->created_at; ?></div>
                </div>
                <div class="row">
                    <label for="updated_at" class="col-xs-2">Diubah Pada :</label>
                    <div class="col-xs-10"><?php echo $row->updated_at; ?></div>
                </div>
            </form>
        </div>
    </div><!-- /.box-body -->
    <div class="overlay form-overlay" style="display: none;">
        <i class="fa fa-spinner fa-2x fa-pulse" style="color: #337ab7;"></i>
    </div>
</div>
