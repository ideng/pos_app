<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$is_hidden = $button == 'minus' ? 'style=\'display: none;\'' : '' ;
$has_margin = $button == 'minus' ? 'mt-2' : '' ;
$is_unique_display = $code_part == 'urutan_angka' || $code_part == 'kode_huruf' ? '' : 'style=\'display: none;\'' ;
?>

<div class="form-group">
    <div class="row code-part-form" <?php echo $is_hidden; ?>>
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="col-xs-4 code-part-option">
                    <select name="code_part[]" class="form-control">
                        <option value="">-- Select Part --</option>
                        <?php
                        foreach ($parts as $part) {
                            $selected = $part->key == $code_part ? 'selected' : '' ;
                            echo '<option value=\''.$part->key.'\' '.$selected.'>'.$part->value.'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-4 code-unique">
                    <div class="code-unique-form" <?php echo $is_unique_display; ?>>
                        <input type="text" name="code_unique[]" class="form-control" placeholder="Unique Code" value="<?php echo $code_unique; ?>">
                    </div>
                </div>
                <div class="col-xs-3">
                    <select name="code_separator[]" class="form-control">
                        <option value="">-- Select Separator --</option>
                        <?php
                        foreach ($separators as $separator) {
                            $selected = $separator->key == $code_separator ? 'selected' : '' ;
                            echo '<option value=\''.$separator->key.'\' '.$selected.'>'.$separator->value.'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1">
                    <?php
                    if ($button == 'plus') {
                        ?>
                        <button type="button" class="btn btn-success btn-flat btn-add-code-part" title="Add Code Part" data-toggle="tooltip">
                            <i class="fa fa-plus"></i>
                        </button>
                        <?php
                    } elseif ($button == 'minus') {
                        ?>
                        <button type="button" class="btn btn-danger btn-flat btn-remove-code-part" title="Remove Code Part" data-toggle="tooltip">
                            <i class="fa fa-trash"></i>
                        </button>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
