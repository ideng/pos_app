<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$drug_view = isset($drug_view) ? $drug_view : 'form';
?>
<div class="row drug-form-component" <?php echo $is_hidden ? 'style=\'display: none;\'' : ''; ?>>
    <div class="col-md-10 col-xs-12">
        <?php
        if ($drug_view == 'form') {
            ?>
            <div class="col-xs-2 barcode">
                <div class="form-group">
                    <input type="text" id="barcode" name="barcode[]" class="form-control" placeholder="Barcode" value="<?php echo $barcode; ?>" required>
                </div>
            </div>
            <div class="col-xs-1 select">
                <div class="form-group">
                    <select id="select" name="select[]" class="form-control">
                        <option value="">-Nama Barang-</option>
                        <?php
                            foreach ($drugs as $drug) {
                                $selected = $drug->id == $drug_id ? 'selected' : '';
                                echo '<option value=\'' . $drug->id . '\' data-sell-price=\'' . $drug->sell_price . '\' data-barcode=\'' . $drug->barcode . '\' data-name=\'' . $drug->name . '\' data-id=\'' . $drug->id . '\' ' . $selected . '>' . $drug->name . '</option>';
                            }
                            ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-1">
                <?php
                    if ($btn == 'plus') {
                        ?>
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-flat btn-add-drug" data-toggle="tooltip" title="Add Drug">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                <?php
                    } elseif ($btn == 'minus') {
                        ?>
                    <div class="form-group">
                        <button type="button" class="btn btn-danger btn-flat btn-remove-drug" data-toggle="tooltip" title="Remove Drug">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                <?php
                    }
                    ?>
            </div>
            <div class="col-xs-2 name">
                <div class="form-group">
                    <input type="text" id="name" name="name[]" class="form-control" placeholder="Nama Barang" value="<?php echo $name; ?>" required readonly>
                    <input type="hidden" id="drug_id" name="drug_id[]" class="form-control" placeholder="id" value="<?php echo $drug_id; ?>" required>
                </div>
            </div>
            <div class="col-xs-2 drug-price">
                <div class="form-group">
                    <input type="number" id="drug_price" name="drug_price[]" class="form-control" step="500" placeholder="Price" value="<?php echo $price; ?>" required readonly>
                </div>
            </div>
            <div class="col-xs-2 drug-quantity">
                <div class="form-group">
                    <input type="number" id="drug_quantity" name="drug_quantity[]" class="form-control" min="0" step="1" placeholder="Quantity" value="<?php echo $quantity; ?>" required>
                </div>
            </div>
            <div class="col-xs-2 drug-subtotal">
                <div class="form-group">
                    <input type="number" id="drug_subtotal" name="drug_subtotal[]" class="form-control" step="500" placeholder="Subtotal" value="<?php echo $subtotal; ?>" required readonly>
                </div>
            </div>
        <?php
        } elseif ($drug_view == 'payment_form') {
            ?>
            <div class="col-xs-3 drug-id">
                <div class="form-group">
                    <?php
                        foreach ($drugs as $drug) {
                            if ($drug->id == $drug_id) {
                                ?>
                            <input type="hidden" name="payment_id[]" value="<?php echo $drug->id; ?>">
                            <input type="hidden" name="payment_name[]" value="<?php echo $drug->name; ?>">
                    <?php
                                echo $drug->name;
                            }
                        }
                        ?>
                </div>
            </div>
            <div class="col-xs-3 drug-price">
                <div class="form-group">
                    <?php echo number_format((float) $price, '2', ',', '.'); ?>
                    <input type="hidden" name="payment_price[]" value="<?php echo $price; ?>">
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <?php echo $quantity; ?>
                    <input type="hidden" name="payment_quantity[]" value="<?php echo $quantity; ?>">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <?php
                        $price = empty($price) ? '0' : $price;
                        $quantity = empty($quantity) ? '0' : $quantity;
                        $subtotal = $price * $quantity;
                        echo number_format((float) $subtotal, '2', ',', '.');
                        ?>
                    <input type="hidden" name="payment_subtotal[]" value="<?php echo $subtotal; ?>">
                </div>
            </div>
            <div class="col-xs-1">
                <?php
                    if ($btn == 'plus') {
                        ?>
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-flat btn-add-payment" data-toggle="tooltip" title="Tambah Pembayaran">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                <?php
                    }
                    ?>
            </div>
        <?php
        } elseif ($drug_view == 'add_payment') {
            ?>
            <div class="col-xs-3">
                <div class="form-group">
                    <input type="text" name="payment_name[]" class="form-control" placeholder="Nama Pembayaran" required>
                </div>
            </div>
            <div class="col-xs-3 payment-price">
                <div class="form-group">
                    <input type="number" name="payment_price[]" class="form-control" min="0" step="500" placeholder="Harga" required>
                </div>
            </div>
            <div class="col-xs-2 payment-quantity">
                <div class="form-group">
                    <input type="number" name="payment_quantity[]" class="form-control" min="0" step="1" placeholder="Jumlah" required>
                </div>
            </div>
            <div class="col-xs-3 payment-subtotal">
                <div class="form-group">
                    <div class="payment-subtotal-text" style="margin-top: 5px;"></div>
                    <input type="hidden" name="payment_subtotal[]">
                </div>
            </div>
            <div class="col-xs-1">
                <div class="form-group">
                    <button type="button" class="btn btn-danger btn-flat btn-remove-payment" data-toggle="tooltip" title="Hapus Pembayaran">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        <?php
        } elseif ($drug_view == 'detail') {
            ?>
            <div class="col-xs-3">
                <div class="form-group">
                    <?php
                        foreach ($drugs as $drug) {
                            $selected = $drug->id == $drug_id ? $drug->name : '';
                            echo $selected;
                        }
                        ?>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <?php echo number_format((float) $price, '2', ',', '.'); ?>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <?php echo $quantity; ?>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <?php
                        $price = empty($price) ? '0' : $price;
                        $quantity = empty($quantity) ? '0' : $quantity;
                        $subtotal = $price * $quantity;
                        echo number_format((float) $subtotal, '2', ',', '.');
                        ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>