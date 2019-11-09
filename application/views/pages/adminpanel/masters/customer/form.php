<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Masters';
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
                <div class="row">
                    <div class="col-xs-8">
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="form-group">
                                    <label for="patient_code">Kode Customer</label>
                                    <input type="text" name="patient_code" id="patient_code" class="form-control" placeholder="Kode Customer" value="<?php echo $row->patient_code; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="form-group">
                                    <label for="civilian_id">NIK</label>
                                    <input type="text" name="civilian_id" id="name" class="form-control" placeholder="NIK" value="<?php echo $row->civilian_id; ?>" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama" value="<?php echo $row->name; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="religion">Agama</label>
                                    <input type="text" name="religion" id="religion" class="form-control" placeholder="Agama" value="<?php echo $row->religion; ?>" required>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <?php
                                        $genders = ['male', 'female'];
                                        foreach ($genders as $key) {
                                            $selected = $row->gender == $key ? 'selected' : '';
                                            echo '<option value=\'' . $key . '\' ' . $selected . '>' . indo_gender($key) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea name="address" id="address" cols="30" rows="10" class="form-control" placeholder="Alamat"><?php echo $row->address; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="blood_type">Golongan Darah</label>
                                    <select name="blood_type" id="blood_type" class="form-control">
                                        <option value="">-- Pilih Gol. Darah --</option>
                                        <?php
                                        $blood_types = ['a', 'b', 'o', 'ab'];
                                        foreach ($blood_types as $blood_type) {
                                            $selected = $blood_type == $row->blood_type ? 'selected' : '';
                                            echo '<option value=\'' . $blood_type . '\' ' . $selected . '>' . strtoupper($blood_type) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="place_of_birth">Tempat Lahir</label>
                                    <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" placeholder="Tempat Lahir" value="<?php echo $row->place_of_birth; ?>" required>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="date_of_birth">Tanggal Lahir</label>
                                    <input type="text" name="date_of_birth" id="date_of_birth" class="form-control date-picker" placeholder="Tanggal Lahir" value="<?php echo format_date($row->date_of_birth, 'd-m-Y'); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="telephone">No. Telepon</label>
                                    <input type="text" name="telephone" id="telephone" class="form-control" placeholder="No. Telepon" value="<?php echo $row->telephone; ?>" required>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $row->email; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group text-center">
                                    <?php
                                    $img_dir = 'assets/uploads//img/' . $page . '/' . $row->image;
                                    $img = empty($row->image) || !file_exists($img_dir) ? 'assets/admin_lte/dist/img/avatar.png' : $img_dir;
                                    ?>
                                    <img src="<?php echo base_url($img); ?>" alt="" srcset="" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="image">Foto Customer</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-8">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="hidden" name="user_id" value="<?php echo $row->user_id; ?>">
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $user->username; ?>" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label for="privilege_id">Hak Akses</label>
                                <input type="hidden" name="user_privilege_id" value="<?php echo $user_privilege->id; ?>">
                                <select name="privilege_id" id="privilege" class="form-control" required>
                                    <option value="">-- Pilih Hak Akses --</option>
                                    <?php
                                    foreach ($privileges as $privilege) {
                                        $selected = $privilege->id == $user_privilege->privilege_id ? 'selected' : '';
                                        echo '<option value=\'' . $privilege->id . '\' ' . $selected . '>' . $privilege->name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                            if (!empty($user->password)) {
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
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-2 col-xs-offset-10">
                        <div class="form-group">
                            <button type="reset" class="btn btn-warning btn-flat">Reset</button>
                            <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.box-body -->
    <div class="overlay form-overlay" style="display: none;">
        <i class="fa fa-spinner fa-2x fa-pulse" style="color: #337ab7;"></i>
    </div>

    <script>
        $('.date-picker').datetimepicker({
            'format': 'DD-MM-YYYY'
        });
    </script>
</div>