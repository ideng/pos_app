<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Hak Akses Menu' ;
foreach ($menu_privileges as $menu_privilege) {
    $privilege[$menu_privilege->menu_id] = [
        'create_access' => $menu_privilege->create_access,
        'read_access' => $menu_privilege->read_access,
        'update_access' => $menu_privilege->update_access,
        'delete_access' => $menu_privilege->delete_access,
    ];
}
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
                <input type="hidden" name="url" value="<?php echo base_url($class_link . '/submit_form_menu'); ?>">
                <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-8">
                            <label for="name">Nama Hak Akses</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Hak Akses" value="<?php echo $row->name; ?>" readonly>
                        </div>
                    </div>
                </div>
                <hr>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">Nama Menu</th>
                            <th colspan="4" style="text-align: center;">Akses</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">
                                Tambah Data
                                <hr>
                                <label for="chk-all-create">
                                    <input type="checkbox" name="chkAllCreate" id="chk-all-create" class="icheck-blue" value="1">
                                </label>
                            </th>
                            <th style="text-align: center;">
                                Baca Data
                                <hr>
                                <label for="chk-all-read">
                                    <input type="checkbox" name="chkAllRead" id="chk-all-read" class="icheck-blue" value="1">
                                </label>
                            </th>
                            <th style="text-align: center;">
                                Ubah Data
                                <hr>
                                <label for="chk-all-update">
                                    <input type="checkbox" name="chkAllUpdate" id="chk-all-update" class="icheck-blue" value="1">
                                </label>
                            </th>
                            <th style="text-align: center;">
                                Hapus Data
                                <hr>
                                <label for="chk-all-delete">
                                    <input type="checkbox" name="chkAllDelete" id="chk-all-delete" class="icheck-blue" value="1">
                                </label>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($level_one_menus as $level_one_menu) {
                            $access['create'] = isset($privilege[$level_one_menu->id]['create_access']) ? 'checked' : '' ;
                            $access['read'] = isset($privilege[$level_one_menu->id]['read_access']) ? 'checked' : '' ;
                            $access['update'] = isset($privilege[$level_one_menu->id]['update_access']) ? 'checked' : '' ;
                            $access['delete'] = isset($privilege[$level_one_menu->id]['delete_access']) ? 'checked' : '' ;
                            echo render_menu_form($level_one_menu, '[' . $level_one_menu->id . ']', $access, '');
                            foreach ($level_two_menus as $level_two_menu) {
                                if ($level_two_menu->parent_id == $level_one_menu->id) {
                                    $access['create'] = isset($privilege[$level_two_menu->id]['create_access']) ? 'checked' : '' ;
                                    $access['read'] = isset($privilege[$level_two_menu->id]['read_access']) ? 'checked' : '' ;
                                    $access['update'] = isset($privilege[$level_two_menu->id]['update_access']) ? 'checked' : '' ;
                                    $access['delete'] = isset($privilege[$level_two_menu->id]['delete_access']) ? 'checked' : '' ;
                                    echo render_menu_form($level_two_menu, '[' . $level_two_menu->id . '][' . $level_one_menu->id . ']', $access, 'col-sm-10 col-sm-offset-2 col-xs-11 col-xs-offset-1');
                                    foreach ($level_three_menus as $level_three_menu) {
                                        if ($level_three_menu->parent_id == $level_two_menu->id) {
                                            $access['create'] = isset($privilege[$level_three_menu->id]['create_access']) ? 'checked' : '' ;
                                            $access['read'] = isset($privilege[$level_three_menu->id]['read_access']) ? 'checked' : '' ;
                                            $access['update'] = isset($privilege[$level_three_menu->id]['update_access']) ? 'checked' : '' ;
                                            $access['delete'] = isset($privilege[$level_three_menu->id]['delete_access']) ? 'checked' : '' ;
                                            echo render_menu_form($level_three_menu, '[' . $level_three_menu->id . '][' . $level_two_menu->id . '][' . $level_one_menu->id . ']', $access, 'col-sm-8 col-sm-offset-4 col-xs-10 col-xs-offset-2');
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
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

    <script>
        $('input[type=\'checkbox\'].icheck-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        $('#chk-all-create').on('ifChecked', function() {
            $('.chk-create').iCheck('check');
        });

        $('#chk-all-create').on('ifUnchecked', function() {
            $('.chk-create').iCheck('uncheck');
        });

        $('#chk-all-read').on('ifChecked', function() {
            $('.chk-read').iCheck('check');
        });

        $('#chk-all-read').on('ifUnchecked', function() {
            $('.chk-read').iCheck('uncheck');
        });

        $('#chk-all-update').on('ifChecked', function() {
            $('.chk-update').iCheck('check');
        });

        $('#chk-all-update').on('ifUnchecked', function() {
            $('.chk-update').iCheck('uncheck');
        });

        $('#chk-all-delete').on('ifChecked', function() {
            $('.chk-delete').iCheck('check');
        });

        $('#chk-all-delete').on('ifUnchecked', function() {
            $('.chk-delete').iCheck('uncheck');
        });
    </script>
</div>
