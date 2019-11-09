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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="code_supplier_id">Supplier Code</label>
                                <input type="text" name="code_supplier_id" id="code_supplier_id" class="form-control" placeholder="Supplier Code" value="<?php echo $row->supplier_code; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="supplier_name">Nama Supplier</label>
                                <input type="text" name="supplier_name" id="supplier_name" class="form-control" placeholder="Nama Supplier" value="<?php echo $row->supplier_name; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address" cols="30" rows="10" class="form-control" placeholder="Alamat"><?php echo $row->address; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="city_name">Nama Kota</label>
                                <input type="hidden" name="city_id" id="city_id" value="<?php echo $row->city_id; ?>">
                                <div id="scrollable-dropdown-menu">
                                    <input type="text" name="city_name" id="city_name" class="form-control" placeholder="Nama City" value="<?php echo $row->city_name; ?>" required autofocus>
                                </div>
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
    $this->load->view('pages/' . $class_link . '/components/city_typeahead');
    $this->load->view('pages/' . $class_link . '/' . $page . '/page_js');
    ?>
</div>