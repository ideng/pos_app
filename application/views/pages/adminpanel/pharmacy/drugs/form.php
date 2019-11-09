<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master';
?>

<div class="box box-primary box-form">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo 'Form ' . ucwords(str_replace('_', ' ', $title)); ?></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Sembuyikan"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool btn-remove-form" data-widget="remove" data-toggle="tooltip" title="Tutup"><i class="fa fa-times"></i></button>
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
                    <div class="col-md-8 col-xs-12">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name">Nama Obat</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Obat" value="<?php echo $row->name; ?>" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="type_drug">Kategori Obat</label>
                                <select name="type_drug" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php
                                    foreach ($type as $types) {
                                        $selected = $types->id == $row->type_id ? 'selected' : '';
                                        echo '<option value=\'' . $types->id . '\' ' . $selected . '>' . $types->name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="sell_price">Harga Jual</label>
                                <div id="scrollable-dropdown-menu">
                                    <input type="number" name="sell_price" id="sell_price" class="form-control" placeholder="Harga Jual" value="<?php echo $row->sell_price; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="purchase_price">Harga Beli</label>
                                <div id="scrollable-dropdown-menu">
                                    <input type="number" name="purchase_price" id="purchase_price" class="form-control" placeholder="Harga Jual" value="<?php echo $row->purchase_price; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Deskripsi"><?php echo $row->description; ?></textarea>
                            </div>
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