<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master' ;
$data = ['id' => $row->id, 'drug_view' => 'form'];
?>

<div class="form-container">
    <form method="POST" id="formSubmit">
        <input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_value; ?>">
        <input type="hidden" name="url" value="<?php echo base_url($class_link . '/submit_form'); ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="hidden" name="id" value="<?php echo $row->id; ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name">Nama Kode</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama Kode" value="<?php echo $row->name; ?>" autofocus>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code_reset">Direset Tiap</label>
                        <select name="code_reset" id="code_reset" class="form-control">
                            <option value="">-- Pilih Reset --</option>
                            <?php
                            foreach ($code_reset_opts as $code_reset_opt) {
                                $selected = $code_reset_opt->key == $row->code_reset ? 'selected' : '' ;
                                echo '<option value=\''.$code_reset_opt->key.'\' '.$selected.'>'.$code_reset_opt->value.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <label for="code_parts">Susunan Kode</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="col-xs-4">
                        <label for="code_part">Bentuk Kode</label>
                    </div>
                    <div class="col-xs-4">
                        <label for="code_part">Kode Unik</label>
                    </div>
                    <div class="col-xs-4">
                        <label for="code_part">Pemisah Kode</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="code-parts-form"></div>
        <hr>
        <div class="col-xs-3 col-xs-offset-9">
            <div class="form-group">
                <button type="button" class="btn btn-default btn-flat btn-back">
                    <i class="fa fa-arrow-left"></i> Kembali
                </button>
                <button type="reset" class="btn btn-warning btn-flat">Reset</button>
                <button type="submit" class="btn btn-primary btn-flat">Submit</button>
            </div>
        </div>
    </form>
</div>
