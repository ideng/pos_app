<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Privilege' ;
?>

<div class="box box-primary box-form">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo 'Form ' . $title; ?></h3>
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
                <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-8">
                            <label for="name">Nama Hak Akses</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Hak Akses" value="<?php echo $row->name; ?>" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label for="level">Level Hak Akses (0-5)</label>
                            <input type="number" name="level" id="level" class="form-control" placeholder="Level" value="<?php echo $row->level; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label for="module">Modul</label>
                            <select name="module" id="module" class="form-control">
                                <option value="">-- Pilih Modul --</option>
                                <?php
                                $modules = module_list();
                                foreach ($modules as $module) {
                                    $selected = $module == $row->module ? 'selected' : '' ;
                                    echo '<option value=\'' . $module . '\' ' . $selected . '>' . ucwords($module) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
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
</div>
