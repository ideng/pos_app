<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master' ;
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
                <input type="hidden" name="page" value="<?php echo $page; ?>">
                <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo $row->username; ?>" required autofocus>
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama" value="<?php echo $row->name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="privilege_id">Hak Akses</label>
                    <input type="hidden" name="user_privilege_id" value="<?php echo $user_privilege->id; ?>">
                    <select name="privilege_id" id="privilege" class="form-control" required>
                        <option value="">-- Pilih Hak Akses --</option>
                        <?php
                        foreach ($privileges as $privilege) {
                            $selected = $privilege->id == $user_privilege->privilege_id ? 'selected' : '' ;
                            echo '<option value=\'' . $privilege->id . '\' ' . $selected . '>' . $privilege->name . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <?php
                if (!empty($row->password)) {
                    echo build_alert('warning', 'Peringatan!', 'Kosongkan kolom password jika tidak diubah!');
                }
                ?>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password_confirm">Konfirmasi Password</label>
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Konfirmasi Password">
                </div>
                <div class="box-footer">
                    <div class="col-xs-2 col-xs-offset-10">
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
