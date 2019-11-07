<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master';
?>

<div class="box box-primary box-form">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo 'Form ' . ucwords(str_replace('_', ' ', $title)); ?></h3>
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
                    <div class="col-md-8 col-xs-12">
                        <div class="col-md-4 drug-id" style="margin-top: 15px;">
                            <div class="form-group">
                                <label for="drug_id">Nama Obat</label>
                                <select name="drug_id" class="form-control" required>
                                    <option value="">-- Pilih Obat --</option>
                                    <?php
                                    foreach ($drugs as $drug) {
                                        $selected = $drug->id == $row->drug_id ? 'selected' : '';
                                        echo '<option value=\'' . $drug->id . '\' data-purchase-price=\'' . $drug->purchase_price . '\' ' . $selected . '>' . $drug->name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 drug-price" style="margin-top: 15px;">
                            <div class="form-group">
                                <label for="price">Harga Beli</label>
                                <input type="number" name="drug_price" class="form-control" placeholder="Price" value="<?php echo $row->purchase_price; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-top: 15px;">
                            <div class="form-group">
                                <label for="quantity">Jumlah</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Jumlah" value="<?php echo $row->quantity; ?>" required>
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

    <?php
    $this->load->view('pages/' . $class_link . '/' . $page . '/page_js');
    ?>
</div>